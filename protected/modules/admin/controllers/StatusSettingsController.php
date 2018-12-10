<?php
class StatusSettingsController extends Controller {
    
    public function actionIndex(){
        
        $modelSettingAccount = SettingAccount::model()->findAll();
        $modelLinesDescription = LinesDescription::model()->findAll();
        $modelSettingSertificate = SettingSertificate::model()->findAll();
        /*
        echo'<br>';  echo'<br>';  echo'<br>';
        echo '<pre>';
        print_r($modelSettingSertificate);
        echo '</pre>';
        */
        $this->render('index',array('modelSettingAccount' => $modelSettingAccount,
                                    'modelLinesDescription' => $modelLinesDescription,
                                    'modelSettingSertificate' => $modelSettingSertificate));
    }
}
?>
