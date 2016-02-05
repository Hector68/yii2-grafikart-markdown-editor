<?php
namespace Hector68\GrafikartMarkdownEditor\controllers;

use Hector68\GrafikartMarkdownEditor\Module;
use yii\base\DynamicModel;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;


class UploadController extends Controller
{


    public function actionData()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        if (\Yii::$app->request->isPost) {
            /**@var Module $module */
            $module = Module::getInstance();
            $model = new DynamicModel([
                'file' => null
            ]);
            $model->addRule(
                'file',
                'file',
                [
                    'extensions' => $module->expansions,
                    'maxSize' => $module->maxSize
                ]
            );

            $model->file = UploadedFile::getInstanceByName('image');
            if ($model->validate()) {
                if (!is_dir(\Yii::getAlias($module->uploadDir))) {
                    FileHelper::createDirectory(\Yii::getAlias($module->uploadDir));
                }

                $oldFileName = $model->file->name;
                $newFileName = $module->isFileNameUnique ? uniqid() . '.' . $model->file->extension : $oldFileName;
                $newFullFileName = \Yii::getAlias($module->uploadDir) . DIRECTORY_SEPARATOR . $newFileName;
                if ($model->file->saveAs($newFullFileName)) {
                    return [
                        'id' => $oldFileName,
                        'url' =>  \Yii::$app->request->getHostInfo(). str_replace('@webroot', '', $module->uploadDir).'/' .
                            $newFileName
                    ];
                }
            }


        }

        throw new BadRequestHttpException();


    }


}