<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 01.03.2019
 * Time: 23:32
 */

namespace app\components;

class WebUser extends \yii\web\User
{
    public function can($permissionName, $params = [], $allowCaching = true)
    {


        dump(  \Yii::$app->request->get()  );
        dump(  \Yii::$app->controller  );

        if( $permissionName === "admin" and $this->identity->superuser ){
            return true;
        }

        if( $permissionName === "permision" and $this->identity->superuser ){
            return true;
        }

        if( $permissionName === "permision"  ){

            if( class_exists("\\app\\models\\".ucfirst(\Yii::$app->controller->id)) ) {



            }

            return true;
        }

    }
}