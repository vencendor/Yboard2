<?php

namespace app\modules\admin;



class AdminModule extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        /*
        $this->setImport(array(
            'view.models.*',
            //'view.components.*',
            'view.controllers.*',
        ));
        */
        parent::init();
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            Yii::$app->widgetFactory->widgets['CBreadcrumbs'] = Yii::$app->widgetFactory->widgets['TbBreadcrumbs'] = array('homeLink' => Html::a(t('lang', 'Home'), array('/view')));

            return true;
        } else
            return false;
    }

    /**
     * @param $str
     * @param $params
     * @param $dic
     * @return string
     */
    public static function t($str = '', $params = array(), $dic = 'view') {
        return Yii::t('lang', $str);

        // переделано для работы только с одним файлом языка
        /*
          if (Yii::t("AdminModule", $str)==$str)
          return Yii::t("AdminModule.".$dic, $str, $params);
          else
          return Yii::t("AdminModule", $str, $params);
         * 
         */
    }

}
