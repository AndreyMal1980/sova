<?php

class ProgrammsController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function actionAdd() {
        $this->pageTitle = 'Добавление пользователя';
        $model = new Programms;
        if (isset($_POST['Programms'])) {
            $model->attributes = $_POST['Programms'];
            $model->date = time();
            if ($model->validate()) {
                if ($model->save()) {
                    //Loger::addLog('добавление пользователя', array('new_user_id' => $model->user_id, 'new_user_email' => $model->email, 'new_user_name' => $model->name));
                    Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Программа успешно добавлена.');
                    $this->redirect('index');
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('add', array('model' => $model));
    }

    public function actionDelete() {
        $id = (int) ($_POST['id']);
        $model = Programms::model()->findByPk($id);
        if ($model->programm_id > 0) {
            Programms::model()->deleteByPk($id);
            echo json_encode(array('error' => 0));
        } else {
            echo json_encode(array('error' => 1));
        }
    }

    public function actionIndex() {
        $model = Programms::model()->findAll($criteria);
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionEdit($id) {

        $model = Programms::model()->findByPk($id);
        if (isset($_POST['Programms'])) {
            $model->attributes = $_POST['Programms'];
            $model->date = time();///mktime(0, 0, 0, $startDateMonth, $startDateDay, intval($startDateYear));
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Программа успешно отредактирована.');
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('edit', array('model' => $model));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'programms-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
