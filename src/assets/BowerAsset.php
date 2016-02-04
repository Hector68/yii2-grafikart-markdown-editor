<?php
namespace Hector68\GrafikartMarkdownEditor\assets;

use yii\web\AssetBundle;

class BowerAsset extends  AssetBundle
{

    public $sourcePath = '@bower';

    public $js = [
        'underscore/underscore-min.js',
        'marked/lib/marked.js',
        'dropzone/downloads/dropzone.min.js'
    ];

}