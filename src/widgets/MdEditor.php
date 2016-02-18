<?php
namespace Hector68\GrafikartMarkdownEditor\widgets;

use Hector68\GrafikartMarkdownEditor\assets\JSMarkdownEditorAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\i18n\PhpMessageSource;
use yii\widgets\InputWidget;
use Yii;

/**
 * Class MdEditor
 * @package Hector68\GrafikartMarkdownEditor\widgets
 */
class MdEditor extends InputWidget
{

    const CATEGORY_NAME = 'hector68/yii2-grafikart-markdown-editor/';

    /**
     * @var array
     */
    public $jsOptions = [];

    /**
     * @var bool
     */
    public $uploader = false;

    /**
     * @var bool
     */
    public $preview = false;

    /**
     * @var array
     */
    public $images = [];


    /**
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($message, $params = [], $language = null)
    {
        return Yii::t(self::CATEGORY_NAME . 'widget', $message, $params, $language);
    }


    /**
     *
     */
    public function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations[self::CATEGORY_NAME . '*'] = [
            'class' => PhpMessageSource::class,
            'sourceLanguage' => 'en-US',
            'basePath' => dirname(__FILE__) . '/../messages/',
            'fileMap' => [
                self::CATEGORY_NAME.'widget' => 'widget.php',
            ],
        ];
    }


    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $this->registerTranslations();
        return parent::init();
    }


    /**
     * @return string
     */
    public function run()
    {
        JSMarkdownEditorAsset::register($this->getView());
        $class = 'mdeditor_' . $this->id;

        $jsOptions = ArrayHelper::merge(
            [
                'uploader' => $this->uploader,
                'preview' => $this->preview,
                'images' => $this->images,
                'labelClose' => self::t('Do you really want to close this window ? Every edit you did could be lost'),
                'labelInsert' => self::t('Insert'),
                'labelDelete' => self::t('Delete'),
                'labelSuccess' => self::t('Content saved with success'),
                'labelImage' => self::t('Insert your image url'),
                'labelConfirm' => self::t('Do you really want to delete this picture ?'),
                'labelBoldButton' => self::t('Bold'),
                'labelItalicButton' => self::t('Italic'),
                'labelLinkButton' => self::t('Link'),
                'labelImageButton' => self::t('Image'),
                'labelCodeButton' => self::t('Code'),
                'uploaderData' => [
                    '_csrf' => \Yii::$app->request->getCsrfToken()
                ]
            ],
            $this->jsOptions

        );

        $this->view->registerJs(
            'var md_' . $class . ' = new MdEditor(".' . $class . '", ' . Json::encode($jsOptions) . ' )'
        );

        $this->options = ArrayHelper::merge($this->options, ['class' => $class]);

        return $this->hasModel() ?
            Html::activeTextarea($this->model, $this->attribute, $this->options) :
            Html::textarea($this->name, $this->value, $this->options);
    }

}