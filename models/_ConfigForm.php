<?php

class ConfigForm extends \yii\base\Model {

    public $top;
    public $answer;

    public function rules() {
        return array(
            array('top, answer', 'safe'),
            array('increase_views', 'numerical', 'integerOnly' => true),
        );
    }

    public function attributeLabels() {
        return array(
            'top' => Yii::t('main', 'Top'),
            'answer' => Yii::t('main', 'Answers'),
        );
    }

}

?>
