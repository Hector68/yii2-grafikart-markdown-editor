<?php
namespace Hector68\GrafikartMarkdownEditor\widgets;

use Hector68\GrafikartMarkdownEditor\assets\JSMarkdownEditorAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class MdEditor extends InputWidget
{

    public $jsOptions = [];

    public $uploader = false;

    public $preview = false;

    public $images = [];


    public function run()
    {
        JSMarkdownEditorAsset::register($this->getView());
        $class = 'mdeditor_' . $this->id;

        $jsOptions = ArrayHelper::merge(
            $this->jsOptions,
            [
                'uploader' => $this->uploader,
                'preview' => $this->preview,
                'images' => $this->images,
                'uploaderData' => [
                    '_csrf' => \Yii::$app->request->getCsrfToken()
                ]
            ]
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