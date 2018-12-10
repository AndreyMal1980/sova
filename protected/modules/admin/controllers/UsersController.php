<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author Андрей
 */
class UsersController extends Controller {

    public function actionIndex() {

        $tree = new Tree();
        $my_data = $tree->outTree(0, 0); //Выводим дерево
        /*
          echo '</br>'; echo '</br>'; echo '</br>';
          echo '<pre>';
          print_r($my_data);
          echo '</pre>';
         */
        $model = new Users;
     
        $allCountUsers = Users::model()->countBySql('select count(*) from users');
        $this->render('index', array(
            'dataProvider' => $dataProvider, 'my_data' => $my_data, 'allCountUsers' => $allCountUsers,
            'dataMaxLines3' => $dataMaxLines3
        ));
    }

    public function loadModelUsers($id) {
        $model = Users::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionlistUserTable() {
        $model = new Users;
        $allCountUsers = Users::model()->countBySql('select count(*) from users');
        $model = Users::model()->findAll();
        $this->render('listUserTable', array('model' => $model, 'allCountUsers' => $allCountUsers));
    }

    public function actionAddUser() {

        $tree = new Tree();
        $my_data = $tree->outTree(0, 0);
        $model = new Users;
 
        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            /*
             if (isset($_POST['Users']['programmsArray'])) { // проверяем что хоть что-то пришло
                $model->programms = $_POST['Users']['programmsArray'];
                $model->saveWithRelated('programms');
            }
*/
            $model->number_ticket_change = $_POST['Users']['number_ticket_change'];
            $model->numberTicket = $_POST['Users']['number_ticket'];
            $model->parent_id = $model->getIdUserToNumberTicket($model->number_ticket_change);
            $model->date = time();
            $model->role = 'user';
            $number_ticket = $_POST['Users']['number_ticket'];

            if ($number_ticket != 0)
                $model->user_ref = $model->user_ref = 'http://sova:8080/site/registrationRef?number_ticket=' . $number_ticket;;

            if ($model->validate()) {
                $model->password = crypt($model->password, Yii::app()->params['pasSalt']);
                //$model->number_ticket = NULL;
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Пользователь успешно добавлен.');
                    $this->redirect(array('addUser', 'id' => $model->user_id));
                } else {
                    Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
                }
            }
        }

       // $dataMaxLines = $tree->outTree($model->getIdMainUser(), 0);
       // $dataMaxLines2 = $tree->getLineAndCountUsers($dataMaxLines);
       // $dataMaxLines3 = $tree->getMaxLevel($dataMaxLines2);
       // $lines = LinesDescription::model()->findByPk(1);
       // $lines->max_lines = $dataMaxLines3;
       // $lines->save();

