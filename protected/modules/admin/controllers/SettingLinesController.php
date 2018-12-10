<?php

class SettingLinesController extends Controller {

    public function actionIndex() {
        $model = SettingLines::model()->findAll($criteria);
        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id) {

        $model = SettingLines::model()->findByPk($id);
        /*
          echo '</br>'; echo '</br>';echo '</br>';
          echo '<pre>';
          print_r($model);
          echo '</pre>';
         */
        if (isset($_POST['SettingLines'])) {
            $model->attributes = $_POST['SettingLines'];

             if (isset($_POST['SettingLines']['statusUsers'])) { // проверяем что хоть что-то пришло
                $model->statusUsers =  $_POST['SettingLines']['statusUsers'];
                $model->saveWithRelated('statusUsers');
             }
            
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Настройка линии успешно отредактирована.');
                $this->redirect(array('settingLines/index', 'id' => $model->id));
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('edit', array('model' => $model));
    }

    public function actionAdd() {
        $model = new SettingLines;
        $criteria = new CDbCriteria;
        $criteria->select = max_lines;
        $maxLines = LinesDescription::model()->find($criteria);
        /*
          echo '<br/>';  echo '<br/>';
          echo '<pre>';
          print_r($maxLines['max_lines']);
          echo '</pre>';
         * 
         */
        if (isset($_POST['SettingLines'])) {
            $model->attributes = $_POST['SettingLines'];
             
              if (isset($_POST['SettingLines']['statusUsers'])) { // проверяем что хоть что-то пришло
                $model->statusUsers =  $_POST['SettingLines']['statusUsers'];
                $model->saveWithRelated('statusUsers');
             }
            
            
            $model->line = $_POST['SettingLines']['line'] + 1;
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Новая линия успешно добавлена.');
                $this->redirect(array('settingLines/index', 'id' => $model->id));
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('add', array('model' => $model, 'maxLines' => $maxLines['max_lines']));
    }

    public function actionDelete() {
       $id = (int) ($_POST['id']);
       // $id = 49;
        $model = SettingLines::model()->findByPk($id);
        
       // echo '</br>';  echo '</br>';  echo '</br>';
       // echo '<pre>';
     //   print_r($id);
       // echo '</pre>';
        
        if ($model->id > 0) {
            SettingLines::model()->deleteByPk($id);
            echo json_encode(array('error' => 0));
        } else {
            echo json_encode(array('error' => 1));
        }
    }
}

?>
