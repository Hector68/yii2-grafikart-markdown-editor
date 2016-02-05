# MARKDOWN EDITOR
### base on https://github.com/Grafikart/JS-Markdown-Editor js widget
About Markdown:
- [English](https://en.wikipedia.org/wiki/Markdown)
- [Russian](https://ru.wikipedia.org/wiki/Markdown)

## Installation

```
php composer.phar require --prefer-dist hector68/yii2-grafikart-markdown-editor
```

or add

```
"hector68/yii2-grafikart-markdown-editor" : "^0.1"
```
o the require section of your composer.json file.



if need upload images on server when include module to your config
```php
    'modules' => [
        'markdown-editor' => [
            'class' => 'Hector68\GrafikartMarkdownEditor\Module',
            'uploadDir' => '@webroot/images/markdown',
            'isFileNameUnique' => true, //set unique name or use base name,
            'maxSize' => 2097152, // in bites, Default 2mb
            'expansions' => ['jpg', 'png'] 
        ],
    ],
    ...
```

## Form
```php
  <?= $form->field($model, 'firstMessage')->widget(Hector68\GrafikartMarkdownEditor\widgets\MdEditor::className(), [
            'uploader' => Url::to(['markdown-editor/upload/data']), //or false. Default false
            'preview' => true, // default false,
            'jsOptions' => [], // js options of widget. See https://github.com/Grafikart/JS-Markdown-Editor,
            'images' => [], //Default images See https://github.com/Grafikart/JS-Markdown-Editor,
        ]) ?>
```
## Render
```php
$parser = new cebe\markdown\Markdown();
echo $parser->parse($model->firstMessage);
```