        $this->render('addUser', array(
            'model' => $model, 'my_data' => $my_data,
        ));
    }

    public function actionViewUser($user_id) {

        $model = new Users;
        $userRef = $model->getUserRef($user_id);
        /*
          echo '</br>';
          echo '</br>';
          echo '</br>';
          echo '55';
          echo '<pre>';
          print_r($model->programms_array);
          echo '</pre>';
          // echo 'gjfhgjf';
         */

        $startDate = explode('.', Yii::app()->request->getPost('startDate'));
        $endDate = explode('.', Yii::app()->request->getPost('endDate'));
        $startDateYear = $startDate[0];
        $startDateMonth = $startDate[1];
        $startDateDay = $startDate[2];
        $endDateYear = $endDate[0];
        $endDateMonth = $endDate[1];
        $endDateDay = $endDate[2];
        $startDateA = mktime(0, 0, 0, $startDateMonth, $startDateDay, intval($startDateYear)); //unix время в зависимости от введенной даты       
        $endDateA = mktime(0, 0, 0, $endDateMonth, $endDateDay, intval($endDateYear)); //unix время в зависимости от введенной даты    
        $userDataPeriod = $model->DataUserByPeriod($startDateA, $endDateA, $id);
//print_r($userDataPeriod);
        // echo mktime(0,0,0,9,30,2014);
        //echo date("Y.m.d",1412024400);

        if (Yii::app()->request->isAjaxRequest) {
            if ($userDataPeriod) {
                echo '<br/>';
                echo 'За данный период приглашены: ' . '<hr/>';
                foreach ($userDataPeriod['name'] as $name) {
                    echo CHtml::encode($name) . '<br/>';
                }
                echo '<hr/>';
            }
            else
                echo 'Нет приглашенных в данный период';
            Yii::app()->end();
        }

        $parentUserName = $model->getParentUserName($user_id);

        $count = $model->countChildrenUserAdmin($user_id);

        $tree = new Tree();
        $my_data = $tree->outTree($user_id, 0);
        $dataCountLineUsers = $tree->getLineAndCountUsers($my_data);
        $dataCountLineUsers2 = $tree->getLineAndCountUsers2($dataCountLineUsers);

       // $dataMaxLines = $tree->outTree(214, 0);
        //$dataMaxLines2 = $tree->getLineAndCountUsers($dataMaxLines);
       // $dataMaxLines3 = $tree->getMaxLevel($dataMaxLines2);

        $model = Users::model()->findByPk($user_id);
        $marketing = new Marketing;

        //$model->status_id = $marketing->definitionStatusUser($model->share,$dataCountLineUsers2);
        $model->save();
        $statusUser = $model->getStatusUser($user_id);
        /*
          echo '</br>';
          echo '</br>';
          echo '<pre>';
          print_r($dataCountLineUsers2);
          echo '</pre>';
         */
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $this->render('viewUser', array(
            'model' => $model, 'parentUserName' => $parentUserName, 'count' => $count,
            'my_data' => $my_data, 'userRef' => $userRef, 'data' => $data,
            'dataCountLineUsers2' => $dataCountLineUsers2, 'dataCountLineUsers' => $dataCountLineUsers,
            'statusUser' => $statusUser,
        ));
    }

    public function actionEditUser($id) {
        $model = $this->loadModelUsers($id);
        $model = new Users;
        $dataRegistrations = $model->getUserDateRegistration($id);
        $model = Users::model()->findByPk($id);
        $password = $model->getUserPassword($model->user_id);
        $tree = new Tree();
        $my_data = $tree->outTree(0, 0);
        /*
          echo '</br>';echo '</br>';
          echo '<pre>';
          print_r($my_data);
          echo '</pre>';
         */
        /*
             echo '</br>';echo '</br>';
          echo '<pre>';
         $model->getProgrammsArray();
          echo '</pre>';
        */
        
        
        if (isset($_POST['Users'])) {
              $model->attributes = $_POST['Users'];
                /*
            if (isset($_POST['Users']['programmsArray'])) { // проверяем что хоть что-то пришло
                $model->programms = $_POST['Users']['programmsArray'];
              
                  echo '</br>';  echo '</br>';
                  echo '<pre';
                  print_r($model->programms);
                  echo '</pre';
               
                $model->saveWithRelated('programms');
            }
              * 
                 */
            $number_ticket_change = $_POST['Users']['number_ticket_change'];
            if ($password === crypt($model->password, Yii::app()->params['pasSalt'])) {
                $model->password = $password;
            } elseif ($password !== $model->password) {
                $model->password = crypt($model->password, Yii::app()->params['pasSalt']);
            }
            $dateRegistrations = explode('.', $_POST['Users']['date']);
            $DateYear = $dateRegistrations[0];
            $DateMonth = $dateRegistrations[1];
            $DateDay = $dateRegistrations[2];
            $dateRegistrationsSave = mktime(0, 0, 0, $DateMonth, $DateDay, intval($DateYear));
            $model->date = $dateRegistrationsSave;

            // $number_ticket_change = Users::model()->findBySql('select number_ticket from users where user_id='.$number_ticket_change_id);
            // print_r($number_ticket_change['number_ticket']);
            $model->number_ticket_change = $number_ticket_change;
            //echo $model->number_ticket_change;
            $model->parent_id = $model->getIdUserToNumberTicket($number_ticket_change);

            $parentUserName = Users::model()->findBySql('select name from users where user_id=' . $model->parent_id);
            if ($_POST['Users']['number_ticket'])
                $model->user_ref = 'http://sova:8080/index.php/site/registrationRef?number_ticket=' . $model->attributes['number_ticket'];

            if ($model->validate()) {
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Пользователь успешно отредактирован.');
                    $this->redirect(array('viewUser', 'user_id' => $model->user_id));
                } else {
                    Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
                }
            }
        }
        $this->render('editUser', array(
            'model' => $model, 'my_data' => $my_data, 'data' => $data, 'parentUserName' => $parentUserName, 'dataRegistrations' => $dataRegistrations,
        ));
    }

    public function actionDeleteUser($id) {
        /*
        if ($this->loadModelUsers($id)->with('programms')->delete()) {
            Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Пользователь успешно удален.');
            Yii::app()->user->logout();
        }
         * 
         */
        $tree = new Tree;
        $model = new Users;
        $dataMaxLines = $tree->outTree($model->getIdMainUser(), 0);
        $dataMaxLines2 = $tree->getLineAndCountUsers($dataMaxLines);
        $dataMaxLines3 = $tree->getMaxLevel($dataMaxLines2);
        $lines = LinesDescription::model()->findByPk(1);
        $lines->max_lines = $dataMaxLines3;
        $lines->save();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function actionAutoCompleteUser() {

        if (Yii::app()->request->isAjaxRequest && isset($_GET['q'])) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'sertificate=:sertificate and surname LIKE :surname';
            $criteria->params = array('sertificate' => 0, ':surname' => $_GET['q'] . '%');

            if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
                $criteria->limit = $_GET['limit'];
            }
            $surname = Users::model()->findAll($criteria);
            $resStr = '';
            foreach ($surname as $surname) {
                $resStr .= $surname->surname . "\n";
            }
            echo $resStr;
        }
    }
}