<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "favorites".
 *
 * The followings are the available columns in table 'favorites':
 * @property integer $id
 * @property integer $user_id
 * @property integer $obj_id
 * @property integer $obj_type
 */
class Favorites extends Model {

    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return 'favorites';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(['user_id', 'obj_id', 'obj_type'], 'integer'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(['id', ' user_id', ' obj_id', ' obj_type'], 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'obj_id' => 'Obj',
            'obj_type' => 'Obj Type',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get ActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return ActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search( $params ) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['id', $this->id]);
        $query->andFilterWhere(['user_id', $this->user_id]);
        $query->andFilterWhere(['obj_id', $this->obj_id]);
        $query->andFilterWhere(['obj_type', $this->obj_type]);

        return $dataProvider;

    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your ActiveRecord descendants!
     * @param string $className active record class name.
     * @return Favorites the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
