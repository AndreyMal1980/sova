<?php

class SertificateController extends Controller {

    public function actionIndex() {
        /*
         $tree = new Tree();
                            $my_data = $tree->outTree($user_id, 0);
                            $dataCountLineUsers = $tree->getLineAndCountUsers($my_data);
                            $dataCountLineUsers2 = $tree->getLineAndCountUsers2($dataCountLineUsers);
                            
                             echo '</br>';  echo '</br>';  echo '</br>';
                             echo '<pre>';
                             print_r($dataCountLineUsers2);
                             echo '</pre>';
        */
        
 /*
                 $marketing = new Marketing;         
         echo '</br>';  echo '</br>';  echo '</br>';
         echo '<pre>';
         print_r($marketing);
         echo '</pre>';
        */
        
        
        if (isset($_POST['Users']) && isset($_POST['yt1'])) {
            foreach ($_POST['checked'] as $value) {
                $checked = Users::model()->findByPk($value);
                // print_r(Users::model()->getCountUsersAndSumPayToLine());
                //if ($checked->validate()) {
                  //  if ($checked->save()) {
                        
                            $tree = new Tree();
                            $my_data = $tree->outTree($_POST['checked'][0], 0);
                            $dataCountLineUsers = $tree->getLineAndCountUsers($my_data);
                            $dataCountLineUsers2 = $tree->getLineAndCountUsers2($dataCountLineUsers);
                            /*
                             echo '</br>';  echo '</br>';  echo '</br>';
                             echo '<pre>';
                             print_r($dataCountLineUsers2);
                             echo '</pre>';
                            */
                          $marketing = new Marketing;
                          $checked->status_id = $marketing->definitionStatusUser($checked->share,$checked->sertificate,$dataCountLineUsers2);
                      
         echo '</br>';  echo '</br>';  echo '</br>';
         echo '<pre>';
         print_r($checked->status_id);
         echo '</pre>';
             
                        //  $checked->sertificate = 1;
                  if($checked->save()){
       
                        

        
                        Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Сертификаты пользователям успешно добавлены.');
                    } else {
                        Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
                    }
                }
            }
        
        $model = new Users('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Users']))
            $model->attributes = $_GET['Users'];
        $this->render('index', array(
            'model' => $model,
        ));
    }
}

?>
