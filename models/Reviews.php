<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "reviews".
 *
 * The followings are the available columns in table 'reviews':
 * @property integer $id
 * @property integer $profile_id
 * @property integer $user_id
 * @property integer $type
 * @property string $review
 * @property integer $vote
 */
class Reviews extends Model {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Reviews the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return 'reviews';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(['profile_id', 'user_id', 'type', 'review', ' vote'], 'required'),
            array(['profile_id', 'user_id', 'type', 'vote'], 'integer'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(['id', 'profile_id', 'user_id', 'type', 'review', 'vote'], 'safe'),
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
            'profile_id' => 'Profile',
            'user_id' => 'User',
            'type' => 'Type',
            'review' => 'Review',
            'vote' => 'Vote',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return ActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search( $params ) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $query = Reviews::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['id', $this->id]);
        $query->andFilterWhere(['profile_id', $this->profile_id]);
        $query->andFilterWhere(['user_id', $this->user_id]);
        $query->andFilterWhere(['type', $this->type]);
        $query->andFilterWhere(['review', $this->review, true]);
        $query->andFilterWhere(['vote', $this->vote]);

        return $dataProvider;
    }

}
