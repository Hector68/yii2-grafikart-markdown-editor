<?php

namespace Hector68\GrafikartMarkdownEditor;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{

    public $uploadDir = '@webroot/images/markdown';

    public $isFileNameUnique = true;

    public $maxSize = 2097152;

    public $expansions = ['jpg', 'png'];

}