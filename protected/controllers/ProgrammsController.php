<?php

class ProgrammsController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column3';

    public function actionIndex() {
        $model = Programms::model()->findAll();
        $this->render('index', array('model' => $model));
    }

    public function actionProgrammPay($id) {
        $model = Programms::model()->findByPk($id);
        $session = new CHttpSession;
        $session->open();
        $session['programmName'] = $model['name'];


      //  echo '</br>';
       // echo '</br>';
       // echo 'kkk6464646';
        $modelPay = new Pay;
        $modelPay->date = time();
        $modelPay->pay = 1300;
         
      // if($modelPay->save())
        
           
        $modelPayToUser = new PayToUser;
        $modelPayToUser->user_id = Yii::app()->user->getId();
        $modelPayToUser->programm_id = $model->programm_id;
        $query =  Yii::app()->db->createCommand('Select LAST_INSERT_ID() from pay limit 1');
        $pay_id = $query->queryScalar();
        $modelPayToUser->pay_id = $pay_id;
        //$modelPayToUser->saveWithRelated('user');
       // $model->saveWithRelated('programm');
        // $modelPayToUser->save();
        
      
      
        /*
          echo '</br>'; echo '</br>';
          echo '<pre>';
          print_r($pay_id);
          echo '</pre>';
      */
        $this->render('programmPay', array('model' => $model));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'programms-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
