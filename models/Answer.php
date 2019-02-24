<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "answer".
 *
 * The followings are the available columns in table 'answer':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $user_id
 * @property string $text
 * @property string $created_at
 * @property string $updated_at
 */
class Answer extends Model {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Answer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return 'answer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(['text'], 'required'),
            array(['parent_id, user_id', 'numerical'], 'integer' ),
            array(['id', ' parent_id', ' user_id', ' text', ' created_at', ' updated_at'], 'safe'),
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
            'answers' => array(self::HAS_MANY, 'Answer', 'parent_id'),
        );
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'id']);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'user_id' => Yii::t('main', 'User'),
            'text' => Yii::t('main', 'Text answer'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return ActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search( $params ) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.


        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere('id', $this->id);
        $query->andFilterWhere('parent_id', $this->parent_id);
        $query->andFilterWhere('user_id', $this->user_id);
        $query->andFilterWhere('text', $this->text, true);
        $query->andFilterWhere('created_at', $this->created_at, true);
        $query->andFilterWhere('updated_at', $this->updated_at, true);

        return $dataProvider;
    }

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
                'timestampExpression' => 'date("Y-m-d H:i:s", time())',
            ),
        );
    }

}
