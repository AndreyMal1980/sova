<?php

class SettingAccountController extends Controller {

    public function actionEdit($id) {
        $model = SettingAccount::model()->findByPk($id);
        if (isset($_POST['SettingAccount'])) {
            $model->attributes = $_POST['SettingAccount'];
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

?>
