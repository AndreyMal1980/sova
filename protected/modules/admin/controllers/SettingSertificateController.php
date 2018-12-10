<?php

class SettingSertificateController extends Controller {

    public function actionEdit($id) {
        $model = SettingSertificate::model()->findByPk($id);
        if (isset($_POST['SettingSertificate'])) {
            $model->attributes = $_POST['SettingSertificate'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Настройка успешно отредактирована.');
                //$this->redirect(array('/statusSettings/index', 'id' => $model->id));
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('edit', array('model' => $model));
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
