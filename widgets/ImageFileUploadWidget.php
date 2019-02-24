<?php




class ImageFileUploadWidget extends CWidget {

    /**
     * @var CActiveForm form
     */
    public $form;

    /**
     * @var CModel model
     */
    public $model;

    /**
     * @var string Model's attribute
     */
    public $attribute;

    /**
     * @var string Image preview
     */
    public $preview;

    public function run() {
        return $this->render('imageFileUploadWidget', array(
            'model' => $this->model,
            'form' => $this->form,
            'attribute' => $this->attribute,
            'preview' => $this->preview,
        ));
    }

}

?>
