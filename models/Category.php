<?php

namespace app\models;


use Yii;
use app\models\CategoryQuery;
use yii\db\ActiveRecord;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property string $icon
 */
class Category extends Model {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public $catTree;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return 'category';
    }
    

    public static function roots(){
        return self::find()->where(['level' => '1'])->all();
    }


    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array(['name', 'icon'], 'length', 'max' => 255),
            array(['description'], 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(['id', ' name', ' icon', ' fields', ' level'], 'safe'),
            //array('meta_title, meta_descr, meta_key', 'application.components.textValidator', 'format' => 'text'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'bulletins' => array(self::HAS_MANY, 'Adverts', 'category_id'),
        );
    }

    // Формирование поля items для виджета Cmenu для Меню Категории
    public function menuItems($cat_id = 0) {

        if ($cat_id != 0) {
            $curent_cat = Yii::$app->params['categories'][intval($cat_id)];
            $this->catTree = self::findBySql(
                " select * from category where level='1' "
                . " or (lft<'" . $curent_cat['lft'] . "' and root=' "
                . $curent_cat['root'] . "' and level<'" . $curent_cat['level'] . "' )  "
                . " or id='" . $curent_cat['id'] . "' "
                . " or (root='" . $curent_cat['root'] . "' and level='" . $curent_cat['level'] . "') "
                . " or ( lft>'" . $curent_cat['lft'] . "' and rgt<'" . $curent_cat['rgt'] . "'"
                . " and root='" . $curent_cat['root'] . "' and level='" . ($curent_cat['level'] + 1) . "')"
            )->all();

        } else {

            $this->catTree = self::find()->where(['level' => '1'])->all();

        }
        $catMenuItems = Array();
        $catMenuItems = $this->catRecursive();

        return $catMenuItems;
    }

    public function catRecursive($root = 0, $level = 1, $lft = 0, $rgt = 0) {
        $ret_cats = array();
        $catItem = Array();



        foreach ($this->catTree as $cat) {
            if (($cat->level == $level and $cat->lft > $lft
                    and $cat->rgt < $rgt and $cat->root == $root)
                    or ( $root == 0 and $cat->level == 1)) {
                $catItem['label'] = $cat->name;
                $catItem['url'] = array("/category/" . $cat->id);

                if (($cat->lft + 1) < $cat->rgt)
                    $catItem['items'] = $this->catRecursive($cat->root, $cat->level + 1, $cat->lft, $cat->rgt);
                else
                    unset($catItem['items']);

                $ret_cats[] = $catItem;
            }
        }

        return $ret_cats;
    }

    static function getCategories() {
        // поставить кэширование запроса и обработку fields 
        $categories = Yii::$app->db->createCommand('SELECT * FROM category')
                ->queryAll();


        $ret_cat = Array();
        foreach ($categories as $n => $cat) {
            $ret_cat[$cat['id']] = $cat;
            $ret_cat[$cat['id']]['fields'] = json_decode($cat['fields'], true);
            if (is_array($ret_cat[$cat['id']]['fields'])) {
                foreach ($ret_cat[$cat['id']]['fields'] as $f_n => $field) {
                    if ($field['type'] == 2) {
                        $ret_cat[$cat['id']]['fields'][$f_n]['atr'] = explode(",", $field['atr']);
                    }
                }
            }
        }

        $cat_count = (new \yii\db\Query())
            ->select('category_id, COUNT(*) count')
            ->from(Adverts::tableName())
            ->groupBy('category_id')
            ->all();
        foreach ($cat_count as $row)
            $ret_cat[$row['category_id']]['count'] = $row['count'];

        return $ret_cat;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => t('Category name'),
            'icon' => t('Icon'),
            'fields' => t('Aditionl fields'),
            'meta_title' => t('Meta title'),
            'meta_descr' => t('Meta description'),
            'meta_key' => t('Meta keywords'),
            'description' => t('Description'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return ActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search( $params ) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere('id', $this->id);
        $query->andFilterWhere('name', $this->name, true);
        $query->andFilterWhere('icon', $this->icon, true);
        $query->andFilterWhere('fields', $this->fields, true);
        $query->andFilterWhere('level', $this->level, true);

        return $dataProvider;
    }

    public function scopes() {
        return array(
            'sitemap' => array('select' => 'id', 'order' => 'id ASC'),
        );
    }

    public function fieldsSave() {
        $fields = Array();
        if (is_array($_POST['Category']['fields']))
            foreach ($_POST['Category']['fields'] as $fn => $fd) {
                if (preg_match('#fn_[0-9]+#is', $fn))
                    $fields[Translit::latin($fd['name'])] = $fd;
                else
                    $fields[$fn] = $fd;
            }

        $this->fields = json_encode($fields);
    }

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                // 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public function countBulletins() {
        $count = Yii::$app->params['categories'][$this->id]['count'];
        if ($this->isRoot()) {
            $descendants = $this->children()->findAll();
            foreach ($descendants as $descendant) {
                $count += $descendant->countBulletins();
            }
        }
        return $count;
    }

}
