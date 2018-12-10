<?php

class DownloadController extends Controller {

    public function actionIndex() {
        $path = Yii::getPathOfAlias('webroot') . "/downloads/files/statement.docx";
        if (!file_exists($path)) {
            echo '<strong>Ошибка!</strong> файла не существует';
        } else {
            return Yii::app()->getRequest()->sendFile('statement.docx', @file_get_contents($path));
        }
    }

}
?>