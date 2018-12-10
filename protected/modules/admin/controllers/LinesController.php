<?php

class LinesController extends Controller {

    public function actionIndex() {
        $model = SettingLines::model()->findAll();
        $this->render('index', array('model' => $model));
    }

    public function actionAdd() {
        $model = new SettingLines;
        $tree = new Tree;
        $tree->outTree(Users::getIdMainUser(), 0);
        $array = array();
        $lines = array();
           $a=array();
        $query = Yii::app()->db->createCommand('select line from setting_lines');
        
        
        $arrayIssetLines = $query->queryAll();
        foreach ($arrayIssetLines as $value) {
            $array[] = $value['line'];
        }

        for ($i = 1; $i <= $tree->max; $i++) {
            $lines[] = $i;
        }

        for ($j = 0; $j <= count($array); $j++) {
            for ($i = 0; $i <= $tree->max; $i++) {
                if ($lines[$i] == $array[$j]) {
                    unset($lines[$i]);
                 
                }
            }
        }
                foreach ($lines as $value) {
            $a[] = array('number' => $value);
        }
              /*
               echo '</br>';echo '</br>';
               echo '<pre>';
               print_r($a);
              echo '</pre>';
            */
        if (isset($_POST['SettingLines'])) {
            $model->count_users = $_POST['SettingLines']['count_users'];
            $model->sum_pay = $_POST['SettingLines']['sum_pay'];
            $model->line = $_POST['SettingLines']['line'];
            /*
            echo '</br>';echo '</br>';
           print_r($_POST['SettingLines']['line']);
*/
            if ($model->validate()) {
            
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Линия успешно добавлена.');
                    $this->redirect(array('index', 'id' => $model->id));
                } else {
                    Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
                }
            }
        }

        $this->render('add', array('model' => $model, 'lines' => $lines,'a' => $a));
    }

}

?>
