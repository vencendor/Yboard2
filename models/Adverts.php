<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\models\User;
use app\models\Category;
use zxbodya\yii2\galleryManager\GalleryManagerAction;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "adverts".
 *
 * The followings are the available columns in table 'bulletin':
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $category_id
 * @property boolean $type
 * @property integer $views
 * @property string $text
 */
class Adverts extends Model {

    const TYPE_DEMAND = 0;
    const TYPE_OFFER = 1;

    public $price_min;
    public $price_max;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Bulletin the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return 'adverts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            [[ 'name', 'user_id', 'category_id', 'text'], 'required'],
            [['user_id', 'category_id', 'gallery_id', 'views', 'location', 'currency'], 'integer' ],
            [['name'], 'string', 'max' => 255],
            [['price', 'type'],  'double'],
            [['type'], 'safe'],
            [['created_at', 'updated_at'], 'default'],
            [['id', 'name', 'user_id', 'category_id', 'type', 'views', 'text', 'price', 'currency', 'moderated'], 'safe', 'on' => 'search'],
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'gallery' => array(self::BELONGS_TO, 'Gallery', 'gallery_id'),
        );
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'id']);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => t('ID'),
            'name' => t('Name'),
            'user_id' => t('User'),
            'category_id' => t('Category'),
            'type' => \t('Type'),
            'views' => t('Views'),
            'text' => t('Text'),
            'gallery_id' => t('Gallery'),
            'youtube_id' => t('Youtube'),
            'created_at' => t('Created At'),
            'updated_at' => t('Updated At'),
            'fields' => t('Fields'),
            'price' => t('Price'),
            'location' => t('Location'),
            'moderated' => t('Мoderated'),
        );
    }

    public static function itemAlias($type, $code = NULL) {
        $_items = array(
            'type' => array(
                self::TYPE_DEMAND => t('Demand'),
                self::TYPE_OFFER => t('Offer'),
            ),
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return ActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($strict = true) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);

        //$criteria->compare('category_id', $this->category_id);
        if (is_numeric($this->category_id)) {
            $criteria->addCondition('t.category_id = "' . $this->category_id . '" '
                    . ' or (category.lft > "' . Yii::$app->params['categories'][$this->category_id]['lft'] . '"'
                    . ' and category.rgt< "' . Yii::$app->params['categories'][$this->category_id]['rgt'] . '"'
                    . ' and category.root = "' . Yii::$app->params['categories'][$this->category_id]['root'] . '")');
        }

        if ($this->fields) {
            $criteria->addCondition(" t.fields regexp '" . $this->fields . "' ");
        }

        if (is_numeric($this->price_min) and $this->price_max > 0) {
            $criteria->addCondition("price >= " . $this->price_min . " and price <= " . $this->price_max);
        }

        $criteria->join = 'inner join category on category.id=t.category_id';

        $criteria->compare('type', $this->type);
        $criteria->compare('location', $this->location, true);
        $criteria->compare('views', $this->views);
        $criteria->compare('moderated', $this->moderated, true);
        $criteria->order = 'id desc';
        $criteria->limit = Yii::$app->params['adv_on_page'];

        if ($strict) {
            $criteria->compare('t.name', $this->name, true, "or");
            $criteria->compare('text', $this->text, true, "or");
        } else {
            $search_str = explode(" ", $this->text);
            foreach ($search_str as $v) {
                if (mb_strlen($v) > 2) {
                    $criteria->compare('t.name', $v, true, "or");
                    $criteria->compare('text', $v, true, "or");
                }
            }
        }

        return new ActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function scopes() {
        return array(
            'sitemap' => array('select' => 'id', 'condition' => 'created_at <= NOW()', 'order' => 'created_at ASC'),
        );
    }

    public function behaviors() {
        return [
            
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]],
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'product',
                'tableName' => 'gallery_photo',
                'extension' => 'jpg',
                'directory' => \Yii::getAlias('@webroot') . '/images/product/gallery',
                'url' => \Yii::getAlias('@web') . '/images/product/gallery',
                'versions' => [
                    'small' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(200, 200));
                    },
                    'medium' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ]
        ];
    }

    /**
     * return first GalleryPhoto
     * @return GalleryPhoto
     */
    public function getPhoto() {

        $images = $this->getBehavior('galleryBehavior')->getImages();

            if (!empty($images) ) {

                return $images[0];
        }
    }

}
