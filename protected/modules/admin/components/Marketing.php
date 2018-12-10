<?php

class Marketing {

    private $settings_arr = array();
   // public $lines_arr = array();

    public function __construct() {
        //В переменную $settings_arr записываем все настройки (см. ниже)
        $this->settings_arr = $this->getSettings();
      //  $this->lines_arr = $this->getLines();
        /*
          echo '</br>';    echo '</br>';    echo '</br>';
          echo '<pre>';
          print_r($this->settings_arr);
          echo '</pre>';
         * 
         */
    }

    private function getLines() {
          $settingLinesArray = StatusUser::model()->with('settingLines')->findAll(); //надо проверить сть ли для этого стауса линия
          $return = array();
        foreach ($settingLinesArray as $status_id => $value) {
            $return[$value['id']] = $value['settingLines'];
        }
        return $return;
    }

        private function getSettings() {
        $settingsArray = array();
        $settingsArrayAccount = array();
        $settingsArraySertificate = array();

        $settingsArrayAccount = SettingAccount::model()->with('status')->findAll();
        $settingsArraySertificate = SettingSertificate::model()->with('status')->findAll();
        $settingLinesArray = StatusUser::model()->with('settingLines')->findAll(); //надо проверить сть ли для этого стауса линия

        $return = array();
        foreach ($settingLinesArray as $status_id => $value) {
            $return[$value['id']] = $value['settingLines'];
        }

        /*

          echo '</br>';    echo '</br>';    echo '</br>';
          echo '<pre>';
          print_r($return);
          echo '</pre>';
         */
        foreach ($settingsArrayAccount as $value) {
            /*
              echo '</br>';    echo '</br>';    echo '</br>';
              echo '<pre>';
              print_r($value->status->id);
              echo '</pre>';

             */
            $statusId = $value->status->id;
            $statusUser = $value->status->name;
            $min = $value->min;
            $max = $value->max;

            /*
              echo '</br>';    echo '</br>';    echo '</br>';
              echo '<pre>';
              print_r($statusId);
              echo '</pre>';
             */
            $settingsArrayAccount = array('0' => array(
                    'min' => $min,
                    'max' => $max,
                    'statusUser' => $statusUser,
                    'lines' => $linesArray
                ),
            );
        }

        foreach ($settingsArraySertificate as $value) {

            $statusId = $value->status->id;
            $statusUser = $value->status->name;
            $sertificate = $value->value;
            $linesArray = array();




            /*
              echo '</br>';    echo '</br>';    echo '</br>';
              echo '<pre>';
              print_r($statusId);
              echo '</pre>';
             */

            foreach ($return as $status_id => $value) {
                if ($statusId == $status_id) {

                    foreach ($value as $key => $val) {

                        $linesArray[$val->line] = array(
                            'count_users' => $val->count_users,
                            'sum_pay' => $val->sum_pay,
                        );
                        /*
                          echo '</br>';    echo '</br>';    echo '</br>';
                          echo 'st';
                          echo '<pre>';
                          print_r($val);
                          echo '</pre>';
                         * 
                         */
                    }
                }
            }


            

            $settingsArraySertificate = array('1' => array(
                    'sertificate' => $sertificate,
                    'statusUser' => $statusUser,
                    'lines' => $linesArray
                ),
            );
        }



        /////////////////////////////////////////////////////////////////
        //  foreach ($settingLinesArray as $i=>$value) {
        /*
          echo '</br>';echo '</br>';echo '</br>';
          echo '<pre>';
          print_r($value);
          echo '</pre>';
         */

        // $settingsArraySertificate[1]['lines'][$value->line] = array(
        //                                         
        //                                                              'count_users' => $value->count_users,
        //          'sum_pay' => $value->sum_pay,
        //  );
        //  }

        $settingsArray = array_merge($settingsArrayAccount, $settingsArraySertificate);
        /*
          echo '</br>';    echo '</br>';    echo '</br>';
          echo '<pre>';
          print_r($settingsArray);
          echo '</pre>';
         */
        return $settingsArray;
    }

    //функция определяет статус пользователя
    public function definitionStatusUser($payUser, $dataCountLineUsers2) {
      $statusUser;
        /*
          echo '</br>';    echo '</br>';    echo '</br>';
          echo '<pre>';
          print_r($dataCountLineUsers2);
          echo '</pre>';
         */
        /*
        if ($payUser >= $this->settings_arr[0]['min'] && $payUser <= $this->settings_arr[0]['max']) {
            $statusUser = $this->settings_arr[0]['statusUser'];
          return $statusUser;

        }
        
    */
        foreach ($this->settings_arr[1]['lines'] as $line => $value) {
/*
            echo '</br>';
            echo '</br>';
            echo '</br>';
            echo '<pre>';
            print_r($this->settings_arr[1]['lines'][$line]['count_users']);
            echo '</pre>';
*/
            if (array_key_exists($line, $dataCountLineUsers2)) {
                if (count($dataCountLineUsers2[$line]) >= $this->settings_arr[1]['lines'][$line]['count_users'] && $sertificate == $this->settings_arr[1]['sertificate'] &&
                        $payUser >= $this->settings_arr[0]['min'] && $payUser <= $this->settings_arr[0]['max']){
                    $statusUser = $this->settings_arr[1]['statusUser'];
                // echo '</br>';echo '</br>';echo '</br>';
                // echo 'ok';
                        }
            }
        }
        
 //echo  $statusUser;
  
        //if ($sertificate == $this->settings_arr[1]['sertificate'] && $payUser >= $this->settings_arr[0]['min'] && $payUser <= $this->settings_arr[0]['max'])
        //$statusUser = $this->settings_arr[1]['statusUser'];
    }

}

?>
