<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $message
 * @property string $send_date
 * @property boolean $read
 */
class Messages extends Model {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Messages the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return 'messages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(['sender_id', 'receiver_id', 'message', 'send_date'], 'required'),
            array(['sender_id', 'receiver_id'], 'integer'),
            // array('message', 'length', 'max' => 3000, 'min' => 3),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(['id', 'sender_id', 'receiver_id', 'message', 'send_date', 'read'], 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
            'receiver' => array(self::BELONGS_TO, 'User', 'receiver_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => t('ID'),
            'sender_id' => t('Sender'),
            'receiver_id' => t('Receiver'),
            'message' => t('Message'),
            'send_date' => t('Send Date'),
            'read' => t('Read'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return ActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search( $params ) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $query = Messages::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'creation_date', $this->creation_date]);

        return $dataProvider;
    }

}
