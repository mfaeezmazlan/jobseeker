<?php

namespace common\components;

use Yii;
use yii\web\UploadedFile;
use common\models\UserDoc;
use common\models\DocAttach;

class FileHandler {

    public static function generate($modelAttachment, $userId) {
        foreach ($_FILES as $cat => $file) {
            $filetype = $file['type']['file'];
        }
        $modelAttachment->file = UploadedFile::getInstance($modelAttachment, 'file');
        $modelAttachment->file_name = $modelAttachment->file->name;
        $modelAttachment->file_name_sys = Yii::$app->user->id . "_" . date('d-m-Y_H_i_s') . "." . $modelAttachment->file->extension;
        $modelAttachment->file_type = $filetype;

        $path = Yii::getAlias('@web') . "/uploads/resume/$userId";
        if (!is_dir($path)) {
            mkdir($path, 0755);
        }

        $modelAttachment->doc_title = $modelAttachment->file->name;
        $modelAttachment->file->saveAs("$path/" . Yii::$app->user->id . "_" . date('d-m-Y_H_i_s') . "." . $modelAttachment->file->extension);

        if ($modelAttachment->save()) {
            $modelUserDoc = new UserDoc();
            $modelUserDoc->user_id = $userId;
            $modelUserDoc->doc_attach_id = $modelAttachment->id;
            $modelUserDoc->save();
            return true;
        }
        return false;
    }

    public static function generateDocument($model, $documentPath, $sizeWidth = "100px") {
        $listOfAttachment = $model->doc;
        $imgString = null;
        foreach ($listOfAttachment as $attachment) {
            $docAttach = DocAttach::getImage($attachment->doc_attach_id, $documentPath, $sizeWidth);
            $imgString = $docAttach;
        }
        return $imgString;
    }

}
