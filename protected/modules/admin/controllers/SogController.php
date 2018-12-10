<?php

class SogController extends Controller {

     public function actionIndex() {

        $model = Sog::model()->findByPk(1);

        if (isset($_POST['Sog'])) {
            $model->attributes = $_POST['Sog'];

            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Соглашение успешно отредактировано.');
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('index', array('model' => $model));
    }
}