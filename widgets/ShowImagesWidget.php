<?php

class ShowImagesWidget extends CWidget {

    /**
     * @var Bulletin
     */
    public $bulletin;

    public function run() {
        return $this->render('showImagesWidget', array('bulletin' => $this->bulletin));
    }

}

?>
