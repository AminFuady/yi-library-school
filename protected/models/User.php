<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $status
 * @property datetime $last_visit
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property UserDetail[] $userDetail
 * @property DealerTarget[] $dealerTargets
 * @property vendor[] $vendor
 */
class User extends MyActiveRecord
{
	const TYPE_SUADMIN			= 10;
	const TYPE_ADMIN			= 20;
	
	const STATUS_ENABLE		= 10;
	const STATUS_DISABLE	= 0;
	
	const DEFAULT_PASSWORD	= '12345678';//minimum 8 character
	
	public $current_password;
	public $new_password;
	public $confirm_password;
	public $phone;
	public $segmentation;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name, email', 'required'),
			array('password', 'required', 'on'=>'insert'),
			array('type, status, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('email, password', 'length', 'max'=>200),
            array('current_password, new_password, confirm_password', 'length', 'max'=>32),
			array('confirm_password', 'compare', 'compareAttribute'=>'new_password'),
			array('created_at, updated_at, password, last_visit', 'safe'),
			array('email', 'email'),
			array('email', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, name, email, password, status, created_by, created_at, updated_by, updated_at', 'safe', 'on'=>'search'),
		);
	}
	
	protected function beforeValidate()
	{
		if(!$this->isNewRecord)
		{
			if(!empty($this->new_password) && !empty($this->confirm_password))
			{				
				if(empty($this->current_password))
				{
					$this->addError('current_password', 'Current Password cannot be blank.');
				}
				else if ($this->hashPassword($this->current_password) !== $this->password)
				{
					$this->addError('current_password', 'Currenct Password does not match');
				}
			}
		}
		
		return true;
	}
	
	protected function beforeSave()
	{
		if (!empty($this->new_password) && !empty($this->confirm_password))
		{
			$this->password = $this->hashPassword($this->new_password);
		}
		
		return parent::beforeSave();
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
			'type' => 'Type',
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'status' => 'Status',
			'last_visit' => 'Last Visit',
			'created_by' => 'Created By',
			'created_at' => 'Created At',
			'updated_by' => 'Updated By',
			'updated_at' => 'Updated At',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('last_visit',$this->last_visit);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_at',$this->updated_at,true);
		
		$criteria->order = 'type DESC, status ASC, name ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>50,
			),
		));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getNameById($id) {
		$model = self::model()->findByPk($id);
		if(!$model) return false;
		return $model->name;
	}
	
	/**
	 * @param integer $length
	 * @return string
	 */
	public static function generatePassword($length=6)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$password = '';
		for ($i = 0; $i < $length; $i++) {
			$password .= $characters[rand(0, $charactersLength - 1)];
		}
		return $password;
	}
	
	public static function hashPassword($password)
	{
		return sha1($password);
	}
	
	/**
	 * @return array
	 */
	public static function getTypeLabels()
	{
		return array(
			self::TYPE_SUADMIN => 'Super Administrator',
			self::TYPE_ADMIN => 'Admin',
		);
	}

	/**
	 * @param integer $type
	 * @return string
	 */
	public static function getTypeLabel($type)
	{
		$labels = self::getTypeLabels();
		if (isset($labels[$type])) {
			return $labels[$type];
		}
		return '';
	}
	
	public static function statusLabels() {
		return array(
			self::STATUS_ENABLE => 'Active',
			self::STATUS_DISABLE => 'Inactive',
		);
	}
	
	public function getStatus() {
		$labels	= self::statusLabels();
		return $labels[$this->status];
	}
	
	public function saveStatusActive() {
		$this->status = self::STATUS_ENABLE;
		return $this->saveAttributes(array('status'));
	}
	
	public function scopes(){
		return array(
			'latest'=>array(
				'order'=>'id DESC',
			)
		);
	}

}
