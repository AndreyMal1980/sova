<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {       
     // Производим стандартную аутентификацию, описанную в руководстве.
       // $user = Users::model()->find('LOWER(name)=?', array(strtolower($this->username)));
         $user = Users::model()->find('number_ticket=?', array($this->username));
      
        /*
        echo '<pre>';
        print_r($user);
          echo '</pre>';
         * 
         */
        if(($user===null) || ($user->password !== crypt($this->password,Yii::app()->params['pasSalt']))) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            // В качестве идентификатора будем использовать id, а не username,
            // как это определено по умолчанию. Обязательно нужно переопределить
            // метод getId(см. ниже).
            $this->_id = $user->user_id;
         
 
            // Далее логин нам не понадобится, зато имя может пригодится
            // в самом приложении. Используется как Yii::app()->user->name.
            // realName есть в нашей модели. У вас это может быть name, firstName
            // или что-либо ещё.
           
            $this->setState('role', $user->role);
            $this->setState('user_id', $user->user_id);
              $this->setState('name', $user->name);
          
 
            $this->errorCode = self::ERROR_NONE;
        }
       return !$this->errorCode;
      
    }
    
      public function getId(){
        return $this->_id;
    }
   
}