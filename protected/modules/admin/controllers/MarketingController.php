<?php

class MarketingController extends Controller {

    public function actionIndex() {

        $this->render('index');
    }

    public function actionAddMarketing() {
        $model = new Marketing;
        $marketing = $model->findAll();
        if ($marketing) {
            foreach ($marketing as $value) {
                
            }
            $this->redirect(array('marketing/edit/id/' . $value['id']));
        }
        if (isset($_POST['Marketing'])) {
            $model->attributes = $_POST['Marketing'];
            $model->date = time();
            if ($model->validate()) {
                $model->save();
                //Loger::addLog('добавление пользователя', array('new_user_id' => $model->user_id, 'new_user_email' => $model->email, 'new_user_name' => $model->name));
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Маркетинг план успешно добавлен.');
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('addMarketing', array('model' => $model));
    }

    public function actionEdit($id) {

        $model = Marketing::model()->findByPk($id);
        if (isset($_POST['Marketing'])) {
            $model->attributes = $_POST['Marketing'];

            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Маркетинг план успешно отредактирован.');
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('editMarketing', array('model' => $model));
    }

}