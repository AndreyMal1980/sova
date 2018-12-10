<?php

class StatusUserController extends Controller {

    public function actionAdd() {
        $model = new StatusUser;

        if (isset($_POST['StatusUser'])) {
            $model->attributes = $_POST['StatusUser'];
             if (isset($_POST['StatusUser']['settingLines'])) { // проверяем что хоть что-то пришло
                $model->settingLines =  $_POST['StatusUser']['settingLines'];
                $model->saveWithRelated('settingLines');
            }

            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Статус успешно добавлен.');
                $this->redirect(array('index', 'id' => $model->id));
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('add', array('model' => $model));
    }

    public function actionDelete() {
        $id = (int) ($_POST['id']);

        $model = StatusUser::model()->findByPk($id);
        if ($model->id > 0) {

            StatusUser::model()->deleteByPk($id);
            echo json_encode(array('error' => 0));
        } else {
            echo json_encode(array('error' => 1));
        }
    }

    public function actionIndex() {
        $model = StatusUser::model()->findAll($criteria);
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionEdit($id) {
        $model = StatusUser::model()->findByPk($id);
       
        if (isset($_POST['StatusUser'])) {
            $model->attributes = $_POST['StatusUser'];
             if (isset($_POST['StatusUser']['SettingLinesArray'])) { // проверяем что хоть что-то пришло
                $model->settingLines =  $_POST['StatusUser']['SettingLinesArray'];
                $model->saveWithRelated('settingLines');
             }

            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Статус успешно отредактирован.');
                $this->redirect(array('index', 'id' => $model->id));
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('edit', array('model' => $model,'a'=>$a));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'programms-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
