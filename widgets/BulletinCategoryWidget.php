<?php


class BulletinCategoryWidget extends CWidget {

    /**
     * @var CActiveForm form
     */
    public $form;

    /**
     * @var Bulletin model
     */
    public $model;

    public function run() {
        return $this->render('bulletinCategoryWidget', array('model' => $this->model, 'form' => $this->form, 'categories' => $this->categoriesListData()));
    }

    public function categoriesListData() {
        $categoriesTree = Category::roots()->findAll();
        $categories = array();
        foreach ($categoriesTree as $category) {
            //$categories[$category->name] = ArrayHelper::map($category->children()->findAll(), 'id', 'name');
            $categories[$category->id] = $category->name;
        }
        return $categories;
    }

}

?>
