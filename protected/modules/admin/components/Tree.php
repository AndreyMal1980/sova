<?php

class Tree {

    private $user_arr = array();
    public $max;


    public function __construct() {
        //В переменную $user_arr записываем всех пользователей (см. ниже)
        $this->user_arr = $this->getNode();
       
    }

    /**
     * Метод читает из таблицы users все сточки, и 
     * возвращает двумерный массив, в котором первый ключ - id - родителя 
     * категории (parent_id)
     * @return Array 
     */
  
    private function getNode() {
        
         $criteria = new CDbCriteria;
       // $criteria->select = 'pay';  // выбираем только поле 'title'
        //$criteria->condition = 'user_id=:user_id';
        //$criteria->params = array(':user_id' => $parent_id);
        $result = Users::model()->with('payToUsers')->findAll(); // $params не требуется
        /*
        echo '</br>'; echo '</br>'; echo '</br>';
                    echo '<pre>';
                    //$sumPay += $val['pay_id'];
                    print_r($result);
                    echo '</pre>';
         * 
         */
       // $query = Yii::app()->db->createCommand("SELECT * FROM `users`, `pay_to_user` where  ");
        //Читаем все строчки и записываем в переменную $result
     //   $result = $query->query(); //Готовим запрос
        //Перелапачиваем массим (делаем из одномерного массива - двумерный, в котором 
        //первый ключ - parent_id)
        $return = array();
        foreach ($result as $value) { //Обходим массив
          
            $return[$value['parent_id']][] = $value;
             
        }
        return $return;
    }
  

    /**
     * Вывод дерева
     * @param Integer $parent_id - id-родителя
     * @param Integer $level - уровень вложености
     */
    public function getUserPay($user_id) {
        
       ////   echo '</br>'; echo '</br>'; echo '</br>';
       //   print_r($user_id);
        $pay;
      $query1 = Yii::app()->db->createCommand('select pay_id from pay_to_user where user_id='.$user_id);//Pay::model()->find($criteria); // $params не требуется
          $result1 = $query1->queryAll();
          $pay_id = array();
          foreach ($result1 as $value) {
             //echo '</br>'; echo '</br>'; echo '</br>';
                  //  echo '<pre>';
                    //$sumPay += $val['pay_id'];
                    $pay_id = $value['pay_id'];
                   
                  //  echo '</pre>';
          
         // for($i=0;$i<=count($pay_id);$i++) {          
           $query2 = Yii::app()->db->createCommand('select pay from pay where id='.$pay_id);
           $result2 = $query2->queryAll();
          
             foreach ($result2 as $value) {
                 /*
            echo '</br>'; echo '</br>'; echo '</br>';
                    echo '<pre>';
                    //$sumPay += $val['pay_id'];
                
                    print_r($value);
                   
                    echo '</pre>';
                  * 
                  */
          }}//}
        return $value;
    }


    public function outTree($parent_id, $level) {
      
               $criteria->select = 'pay';  // выбираем только поле 'title'
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id' => 216);
              
         
        $data = array();
        
        //$query = Yii::app()->db->createCommand('select pay_id from pay_to_user where user_id='.$parent_id);
        //$pay = $query->queryAll();
      /*
        //foreach ($result as $value) {
         echo '</br>'; echo '</br>'; echo '</br>';
        echo '<pre>';
        print_r($result);
        echo '</pre>';
       // }
      */
      static $max=0;
        if (isset($this->user_arr[$parent_id])) { //Если пользователь с таким parent_id существует
            foreach ($this->user_arr[$parent_id] as $value) { //Обходим ее
                
            /*
              $query1 = Yii::app()->db->createCommand('select pay_id from pay_to_user where user_id='.$value['user_id']);//Pay::model()->find($criteria); // $params не требуется
          $result1 = $query1->queryAll();
          $pay_id = array();
          foreach ($result1 as $value) {
             //echo '</br>'; echo '</br>'; echo '</br>';
                  //  echo '<pre>';
                    //$sumPay += $val['pay_id'];
                    $pay_id = $value['pay_id'];
                   
                  //  echo '</pre>';
          
         // for($i=0;$i<=count($pay_id);$i++) {          
           $query2 = Yii::app()->db->createCommand('select pay from pay where id='.$pay_id);
           $result2 = $query2->queryAll();
          
             foreach ($result2 as $value) {
            echo '</br>'; echo '</br>'; echo '</br>';
                    echo '<pre>';
                    //$sumPay += $val['pay_id'];
                    print_r($value);
                   
                    echo '</pre>';
          }}//}
                 */
              
                
               
                $level++;
                if($level>$max)
                $max=$level;
                
                $data[] = array(
                    'text' => CHtml::link($value['surname'] . ' ' . $value['name'], array('ViewUser', 'user_id' => $value['user_id'])),
                    'parent_id' => $value['parent_id'],
                    //'count' => count($this->outTree($value['user_id'], $level)),
                    'line' => $level,
                    'pay' => $this->getUserPay($value['user_id']),
                    'expanded' => false,
                    'children' => $this->outTree($value['user_id'], $level),
                );
                $level--;
            }
            
        }
     
        $this->max = $max;
        /*
          echo '</br>'; echo '</br>'; echo '</br>';
        echo '<pre>';
        print_r($data);
        echo '</pre>';
         */
        return $data;
    }

    public function getLineAndCountUsers($my_data) {
        $result = array();
        if (is_array($my_data)) {
            foreach ($my_data as $item) {
                if (is_array($item['children'])) {
                    $result = array_merge($result, $this->getLineAndCountUsers($item['children']));
                }
                $item['children'] = '';
                $result[] = $item;
            }
            return $result;
        }
    }

    public function getLineAndCountUsers2($array) {
        if (is_array($array)) {
            $return = array();
            foreach ($array as $value) {
                $return[$value['line']][] = $value;
            }
            ksort($return);
        }
        return $return;
    }
}

