<?php

/**
 * This is the model class for table "school_info".
 *
 * The followings are the available columns in table 'school_info':
 * @property integer $id
 * @property string $npsn
 * @property string $name
 * @property string $description
 * @property string $no_telp
 * @property string $email
 * @property string $kepsek
 * @property string $address
 * @property string $logo
 */
class SchoolInfo extends MyActiveRecord
{
	const ID = 1;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'school_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('npsn, name, description, no_telp, email, kepsek, address, logo', 'required'),
			array('npsn', 'length', 'max'=>50),
			array('name', 'length', 'max'=>200),
			array('description', 'length', 'max'=>500),
			array('no_telp', 'length', 'max'=>15),
			array('email, logo', 'length', 'max'=>100),
			array('kepsek', 'length', 'max'=>80),
			array('address', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, npsn, name, description, no_telp, email, kepsek, address, logo', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'npsn' => 'Npsn',
			'name' => 'Name',
			'description' => 'Description',
			'no_telp' => 'No Telp',
			'email' => 'Email',
			'kepsek' => 'Kepsek',
			'address' => 'Address',
			'logo' => 'Logo',
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
		$criteria->compare('npsn',$this->npsn,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('no_telp',$this->no_telp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('kepsek',$this->kepsek,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('logo',$this->logo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SchoolInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getByField($field='name') {
		$model = self::model()->findByPk(self::ID);
		return $model->$field;
	}
}
