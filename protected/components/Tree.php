<?php

class Tree {

    private $user_arr = array();
    public $line_arr = array();

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
        $query = Yii::app()->db->createCommand("SELECT * FROM `users`");
        //Читаем все строчки и записываем в переменную $result
        $result = $query->query(); //Готовим запрос
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
    public function outTree($parent_id, $level) {

        if (isset($this->user_arr[$parent_id])) { //Если пользователь с таким parent_id существует
            foreach ($this->user_arr[$parent_id] as $value) { //Обходим ее
                $level++;
                $data[] = array(
                    'text' => CHtml::link($value['surname'] . ' ' . $value['name'], array('ViewUser', 'user_id' => $value['user_id'])),
                    'parent_id' => $value['parent_id'],
                    //'count' => count($this->outTree($value['user_id'], $level)),
                    'line' => $level,
                    'pay' => $value['share'],
                    'expanded' => false,
                    'children' => $this->outTree($value['user_id'], $level),
                );
                $level--;
            }
        }
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
        }
        return $result;
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

    public function getMaxLevel($array) {

        if (is_array($array)) {
            $return = array();
            $lines = array();
            foreach ($array as $key => $value) {

                $return[$value['line']][] = $value;
            }
            ksort($return);
            foreach ($return as $key => $value) {
                $lines[] = $key;
            }
        }
        return max($lines);
    }
}

