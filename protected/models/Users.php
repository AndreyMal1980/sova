<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property string $role
 * @property string $name
 * @property string $surname
 * @property integer $number_ticket
 * @property integer $number_ticket_change
 * @property string $password
 * @property string $email
 * @property string $city
 * @property string $phone
 * @property integer $parent_id
 * @property integer $date
 * @property string $user_ref
 * @property string $status_id
 *
 * The followings are the available model relations:
 * @property PayToUser[] $payToUsers
 * @property Programms[] $programms
 */
class Users extends CActiveRecord {

    public $date;
    public $parentName;
    public $startDate;
    public $endDate;
    public $image;
   // public $programms_array;
    public $numberTicket;
    public $readOnly;
    public $getParamUrl;
   
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('name, surname,role, password, email, city, phone, date, payToUsers, number_ticket_change', 'required'),
            // array('name, surname, password, email, city, phone, date, image, programms', 'required', 'on' => 'registration'),
            //array('name, surname, password, email, city, phone, payToUsers', 'required', 'on' => 'registrationRef2'),
            array('number_ticket', 'required', 'on' => 'addSertificate'),
            array('number_ticket, parent_id', 'numerical', 'integerOnly' => true),
            array('name, surname, password, email, city, phone', 'length', 'max' => 120),
            // array('name','match','pattern'=>'/^([A-Za-z0-9 ]+)$/u'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, role, name, surname, password, number_ticket, number_ticket_change, email, city, phone, parent_id, user_ref, payToUsers ', 'safe', 'on' => 'search'),
                // array('ProgrammsArray', 'safe'),
                // array('image', 'file', 'types'=>'jpg, gif, png, docx'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'payToUsers' => array(self::HAS_MANY, 'PayToUser', 'user_id'),
         
            //'programms' => array(self::MANY_MANY, 'Programms', 'user_to_programm(user_id, programm_id)'),
        );
    }

    /*
      public function getProgrammsArray() {
      if ($this->programms_array === null)
      $this->programms_array = CHtml::listData($this->programms, 'user_id', 'programm_id');
      foreach ($this->programms as $value ) {
      $this->programms_array[] = $value['programm_id'];
      }
      return  $this->programms_array;
      }

      public function setProgrammsArray($value) {
      $this->programms_array = $value;
      }
     */

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => 'Пользователь',
            'role' => 'Роль',
            'number_ticket' => 'Номер членского билета пользователя',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'password' => 'Пароль',
            'number_ticket_change' => 'Номер членского билета того кто пригласил',
            'email' => 'Email',
            'city' => 'Город',
            'phone' => 'Телефон',
            'parent_id' => 'Кто пригласил',
            'date' => 'Дата регистрации',
            'image' => 'Прикрепить скрин заявление',
            'payToUsers' => ' Выбор программы',
            'user_ref' => 'user_ref',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        // $criteria->compare('programms', $this->programms);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('role', $this->role);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('surname', $this->surname, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('number_ticket', $this->number_ticket);
        $criteria->compare('number_ticket_change', $this->number_ticket_change);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('payToUsers', $this->payToUsers, true);
        $criteria->compare('user_ref', $this->user_ref, true);

        $sort = new CSort;
        $criteria->condition = 'sertificate = 0';

        $tree = new Tree();
        $query = Yii::app()->db->createCommand('select user_id from users ORDER BY user_id ASC ');
        $result = $query->queryAll();
        $userId = array();
        
        $marketing = new Marketing;
        echo '<pre>';
        print_r($marketing);
        echo '</pre>';


        foreach ($result as $i => $value) {
            $my_data = $tree->outTree($value['user_id'], 0);
            $dataCountLineUsers = $tree->getLineAndCountUsers($my_data);
            $dataCountLineUsers2 = $tree->getLineAndCountUsers2($dataCountLineUsers);
            if (count($dataCountLineUsers2[1]) > 5) {
                echo '<pre>';
                print_r($value);
                echo '</pre>';

                $userId[] = $value['user_id'];
            }
        }

        $criteria->addInCondition('user_id', $userId);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
