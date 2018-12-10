<?php

class MarketingController extends Controller {

    public function actionIndex() {
        $model = Marketing::model()->findAll();
        $this->render('index',array('model' => $model));
    }
}
?>