<?php

/**
 * This is the model class for table "duration".
 *
 * The followings are the available columns in table 'duration':
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $description
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Duration extends MyActiveRecord
{
	//ini id dari record yang ada di table ini
	const PINJAM_SISWA		= 1;
	const PINJAM_GURU		= 2;
	const PINJAM_KARYAWAN	= 3;
	const DENDA_SISWA		= 4;
	const DENDA_GURU		= 5;
	const DENDA_KARYAWAN	= 6;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'duration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, value, description, status', 'required'),
			array('status, value, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>80),
			array('value', 'length', 'max'=>11),
			array('description', 'length', 'max'=>500),
			array('created_at, updated_at', 'safe'),
			array('status', 'default', 'value'=>self::STATUS_ACTIVE),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, value, description, status, created_at, created_by, updated_at, updated_by', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'value' => 'Value',
			'description' => 'Description',
			'status' => 'Status',
			'created_at' => 'Created At',
			'created_by' => 'Created By',
			'updated_at' => 'Updated At',
			'updated_by' => 'Updated By',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Duration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getValueById($id) {
		$model = self::model()->findByPk($id);
		if(!$model) return null;
		return $model->value;
	}
	
	public function getDendaStudent() {
		return self::model()->getValueById(self::DENDA_SISWA);
	}
	public function getDendaTeacher() {
		return self::model()->getValueById(self::DENDA_GURU);
	}
	public function getDendaEmployee() {
		return self::model()->getValueById(self::DENDA_KARYAWAN);
	}
}