public static function allUsers() {
        $models = self::model()->findAll();
        $data = array();
        foreach ($models as $one) {
            $data[$one->user_id] = $one->name;
        }
        return $data;
    }

    public static function currentDate() {
        $date = date("Y-m-d H:i:s");
        return $date;
    }

    public function getUserDateRegistration($id) {
        $query = Yii::app()->db->createCommand("SELECT date FROM `users` where user_id=" . $id);
        $result = $query->queryScalar();
        $date = date("Y.m.d ", $result);
        return $date;
    }

    public function behaviors() {
        return array('ESaveRelatedBehavior' => array(
                'class' => 'application.modules.admin.components.ESaveRelatedBehavior')
        );
    }

    public function getIdUserToNumberTicket($numberTicket) {
        $parentId;

        if ($this->number_ticket_change != 0) {

            $numberTicket = $this->number_ticket_change;

            $query1 = Yii::app()->db->createCommand("select user_id from users where number_ticket=" . $numberTicket);

            $result1 = $query1->queryScalar();
            if ($result1) {
                $parentId = $result1;
            } else {
                $parentId = 0;
            }
        } else {
            $parentId = 0;
        }
        return $parentId;
    }

    public static function getProgrammsUser($id, $sSep = ', ') {
        $ProgrammsUser = array();
        $data = Users::model()->findByPk($id);
        foreach ($data->programms as $programms) {
            $ProgrammsUser[] = $programms->name;
        }
        return implode($sSep, $ProgrammsUser);
    }

    public function getDataUser($id) {
        $model = Users::model()->findByPk($id);
        $query = Yii::app()->db->createCommand("SELECT name FROM `users` WHERE user_id=" . $model->parent_id); //Готовим запрос
        $result = $query->queryAll();
        foreach ($result as $parentName) {
            $model['parentName'] = $parentName['name'];
        }
        return $model;
    }

    public function getParentUserName($id) {
        $query1 = Yii::app()->db->createCommand("SELECT parent_id FROM `users` WHERE user_id=" . $id); //Готовим запрос
        $parent_id = $query1->queryScalar();
        $query = Yii::app()->db->createCommand("SELECT surname,name FROM `users` WHERE user_id=" . $parent_id); //Готовим запрос
        $result = $query->queryAll();
        return $result;
    }

    public static function countChildrenUser($id) {
        $model = Users::model()->findByPk($id);
        $query = Yii::app()->db->createCommand("SELECT count(*) FROM `users` WHERE parent_id=" . $model->user_id); //Готовим запрос
        $result = $query->queryScalar();
        return $result;
    }

    public function countChildrenUserAdmin($id) {
        $query = Yii::app()->db->createCommand('select count(*) from users where parent_id=' . $id);
        $result = $query->queryScalar();
        return $result;
    }

    public function DataUserByPeriod($startDateA, $endDateA, $id) {
        $DataUserByPeriod = array();
        $d = array();
        $query = Yii::app()->db->createCommand("select * from users where parent_id='" . $id . "'and date>='" . $startDateA . "'and date<='" . $endDateA . "'");
        $result = $query->queryAll();
        foreach ($result as $data) {
            $DataUserByPeriod['name'][] = $data['name'];
        }
        //  print_r($result);
        return $DataUserByPeriod;
    }

    public function getUserRef($user_id) {

        $query = Yii::app()->db->createCommand("SELECT user_ref FROM `users` WHERE user_id=" . $user_id);
        $userRef = $query->queryScalar();
        if (!$userRef)
            return '<strong>' . 'Ваша реферальная ссылка еще не готова' . '<strong>' . '<hr/>';
        else
            return $userRef;
    }

    public function setNumberTicketToRegistration($number_ticket) {
        $this->number_ticket_change = $number_ticket;
    }

    public function getNumberTicketToRegistration() {
        echo $this->number_ticket_change;
        return $this->number_ticket_change;
    }

    public function getReadOnlyToRegistration($number_ticket, $readOnly) {

        $this->number_ticket_change = $number_ticket;
        //$result;
        //$query = Yii::app()->db->createCommand("SELECT number_ticket FROM `users` WHERE number_ticket=" . $this->numberTicket);
        // $result = $query->queryScalar();
        // // $this->number_ticket_change = $result;
        // }

        $readOnly;
        if ($number_ticket > 0) {
            $this->readOnly = true;
            $this->numberTicket = $number_ticket;
        } else {
            $this->numberTicket = $number_ticket;
            $this->readOnly = false;
        }
        return $readOnly;
    }

    public function getUserPassword($id) {
        $query = Yii::app()->db->createCommand('select password from `users` where user_id=' . $id);
        $result = $query->queryScalar();
        return $result;
    }

    public function getStatusUser($id) {
        $query = Yii::app()->db->createCommand('select status_id from `users` where user_id=' . $id);
        $result = $query->queryScalar();
        return $result;
    }

    public static function getIdMainUser() {
        $query = Yii::app()->db->createCommand('select user_id from `users` where number_ticket=1');
        $result = $query->queryScalar();
        return $result;
    }

    public static function getCountUsersAndSumPayToLine() {
        
    }
}
