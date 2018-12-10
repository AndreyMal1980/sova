<?php

class UsersController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'UserDataByMonth', 'GetUserDataByPeriod', 'PaymentPay', 'ViewUser', 'Marketing'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'UserDataByMonth', 'GetUserDataByPeriod'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'UserDataByMonth', 'GetUserDataByPeriod'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionViewUser($user_id) {

        $model = new Users;
        $parentUserName = $model->getParentUserName($user_id);
        $count = $model->countChildrenUserAdmin($user_id);

         $model = Users::model()->findByPk($user_id);
        
        $tree = new Tree();
        $my_data = $tree->outTree($user_id, 0);
        $dataCountLineUsers = $tree->getLineAndCountUsers($my_data);
        $dataCountLineUsers2 = $tree->getLineAndCountUsers2($dataCountLineUsers);
      
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id' => $user_id);
        $modelPayToUser = PayToUser::model()->with('pay')->with('programm')->findAll($criteria);
        /*
        echo '</br>';echo '</br>';
        echo '<pre>';
        print_r($user_id);
        echo '</pre>';
        */
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $this->render('viewUser', array(
            'model' => $model,'modelPayToUser' => $modelPayToUser, 'parentUserName' => $parentUserName, 'count' => $count, 'my_data' => $my_data,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    /*
    public function actionPaymentPay($id) {
        $model = Users::model()->findByPk($id);
        $data['email'] = Yii::app()->params['PayPalEmail'];
        $this->render('paymentPay', array('model' => $model, 'data' => $data));
    }
     * 
     */

    public function actionUpdate($id) {

        $model = $this->loadModel($id);
        $password = $model->getUserPassword($model->user_id);
        $count = $model->countChildrenUser($id);
        
        $tree = new Tree();
        $my_data = $tree->outTree($user_id, 0);
        $dataCountLineUsers = $tree->getLineAndCountUsers($my_data);
        $dataCountLineUsers2 = $tree->getLineAndCountUsers2($dataCountLineUsers);
        $dataUser = $model->getDataUser($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            if ($password === crypt($model->password, Yii::app()->params['pasSalt'])) {
                $model->password = $password;
            } elseif ($password !== $model->password) {
                $model->password = crypt($model->password, Yii::app()->params['pasSalt']);
            }
            if ($model->save()) {
                $this->redirect(array('index', 'id' => $model->user_id));
            }
        }

        $this->render('update', array(
            'dataProvider' => $dataProvider, 'model' => $dataUser, 'my_data' => $my_data, 'count' => $count,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($id) {

        $model = new Users;

        $userRef = $model->getUserRef($id);
        // print_r($userRef);

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

        // echo mktime(0,0,0,9,30,2014);
        //echo date("Y.m.d",1412024400);

        if (Yii::app()->request->isAjaxRequest) {
            if ($userDataPeriod) {
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
        
        $model = Users::model()->findByPk($id);
        $count = $model->countChildrenUser($id);
        $parentUserName = $model->getParentUserName($id);
        $dataUser = $model->getDataUser($model->user_id);
  
        $tree = new Tree();
        $my_data = $tree->outTree($id, 0);
        $dataCountLineUsers = $tree->getLineAndCountUsers($my_data);
        $dataCountLineUsers2 = $tree->getLineAndCountUsers2($dataCountLineUsers);
       /*
        echo '</br>';   echo '</br>';
        echo '<pre>';
         print_r($my_data);
        echo '<pre>';
        * 
        */
        $dataProvider = new CActiveDataProvider('Users');

        $this->render('index', array(
            'dataProvider' => $dataProvider,'parentUserName' => $parentUserName, 'model' => $dataUser, 'my_data' => $my_data, 'count' => $count, 'id' => $id, 'userRef' => $userRef,
        ));
    }

    public function loadModel($id) {
        $model = Users::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Users $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
