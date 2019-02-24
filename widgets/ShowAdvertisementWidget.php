<?php




class ShowAdvertisementWidget extends CWidget {

    /**
     * @var int
     */
    public $offset = 0;

    /**
     * @var int
     */
    public $limit = 10;

    public function run() {
        return $this->render('showAdvertisementWidget', array('data' => $this->loadAdvertisement()));
    }

    /**
     * @return Advertisement[]
     */
    protected function loadAdvertisement() {

        $dataProvider = new ActiveDataProvider('Advertisement', array(
            'criteria' => array(
                'order' => '`order` ASC, id ASC',
                'offset' => $this->offset,
                'limit' => $this->limit,
            ),
        ));
        $dataProvider->setPagination(false);
        return $dataProvider->getData();
    }

}

?>
