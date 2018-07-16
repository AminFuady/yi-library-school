<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property integer $id
 * @property string $member_code
 * @property string $nik
 * @property string $code
 * @property string $name
 * @property string $address
 * @property string $dob_place
 * @property string $dob
 * @property integer $religion_id
 * @property string $gender
 * @property string $no_telp
 * @property string $photo
 * @property integer $position_id
 * @property string $date_in
 * @property integer $employee_status
 * @property integer $marital_status
 * @property integer $previous_education_id
 * @property string $instance_previous_education
 * @property integer $graduation_year
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Employee extends MyActiveRecord
{
	const MARITAL_MARRIED	  = 10;
	const MARITAL_NOTYET	  = 20;
	const MARIAL_SINGLEPARENT = 30;
	
	const STATUS_EMPLOYEE_PNS		= 10;
	const STATUS_EMPLOYEE_HONORER	= 20;
	
	public $photoPath;
	public $photoUrl;
    public $photoDummy;
	public $fromDate;
	public $toDate;
	
	public function init() {
        $this->photoDummy = 'user_dummy.png';
		$mainDir	= Yii::app()->basePath . "/../images/";
		$this->photoUrl = Yii::app()->request->baseUrl . '/images/employee/';
		$this->photoPath = $mainDir.'/employee/';
		if(!is_dir($mainDir)){ mkdir($mainDir); }
		if(!is_dir($this->photoPath)){ mkdir($this->photoPath); }
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('photo', 'required', 'on'=>'insert'),
			array('member_code, nik, name, address, dob_place, dob, religion_id, gender, '
				. 'no_telp, date_in, employee_status, marital_status, status', 'required'),
			array('religion_id, position_id, employee_status, marital_status, previous_education_id, '
				. 'graduation_year,no_telp, status, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('member_code, nik, code', 'length', 'max'=>20),
			array('name, instance_previous_education', 'length', 'max'=>80),
			array('address', 'length', 'max'=>200),
			array('dob_place', 'length', 'max'=>50),
			array('gender, no_telp', 'length', 'max'=>15),
			array('photo', 'length', 'max'=>100),
			array('photo', 'file', 
                'types'=>'jpg, png',
				'allowEmpty'=>false, 'on'=>'insert',
                'enableClientValidation'=>true,
                'maxSize'=>1024 * 1024 * 2,
                'tooLarge'=>'File lebih dari 2MB, silahkan upload file yang lebih kecil.',
            ),
			array('photo', 'file', 
                'types'=>'jpg, png',
				'allowEmpty'=>true, 'on'=>'update',
                'enableClientValidation'=>true,
                'maxSize'=>1024 * 1024 * 2,
                'tooLarge'=>'File lebih dari 2MB, silahkan upload file yang lebih kecil.',
            ),
			array('created_at, updated_at, position_id, previous_education_id, instance_previous_education, graduation_year', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, member_code, nik, code, name, address, dob_place, dob, religion_id, gender, no_telp, photo, position_id, date_in, employee_status, marital_status, previous_education_id, instance_previous_education, graduation_year, status, created_at, created_by, updated_at, updated_by', 'safe', 'on'=>'search'),
			array('fromDate, toDate', 'safe', 'on'=>'filterBetweenDate'),
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
			'religion' => array(self::BELONGS_TO, 'Religion', 'religion_id'),
			'previousEducation' => array(self::BELONGS_TO, 'PreviousEducation', 'previous_education_id'),
			'position' => array(self::BELONGS_TO, 'Position', 'position_id'),
		);
	}
	
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->member_code = $this->generateCode();
			}
		}
		return true;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_code' => 'Kode Anggota',
			'nik' => 'Nik',
			'code' => 'Kode',
			'name' => 'Nama Lengkap',
			'address' => 'Alamat',
			'dob_place' => 'Tempat Lahir',
			'dob' => 'Tanggal Lahir',
			'religion_id' => 'Agama',
			'gender' => 'Jenis Kelamin',
			'no_telp' => 'No Telp',
			'photo' => 'Foto',
			'position_id' => 'Posisi / Jabatan',
			'date_in' => 'Tanggal Masuk',
			'employee_status' => 'Status Karyawan',
			'marital_status' => 'Status Pernikahan',
			'previous_education_id' => 'Pendidikan Terakhir',
			'instance_previous_education' => 'Instansi Pendidikan Terakhir',
			'graduation_year' => 'Tahun Lulus',
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
		$criteria->compare('member_code',$this->member_code,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('dob_place',$this->dob_place,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('religion_id',$this->religion_id);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('no_telp',$this->no_telp,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('position_id',$this->position_id);
		$criteria->compare('date_in',$this->date_in,true);
		$criteria->compare('employee_status',$this->employee_status);
		$criteria->compare('marital_status',$this->marital_status);
		$criteria->compare('previous_education_id',$this->previous_education_id);
		$criteria->compare('instance_previous_education',$this->instance_previous_education,true);
		$criteria->compare('graduation_year',$this->graduation_year);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function filterBetweenDate($pagination=null)
	{	
		$criteria = new CDbCriteria;
		
		if(!empty($_GET['Employee']['fromDate']) && !empty($_GET['Employee']['toDate'])){
			$this->fromDate = $_GET['Employee']['fromDate'];
			$this->toDate = $_GET['Employee']['toDate'];
			
			$this->fromDate = $this->fromDate;//.' 00:00:00';
			$this->toDate = $this->toDate;//.' 23:59:59';
			$criteria->addBetweenCondition('date_in', $this->fromDate, $this->toDate, 'AND');
		}
		
		$criteria->order = 'date_in DESC';
		
		/*
		 * kondisi ini jika noPagination , pagination=false
		 * ini digunakan untuk cetak report (pdf atau xls)
		 * kalau report dideklarasikan pagination, maka data tidak akan muncul secara keseluruhan
		 * makanya dibuat false
		 */
		$pagination = ($pagination=='noPagination') ? false : array('pageSize'=>10);
			
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>$pagination,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function findByMemberCode($code) {
		$criteria = new CDbCriteria();
        $criteria->compare('member_code', $code);
        $criteria->compare('status', self::STATUS_ACTIVE);
        $model = self::model()->find($criteria);
        if(!$model) return false;
        return $model;
	}
	
	public function findByName($name) {
		$criteria = new CDbCriteria();
		$criteria->compare('name', $name);
		$criteria->compare('status', self::STATUS_ACTIVE);
        $model = self::model()->find($criteria);
        if($model){
			return $model;
		}else{ //ini pakai like jika data tidak juga di temukan
			$criteria = new CDbCriteria();
			$criteria->addSearchCondition('name', $name, true, 'AND', 'LIKE' );
			$criteria->compare('status', self::STATUS_ACTIVE);
			$model = self::model()->find($criteria);
			if($model)
				return $model;
		}
		return false;
	}
    
    public function findByNik($nik) {
        $criteria = new CDbCriteria();
        $criteria->compare('nik', $nik);
        $model = self::model()->find($criteria);
        if(!$model) return false;
        return $model;
    }
	
	public function generateCode()
	{
        $_d = date("ym");
        $_i = "EMP-";
        $_left = $_i . $_d . '-';
        $_first = "000001";
        $_len = strlen($_left);
        $no = $_left . $_first;
      
        $lastPo = $this->find(
                array(
                    "select"=>"member_code",
                    "condition" => "left(member_code, " . $_len . ") = :_left",
                    "params" => array(":_left" => $_left),
                    "order" => "id DESC"
                ));

        if($lastPo != null):
            $_no = substr($lastPo->member_code, $_len);
            $_no++;
            $_no = substr("000000", strlen($_no)) . $_no;
            $no = $_left . $_no;
        endif;
		
        return $no;
    }
	
	public static function maritalStatusLabels() {
		return array(
			self::MARITAL_MARRIED => 'Menikah',
			self::MARITAL_NOTYET  => 'Belum Menikah',
			self::MARIAL_SINGLEPARENT => 'Single Parent',
		);
	}
	
	public function maritalStatusLabel() {
		$family = self::maritalStatusLabels();
		return $family[$this->marital_status];
	}
	
	public function getMaritalStatusWithStyle($status=null) {
		if($status==null) $status = $this->marital_status;
		$labels = self::maritalStatusLabels();
		switch($status) {
			case self::MARITAL_MARRIED: return '<label class="label label-success">'.$labels[$status].'</label>';
			case self::MARITAL_NOTYET: return '<label class="label label-primary">'.$labels[$status].'</label>';
			case self::MARIAL_SINGLEPARENT: return '<label class="label label-danger">'.$labels[$status].'</label>';
			default: return '<label class="label label-primary">Not Known ('.$status.')</label>';
		}
	}
	
	public static function employeeStatusLabels() {
		return array(
			self::STATUS_EMPLOYEE_PNS => 'PNS',
			self::STATUS_EMPLOYEE_HONORER  => 'Honorer',
		);
	}
	
	public function getEmployeeStatusWithStyle($status=null) {
		if($status==null) $status = $this->employee_status;
		$labels = self::employeeStatusLabels();
		switch($status) {
			case self::STATUS_EMPLOYEE_PNS: return '<label class="label label-success">'.$labels[$status].'</label>';
			case self::STATUS_EMPLOYEE_HONORER: return '<label class="label label-danger">'.$labels[$status].'</label>';
			default: return '<label class="label label-danger">Not Known ('.$status.')</label>';
		}
	}
	
	public function photoName() {
		$labels         = date('Y');
		$labels         = str_replace(' ', '-', strtolower($labels));
		$uploadedFile   = md5(date('Y-m-d H:i:s')). '.' . $this->photo->getExtensionName();
		$fileName       = "{$labels}-{$uploadedFile}";  // random number + file name
		return $fileName;
	}
	
	public function getPhoto($htmlOptions=array('style'=>'width:30%')) {
		$url = $this->photoUrl.$this->photo;
		$img = CHtml::image($url, $this->name, $htmlOptions);
		return $img;
	}
}
