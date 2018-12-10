<?php
class PayToUserController extends Controller {
    
     public $layout = '//layouts/dividends';
     
    public function actionIndex() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id' => Yii::app()->user->getId());
        $model = PayToUser::model()->with('pay')->with('programm')->findAll($criteria);
        /*
        echo'</br>'; echo'</br>';
        echo '<pre>';
        print_r($model);
        echo '</pre>';
       */
        $this->render('index',array('model' => $model));
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
