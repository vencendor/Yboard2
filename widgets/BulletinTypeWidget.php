<?php


class BulletinTypeWidget extends CWidget {

    /**
     * @var CActiveForm form
     */
    public $form;

    /**
     * @var Bulletin model
     */
    public $model;

    public function run() {
        return $this->render('bulletinTypeWidget', array('model' => $this->model, 'form' => $this->form));
    }

}

?>
