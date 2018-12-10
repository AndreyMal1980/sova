<?php

/**
 * This is the model class for table "status_user".
 *
 * The followings are the available columns in table 'status_user':
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property SettingAccount[] $settingAccounts
 * @property SettingLines[] $settingLines
 */
class StatusUser extends CActiveRecord {

    public $lines_array;
/*
    public function getStatusSettingsArray() {
        if ($this->lines_array === null)
            $this->lines_array = CHtml::listData($this->settingLines, 'id', 'id');
        return $this->lines_array;
    }

    public function setStatusSettingsArray($value) {
        $this->lines_array = $value;
    }
*/
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'status_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, description', 'required'),
            array('name', 'length', 'max' => 120),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description', 'safe', 'on' => 'search'),
            array('settingLines', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'settingAccounts' => array(self::HAS_MANY, 'SettingAccount', 'status_id'),
            'settingLines' => array(self::MANY_MANY, 'SettingLines', 'status_to_line(status_id, line_id)'),
        );
    }

    public function getSettingLinesArray() { 
        if ($this->lines_array === null)
           $this->lines_array = CHtml::listData($this->settingLines, 'status_id', 'line_id '); 
       foreach ($this->settingLines as $value ) {
           $this->lines_array[] = $value['id']; 
      }
      return  $this->lines_array;
    }

    public function setSettingLinesArray($value) {
        $this->lines_array = $value;
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
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

        $criteria->compare('id', $this->id);
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
     * @return StatusUser the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array('ESaveRelatedBehavior' => array(
                'class' => 'application.modules.admin.components.ESaveRelatedBehavior')
        );
    }

}
