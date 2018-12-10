<?php

/**
 * This is the model class for table "programms".
 *
 * The followings are the available columns in table 'programms':
 * @property integer $programm_id
 * @property integer $frequency_of_payments
 * @property integer $percent
 * @property integer $period_of_payment
 * @property integer $date
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Users[] $users
 */
class Programms extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'programms';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('frequency_of_payments, percent, period_of_payment, bonus, name', 'required'),
            array('frequency_of_payments, percent, period_of_payment, bonus', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 120),
            array('description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('programm_id, frequency_of_payments, percent, period_of_payment, bonus, name, description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'users' => array(self::MANY_MANY, 'Users', 'user_to_programm(programm_id, user_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'programm_id' => 'Programm',
            'frequency_of_payments' => 'Периодичность выплат (в днях)',
            'percent' => 'Процент',
            'period_of_payment' => 'Период выплат (в месяцах)',
            'bonus' => 'Бонус',
            'name' => 'Name',
            'description' => 'Description',
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

        $criteria->compare('programm_id', $this->programm_id);
        $criteria->compare('frequency_of_payments', $this->frequency_of_payments);
        $criteria->compare('percent', $this->percent);
        $criteria->compare('period_of_payment', $this->period_of_payment);
        $criteria->compare('date', $this->date);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Programms the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array('ESaveRelatedBehavior' => array(
                'class' => 'application.components.ESaveRelatedBehavior')
        );
    }
}
