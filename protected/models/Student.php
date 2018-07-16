<?php

/**
 * This is the model class for table "student".
 *
 * The followings are the available columns in table 'student':
 * @property integer $id
 * @property string $member_code
 * @property string $nisn
 * @property string $nis
 * @property string $name
 * @property string $photo
 * @property string $dob_place
 * @property string $dob
 * @property string $gender
 * @property integer $religion_id
 * @property string $address
 * @property string $no_telp
 * @property integer $grade_id
 * @property integer $departement_id
 * @property string $extracurricular
 * @property integer $semester
 * @property string $date_in
 * @property integer $previous_education_id
 * @property string $mother_name
 * @property integer $family_status
 * @property integer $child_of
 * @property integer $family_qty
 * @property string $family_address
 * @property string $father_earning
 * @property string $family_telp
 * @property string $father_work
 * @property string $mother_work
 * @property string $father_name
 * @property string $mother_earning
 * @property string $wali_address
 * @property string $wali_telp
 * @property string $wali_work
 * @property integer $student_status
 * @property integer $status
 * @property string $wali_name
 * @property datetime $expire_date
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Student extends MyActiveRecord
{
	const SEMESTER_GANJIL= 10;
	const SEMESTER_GENAP = 20;
	
	const FAMILY_KANDUNG = 10;
	const FAMILY_ANGKAT	 = 20;
	const FAMILY_TIRI	 = 30;
	
	const STATUS_STUDENT_ACTIVE = 10;
	const STATUS_STUDENT_ALUMNI = 20;
	const STATUS_STUDENT_NEW = 30;
	
	public $photoPath;
	public $photoUrl;
    public $photoDummy;
	public $fromDate;
	public $toDate;
	
	public function init() {
        $this->photoDummy = 'user_dummy.png';
		$mainDir	= Yii::app()->basePath . "/../images/";
		$this->photoUrl = Yii::app()->request->baseUrl . '/images/student/';
		$this->photoPath = $mainDir.'/student/';
		if(!is_dir($mainDir)){ mkdir($mainDir); }
		if(!is_dir($this->photoPath)){ mkdir($this->photoPath); }
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'student';
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
			array('member_code, nisn, nis, name, dob_place, dob, gender, religion_id, address, '
				. 'no_telp, date_in, '
				. 'mother_name, family_status, child_of, family_qty, '
				. 'family_address, family_telp, father_work, father_name, '
				. 'student_status, status', 'required'),
			array('nisn, nis, religion_id, grade_id, departement_id, no_telp, semester, father_earning, mother_earning, '
				. 'previous_education_id, family_status, child_of, family_qty, student_status, '
				. 'status, created_by, updated_by, family_telp', 'numerical', 'integerOnly'=>true),
			array('member_code', 'length', 'max'=>20),
			array('nisn, nis, gender, no_telp, family_telp, wali_telp', 'length', 'max'=>15),
			array('name, extracurricular, mother_name, father_name, wali_name', 'length', 'max'=>80),
			array('photo, wali_work', 'length', 'max'=>100),
			array('dob_place, father_work, mother_work', 'length', 'max'=>50),
			array('address, family_address, wali_address', 'length', 'max'=>200),
			array('father_earning, mother_earning', 'length', 'max'=>30),
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
			array('created_at, updated_at, photo, expire_date, grade_id, departement_id, extracurricular, semester, mother_work, previous_education_id', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, member_code, nisn, nis, name, photo, dob_place, dob, gender, religion_id, address, no_telp, grade_id, departement_id, extracurricular, semester, date_in, previous_education_id, mother_name, family_status, child_of, family_qty, family_address, father_earning, family_telp, father_work, mother_work, father_name, mother_earning, wali_address, wali_telp, wali_work, student_status, status, wali_name, created_at, created_by, updated_at, updated_by', 'safe', 'on'=>'search'),
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
			'grade' => array(self::BELONGS_TO, 'Grade', 'grade_id'),
			'departement' => array(self::BELONGS_TO, 'Departement', 'departement_id'),
			'previousEducation' => array(self::BELONGS_TO, 'PreviousEducation', 'previous_education_id'),
		);
	}
	
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->member_code = $this->generateCode();
				$this->expire_date = $this->generateExpireDate();
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
			'nisn' => 'Nisn',
			'nis' => 'Nis',
			'name' => 'Nama Lengkap',
			'photo' => 'Foto',
			'dob_place' => 'Tempat Lahir',
			'dob' => 'Tanggal Lahir',
			'gender' => 'Jenis Kelamin',
			'religion_id' => 'Agama',
			'address' => 'Alamat',
			'no_telp' => 'No Telp',
			'grade_id' => 'Kelas',
			'departement_id' => 'Jurusan',
			'extracurricular' => 'Extrakulikuler',
			'semester' => 'Semester',
			'date_in' => 'Tanggal Masuk',
			'previous_education_id' => 'Pendidikan Sebelumnya',
			'family_status' => 'Status dalam Keluarga',
			'child_of' => 'Anak ke',
			'family_qty' => 'Jumlah Saudara',
			'father_name' => 'Nama Ayah',
			'mother_name' => 'Nama Ibu',
			'family_address' => 'Alamat Orang Tua',
			'family_telp' => 'No Telp Orang Tua',
			'father_work' => 'Pekerjaan Ayah',
			'mother_work' => 'Pekerjaan Ibu',
			'father_earning' => 'Pendapatan Ayah',
			'mother_earning' => 'Pendapatan Ibu',
			'wali_name' => 'Nama Wali',
			'wali_address' => 'Alamat Wali',
			'wali_telp' => 'No Telp Wali',
			'wali_work' => 'Pekerjaan Wali',
			'student_status' => 'Status Siswa',
			'status' => 'Status',
			'expire_date' => 'Masa Berlaku',
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
		$criteria->compare('nisn',$this->nisn,true);
		$criteria->compare('nis',$this->nis,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('dob_place',$this->dob_place,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('religion_id',$this->religion_id);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('no_telp',$this->no_telp,true);
		$criteria->compare('grade_id',$this->grade_id);
		$criteria->compare('departement_id',$this->departement_id);
		$criteria->compare('extracurricular',$this->extracurricular,true);
		$criteria->compare('semester',$this->semester);
		$criteria->compare('date_in',$this->date_in,true);
		$criteria->compare('previous_education_id',$this->previous_education_id);
		$criteria->compare('mother_name',$this->mother_name,true);
		$criteria->compare('family_status',$this->family_status);
		$criteria->compare('child_of',$this->child_of);
		$criteria->compare('family_qty',$this->family_qty);
		$criteria->compare('family_address',$this->family_address,true);
		$criteria->compare('father_earning',$this->father_earning,true);
		$criteria->compare('family_telp',$this->family_telp,true);
		$criteria->compare('father_work',$this->father_work,true);
		$criteria->compare('mother_work',$this->mother_work,true);
		$criteria->compare('father_name',$this->father_name,true);
		$criteria->compare('mother_earning',$this->mother_earning,true);
		$criteria->compare('wali_address',$this->wali_address,true);
		$criteria->compare('wali_telp',$this->wali_telp,true);
		$criteria->compare('wali_work',$this->wali_work,true);
		$criteria->compare('student_status',$this->student_status);
		$criteria->compare('status',$this->status);
		$criteria->compare('wali_name',$this->wali_name,true);
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
		
		if(!empty($_GET['Student']['fromDate']) && !empty($_GET['Student']['toDate'])){
			$this->fromDate = $_GET['Student']['fromDate'];
			$this->toDate = $_GET['Student']['toDate'];
			
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
	 * @return Student the static model class
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
	
	public function findByNisn($nisn) {
		$criteria = new CDbCriteria();
		$criteria->compare('nisn', $nisn);
		$model = self::model()->find($criteria);
		if(!$model) return false;
		return $model;
	}
	
	private function generateExpireDate() {
		return date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d H:i:s'))) . " + 5 year"));
	}
	
	public function generateCode()
	{
        $_d = date("ym");
        $_i = "SIS-";
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
	
	public static function genderLabels() {
		return array(
			'Laki-laki' =>'Laki-laki',
			'Perempuan' =>'Perempuan'
		);
	}
	
	public static function familyStatusLabels() {
		return array(
			self::FAMILY_KANDUNG => 'Anak Kandung',
			self::FAMILY_ANGKAT  => 'Anak Angkat',
			self::FAMILY_TIRI => 'Anak Tiri',
		);
	}
	
	public function familyStatusLabel() {
		$family = self::familyStatusLabels();
		return $family[$this->family_status];
	}
	
	public function getFamilyStatusWithStyle($status=null) {
		if($status==null) $status = $this->family_status;
		$labels = self::familyStatusLabels();
		switch($status) {
			case self::FAMILY_KANDUNG: return '<label class="label label-success">'.$labels[$status].'</label>';
			case self::FAMILY_ANGKAT: return '<label class="label label-primary">'.$labels[$status].'</label>';
			case self::FAMILY_TIRI: return '<label class="label label-danger">'.$labels[$status].'</label>';
			default: return '<label class="label label-primary">Not Known ('.$status.')</label>';
		}
	}
	
	public static function semesterLabels() {
		return array(
			self::SEMESTER_GENAP => 'Semester Genap',
			self::SEMESTER_GANJIL  => 'Semester Ganjil',
		);
	}
	
	public function getSemesterWithStyle($semester=null) {
		if($semester==null) $semester = $this->semester;
		$labels = self::semesterLabels();
		switch($semester) {
			case self::STATUS_ACTIVE: return '<label class="label label-success">'.$labels[$semester].'</label>';
			case self::STATUS_INACTIVE: return '<label class="label label-danger">'.$labels[$semester].'</label>';
			default: return '<label class="label label-danger">Not Known ('.$semester.')</label>';
		}
	}
	
	public static function studentStatusLabels() {
		return array(
			self::STATUS_STUDENT_ACTIVE => 'Aktif',
			self::STATUS_STUDENT_ALUMNI  => 'Alumni',
			self::STATUS_STUDENT_NEW  => 'Baru Masuk',
		);
	}
	
	public function getStudentStatusWithStyle($status=null) {
		if($status==null) $status = $this->student_status;
		$labels = self::studentStatusLabels();
		switch($status) {
			case self::STATUS_STUDENT_ACTIVE: return '<label class="label label-success">'.$labels[$status].'</label>';
			case self::STATUS_STUDENT_ALUMNI: return '<label class="label label-danger">'.$labels[$status].'</label>';
			case self::STATUS_STUDENT_NEW: return '<label class="label label-primary">'.$labels[$status].'</label>';
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
	
	public function getFatherEarning() {
		return 'Rp. '.Lib::rupiah($this->father_earning);
	}
	public function getMotherEarning() {
		return 'Rp. '.Lib::rupiah($this->mother_earning);
	}
}
