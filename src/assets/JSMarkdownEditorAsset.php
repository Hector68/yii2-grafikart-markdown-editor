<?php

namespace Hector68\GrafikartMarkdownEditor\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JSMarkdownEditorAsset extends AssetBundle
{

    public $js = [
        'js/codemirror.js',
        'js/mdeditor.js',
    ];

    public $css = [
        'css/mdeditor.css',
    ];

    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . DIRECTORY_SEPARATOR . '/';
    }

    public $depends = [
        JqueryAsset::class,
        BowerAsset::class
    ];

}