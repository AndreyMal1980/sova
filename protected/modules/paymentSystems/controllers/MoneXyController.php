<?php

class MoneXyController extends Controller {

    public function actionIndex() {

          $session = new CHttpSession;
          $session->open();
         
          $programm = Programms::model()->findByPk($session['payToUsers']);
       /*
        echo '</br>';
        echo '</br>';
        echo '</br>';
        echo '<pre>';
        print_r($session['programmName']);
        echo '</pre>';
*/
        $this->render('index', array('programm' => $programm, 'userName' => $session['name']));
    }

}

?>
