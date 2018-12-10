<?php

class DefaultController extends Controller {

    public function actionIndex() {

        //$this->pageTitle = 'CMS ALTADMIN';
        if (Yii::app()->user->isGuest || (Yii::app()->user->role != 'admin' && Yii::app()->user->role != 'root')) {/*
          Yii::app()->theme = 'enter-admin';
          $model = new LoginForm;
          if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
          echo CActiveForm::validate($model);
          Yii::app()->end();
          }
          if (isset($_POST['LoginForm'])) {
          $model->attributes = $_POST['LoginForm'];
          if ($model->validate() && $model->login()) {
          $this->redirect('/admin/');
          }
          }
          $this->render('login', array('model' => $model)); */
            //   echo 'hjhjhjh';
            Yii::app()->theme = 'classic';
            throw new CHttpException(403, 'Указанная запись не найдена');
            //$this->render('site.error'); 
            //$this->render('index');
            //$this->render('index');
            $this->render('/site/403', array('model' => $model));
        } else {
           
            /*
              echo 'jbhnbjkbjk';
              echo '<br/>';
              echo '<br/>';
              print_r(Yii::app()->user->role); */
           $this->render('index',array('dataMaxLines3'=>$dataMaxLines3));
        }
    }

}