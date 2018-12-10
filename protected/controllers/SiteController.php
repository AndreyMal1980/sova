<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actionRegistrationRef() {
        $modelSog = new Sog;
        $sogText;
        $error;
        foreach ($modelSog->findAll() as $value) {
            $sogText = $value['description'];
        }

        if (isset($_GET['number_ticket'])) {
            $session = new CHttpSession;
            $session->open();
            $session['number_ticket'] = $_GET['number_ticket'];
        }
        $this->render('registrationPath1', array('model' => $modelSog, 'sogText' => $sogText));
    }

    public function actionSucessPay() {

        if (isset($_POST)) {

            if ($_POST['myMonexyMerchantID'] == 104184160 && $_POST['myMonexyMerchantShopName'] == 'sova' && $_POST['myMonexyMerchantStatus'] == 1) {

                $session = new CHttpSession;
                $session->open();

                $model = new Users;
                $model->name = $session['name'];
                $model->surname = $session['surname'];
                $model->password = crypt($session['password'], Yii::app()->params['pasSalt']);
                $model->email = $session['email'];
                $model->city = $session['city'];
                $model->phone = $session['phone'];
                $model->payToUsers = $session['payToUsers'];
                $model->number_ticket_change = $session['number_ticket_change'];
                $model->parent_id = $session['parent_id'];
                $model->role = $session['role'];
                $model->share = $_POST['myMonexyMerchantSum'];
                $model->saveWithRelated('payToUsers');
                /*
                  echo '</br>';echo '</br>'; echo '</br>';
                  echo '<pre>';
                  print_r($session['number_ticket_change']);
                  print_r($session['programms']);
                  echo '</pre>';
                 */
                if ($model->save()) {

                    if (isset($_POST['programmToPay'])) {
                        Yii::app()->user->setFlash('success',$session['name']. ' Вы успешно оплатили паевой взнос по программе' . $_POST['programmToPay']);
                        $session = new CHttpSession;
                        $session->open();
                        echo $_POST['programmToPay'];
                    }

                    $tree = new Tree;
                    $dataMaxLines = $tree->outTree($model->getIdMainUser(), 0);
                    $dataMaxLines2 = $tree->getLineAndCountUsers($dataMaxLines);
                    $dataMaxLines3 = $tree->getMaxLevel($dataMaxLines2);
                    $lines = LinesDescription::model()->findByPk(1);
                    $lines->max_lines = $dataMaxLines3;
                    $lines->save();

                    $this->redirect(array('registrationOk', 'userName' => $session['name']));
                }
            }
        }
    }

    public function actionFailPay() {
        $session = new CHttpSession;
        $session->open();
        $query = Yii::app()->db->CreateCommand("select `email` from users where number_ticket=" . $session['number_ticket']);
        $result = $query->queryScalar();
        $string = 'Фамилия - ' . $session['surname'] . ' ' . 'Имя - ' . $session['name'] . ' ' . 'телефон - ' . $session['phone'] . ' ' . 'email - ' . $session['email'] . ' ' . 'город - ' . $session['city'];
        // print_r($textOfTheLettr->description);
        $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
        $subject = '=?UTF-8?B?' . base64_encode('Данные пользователя не оплатившего пай при регистрации') . '?=';
        $headers = "From: $name <{$model->email}>\r\n" .
                "Reply-To: {$model->email}\r\n" .
                "MIME-Version: 1.0\r\n" .
                "Content-Type: text/plain; charset=UTF-8";

        mail($result, $subject, $string, $headers);
        Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Взнос не был зачислен');
        $this->redirect(array('/paymentSystems/MoneXy', 'id' => $model->user_id));
    }

    public function actionRegistrationRef2() {


        $session = new CHttpSession;
        $session->open();

        //$query = Yii::app()->db->CreateCommand("select `email` from users where number_ticket=".$session['number_ticket']);
        // $result = $query->queryScalar();

        $model = new Users;
        $model->getReadOnlyToRegistration($session['number_ticket'], $readOnly);

        if (isset($_POST['Users'])) {
            $session = new CHttpSession;
            $session->open();

            $model->scenario = 'registrationRef2';
            $model->attributes = $_POST['Users'];

            $session['name'] = $_POST['Users']['name'];
            $session['surname'] = $_POST['Users']['surname'];
            $session['number_ticket_change'] = $_POST['Users']['number_ticket_change'];
            $session['parent_id'] = $model->getIdUserToNumberTicket($model->numberTicket);
            $session['password'] = $model->password;
            $session['role'] = 'user';
            $session['email'] = $_POST['Users']['email'];
            $session['city'] = $_POST['Users']['city'];
            $session['phone'] = $_POST['Users']['phone'];
            $session['payToUsers'] = $_POST['Users']['payToUsers'];


            $model->number_ticket_change = $_POST['Users']['number_ticket_change'];
            $model->parent_id = $model->getIdUserToNumberTicket($model->numberTicket);
            //$model->image = CUploadedFile::getInstance($model, 'image');
            //$model->date = time();
            //$session['date'] = time();
            $model->password = $model->password;
            // $model->programms = $model->programms;
            $model->role = 'user';
            // echo '</br>'; echo '</br>';
            //print_r($_POST['Users']['payToUsers']);
            // $falename = $currentDate2 . '_' . iconv("utf-8", "cp1251", $model->name) . '.docx'; /* здесь изменить */
            // $path = Yii::getPathOfAlias('webroot') . "/upload/userfiles/files/" . $falename;
            /*
              if (isset($_POST['Users']['programmsArray'])) { // проверяем что хоть что-то пришло
              $model->programms = $_POST['Users']['programmsArray'];
              $session['programms'] = $_POST['Users']['programmsArray'];

              echo '</br>';  echo '</br>';
              echo '<pre';
              print_r($session['programms']);
              echo '</pre';

              //$model->saveWithRelated('programms');
              }
             */
            if ($model->validate('registrationRef2')) {
                $this->redirect('/index.php/paymentSystems/'); //раскоментить для перехода на страницу оплаты
  $this->redirect('/index.php/SucessPay/');

                // $model->number_ticket = NULL;
                //$session['number_ticket'] = NULL;
                //$model->password = crypt($model->password, Yii::app()->params['pasSalt']);
                // $session['password'] = crypt($session['password'], Yii::app()->params['pasSalt']);
                /*
                  if ($model->save()) {
                  $tree = new Tree;
                  $dataMaxLines = $tree->outTree($model->getIdMainUser(), 0);
                  $dataMaxLines2 = $tree->getLineAndCountUsers($dataMaxLines);
                  $dataMaxLines3 = $tree->getMaxLevel($dataMaxLines2);
                  $lines = LinesDescription::model()->findByPk(1);
                  $lines->max_lines = $dataMaxLines3;
                  $lines->save();
                  $this->redirect(array('registrationOk', 'id' => $model->user_id));
                  }
                 * 
                 */
            }
        }

        /*

          $textOfTheLettr = TextOfTheLetter::model()->findByPk(1);
          // print_r($textOfTheLettr->description);
          $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
          $subject = '=?UTF-8?B?' . base64_encode($model->surname) . '?=';
          $headers = "From: $name <{$model->email}>\r\n" .
          "Reply-To: {$model->email}\r\n" .
          "MIME-Version: 1.0\r\n" .
          "Content-Type: text/plain; charset=UTF-8";

          mail(Yii::app()->params['adminEmail'], $subject, $textOfTheLettr->description, $headers);
         */

        $this->render('registrationUserRef', array(
            'model' => $model, 'readonly' => $readonly,
        ));
    }

    /*
      public function actionRegistration() {

      $model = new Users;
      $currentDate = str_replace("-", "_", $model->currentDate());
      $currentDate1 = str_replace(":", "_", $currentDate);
      $currentDate2 = str_replace(" ", "_", $currentDate1);

      $m = array();
      if (isset($_POST['Users'])) {
      $model->scenario = 'registration';
      $model->attributes = $_POST['Users'];
      $model->number_ticket_change = $_POST['Users']['number_ticket_change'];
      $model->parent_id = $model->getIdUserToNumberTicket($model->numberTicket);
      $model->image = CUploadedFile::getInstance($model, 'image');
      $model->date = time();
      $model->password = $model->password;
      $model->programms = $model->programms;
      $model->role = 'user';

      $falename = $currentDate2 . '_' . iconv("utf-8", "cp1251", $model->surname) . '.docx';
      $path = Yii::getPathOfAlias('webroot') . "/upload/userfiles/files/" . $falename;

      if ($_POST['Users']['programms']) { // проверяем что хоть что-то пришло
      $m = $_POST['Users']['programms'];
      $model->programms = $m;
      $model->saveWithRelated('programms');
      }
      if ($model->validate('registration')) {
      $model->number_ticket = NULL;
      $model->password = crypt($model->password, Yii::app()->params['pasSalt']);
      if ($model->save()) {
      $model->image->saveAs($path);
      $tree = new Tree;
      $dataMaxLines = $tree->outTree($model->getIdMainUser(), 0);
      $dataMaxLines2 = $tree->getLineAndCountUsers($dataMaxLines);
      $dataMaxLines3 = $tree->getMaxLevel($dataMaxLines2);
      $lines = LinesDescription::model()->findByPk(1);
      $lines->max_lines = $dataMaxLines3;
      $lines->save();
      $this->redirect(array('registrationOk', 'id' => $model->user_id));
      }
      }
      }

      //Mailer::newMail($EmailList, $theme, $bodyText);
      $this->render('registrationUser', array(
      'model' => $model,
      ));
      }
     */

    public function actionRegistrationOk() {
        $this->render('registrationOk');
    }

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        // $this->layout = 'mainPage';
        //$this->pageTitle = 'upline24';
        //Yii::app()->theme = 'classic';

        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}