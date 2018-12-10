<?php

/**
 * This is the model class for table "pay_to_user".
 *
 * The followings are the available columns in table 'pay_to_user':
 * @property integer $id
 * @property integer $user_id
 * @property integer $pay_id
 * @property integer $programm_id
 *
 * The followings are the available model relations:
 * @property Pay $pay
 * @property Users $user
 * @property Programms $programm
 */
class PayToUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pay_to_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('user_id, pay_id, programm_id', 'required'),
			array('user_id, pay_id, programm_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, pay_id, programm_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pay' => array(self::BELONGS_TO, 'Pay', 'pay_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'programm' => array(self::BELONGS_TO, 'Programms', 'programm_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'pay_id' => 'Pay',
			'programm_id' => 'Programm',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('pay_id',$this->pay_id);
		$criteria->compare('programm_id',$this->programm_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayToUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
         public function behaviors() {
        return array('ESaveRelatedBehavior' => array(
                'class' => 'application.components.ESaveRelatedBehavior')
        );
    }
}
