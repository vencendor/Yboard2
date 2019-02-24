<?

class Languages extends CApplicationComponent {

    /**
     * @var boolean enable language component.
     */
    public $useLanguage = false;

    /**
     * @var boolean auto detect language if not set.
     */
    public $autoDetect = false;

    /**
     * @var array allowed languages.
     */
    public $languages = array('en', 'ru', 'it');

    /**
     * @var array languages titles for link.
     */
    public $languagesTitles = array('ru' => 'Russian', 'en' => 'English', 'it' => 'Italian');

    /**
     * @var string default language.
     */
    public $defaultLanguage = 'ru';

    /**
     * @var string hidden input id.
     */
    public $id = 'siteLang';

    /**
     * @return void
     */
    public function init() {
        if ($this->useLanguage)
            $this->initLanguage();
    }

    /**
     * @return void
     */
    private function initLanguage() {
        $language = Yii::$app->session->itemAt('language');

        if ($language === null && $this->defaultLanguage)
            $language = $this->defaultLanguage;

        if ($language === null && $this->autoDetect)
            $language = Yii::$app->getRequest()->getPreferredLanguage();

        if ($language === 'uk_ua')
            $language = 'uk';

        $languageId = array_search($language, $this->languages);

        $language = $this->languages[$languageId === false ? 0 : $languageId];

        Yii::$app->session['language'] = $language;
        Yii::$app->setLanguage($language);
    }

}

?>