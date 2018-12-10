<?php

/**
 * This is the model class for table "setting_account".
 *
 * The followings are the available columns in table 'setting_account':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $min
 * @property integer $max
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property StatusUser $status
 */
class SettingAccount extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'setting_account';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, description, min, max, status_id', 'required'),
            array('min, max, status_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 120),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description, min, max, status_id', 'safe', 'on' => 'search'),
            array('min', 'compare', 'compareAttribute' => 'max', 'operator' => '<=', 'message' => 'min не может быть больше или равно max'),
            array('max', 'compare', 'compareAttribute' => 'min', 'operator' => '>=', 'message' => 'min не может быть больше или равно max'),
            array('max', 'compare', 'compareAttribute' => 'min', 'operator' => '!=', 'message' => 'min не может быть равно max'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'status' => array(self::BELONGS_TO, 'StatusUser', 'status_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'min' => 'Min',
            'max' => 'Max',
            'status_id' => 'Status',
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
        $criteria->compare('min', $this->min);
        $criteria->compare('max', $this->max);
        $criteria->compare('status_id', $this->status_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SettingAccount the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
