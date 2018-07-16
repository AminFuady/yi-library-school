<?php

/**
 * This is the model class for table "loaning_book".
 *
 * The followings are the available columns in table 'loaning_book':
 * @property integer $id
 * @property integer $initial_member
 * @property string $loaning_code
 * @property string $member_code
 * @property string $loaning_date
 * @property string $reimbursement_date
 * @property integer $status
 * @property string $status_date
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class LoaningBook extends MyActiveRecord
{
	const MEMBER_STUDENT = 1;
	const MEMBER_TEACHER = 2;
	const MEMBER_EMPLOYEE = 3;
    
    const STATUS_LOAN = 10;
    const STATUS_BACK = 20;
    const STATUS_DENDA = 30;
	
	public $duration;
	public $filterReimbursementDate;
	public $fromDate;
	public $toDate;
	public $reimbursementDate;
	public $denda;
	public $totalDenda;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'loaning_book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('initial_member', 'required', 'on'=>'insert'),
			array('loaning_code, member_code, loaning_date, reimbursement_date', 'required'),
			array('status, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('loaning_code, member_code', 'length', 'max'=>20),
            array('status', 'default', 'value'=>self::STATUS_LOAN),
			array('status_date', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			array('created_at, updated_at, status, status_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fromDate, toDate, id, initial_member, loaning_code, member_code, loaning_date, '
				. 'reimbursement_date, status, status_date, created_at, created_by, updated_at, '
				. 'updated_by, filterReimbursementDate,'
				. 'reimbursementDate, denda, totalDenda', 'safe', 'on'=>'search'),
		);
	}
	
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			if($this->reimbursement_date <= $this->loaning_date) {
				$this->addError('reimbursement_date', 'Tanggal Pengembalian harus lebih dari Tanggal Peminjaman ...');
			}
		}
        
        return true;
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
			'loaningBookDetails' => array(self::HAS_MANY, 'LoaningBookDetail', 'loaning_book_id'),
            'reimbursementBook' => array(self::HAS_ONE, 'ReimbursementBook', 'loaning_book_id'),
		);
	}
    
    public function getMemberIdentity($initialMember=null, $memberCode=null) {
		if($initialMember == null) $initialMember = $this->initial_member;
		if($memberCode == null) $memberCode = $this->member_code;
		
        switch($initialMember){
            case self::MEMBER_STUDENT :
                $data = Student::model()->findByMemberCode($memberCode); break;
            case self::MEMBER_EMPLOYEE :
                $data = Employee::model()->findByMemberCode($memberCode); break;
            case self::MEMBER_TEACHER :
                $data = Teacher::model()->findByMemberCode($memberCode); break;
        }
        return $data;
    }
	
	public function getMemberIdentityByName($name) {
		$data = Student::model()->findByName($name);
		if($data) return $data;
		
		$data = Teacher::model()->findByName($name);
		if($data) return $data;
		
		$data = Employee::model()->findByName($name);
		if($data) return $data;
		
		return false;
	}
	
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->loaning_code = $this->generateCode();
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
			'initial_member' => 'Inisial Angota',
			'loaning_code' => 'Kode Peminjaman',
			'member_code' => 'Kode Anggota',
			'loaning_date' => 'Tanggal Peminjaman',
			'reimbursement_date' => 'Tanggal Pengembalian',
			'status' => 'Status',
			'status_date' => 'Tanggal Perubahan Status',
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
		
		if($this->filterReimbursementDate):
			$criteria->addCondition('reimbursement_date < '.date('Y-m-d'), 'AND');
		endif;

		$criteria->compare('id',$this->id);
		$criteria->compare('initial_member',$this->initial_member,true);
		$criteria->compare('loaning_code',$this->loaning_code,true);
		$criteria->compare('member_code',$this->member_code,true);
		$criteria->compare('loaning_date',$this->loaning_date,true);
		$criteria->compare('reimbursement_date',$this->reimbursement_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('status_date',$this->status_date);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function report($pagination=null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		if($this->filterReimbursementDate):
			$criteria->addCondition('reimbursement_date < '.date('Y-m-d'), 'AND');
		endif;
		
		if(!empty($_GET['LoaningBook']['fromDate']) && !empty($_GET['LoaningBook']['toDate'])){
			$this->fromDate = $_GET['LoaningBook']['fromDate'];
			$this->toDate = $_GET['LoaningBook']['toDate'];
			
			$this->fromDate = $this->fromDate;
			$this->toDate = $this->toDate;
			$criteria->addBetweenCondition('loaning_date', $this->fromDate, $this->toDate, 'AND');
		}

		$criteria->compare('id',$this->id);
		$criteria->compare('initial_member',$this->initial_member,true);
		$criteria->compare('loaning_code',$this->loaning_code,true);
		$criteria->compare('member_code',$this->member_code,true);
		$criteria->compare('reimbursement_date',$this->reimbursement_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('status_date',$this->status_date);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('updated_by',$this->updated_by);

		$criteria->order = 'loaning_date DESC';
		
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
	
	public function reportDenda($pagination=null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->with = array('reimbursementBook');
		
		if($this->filterReimbursementDate):
			$criteria->addCondition('reimbursement_date < '.date('Y-m-d'), 'AND');
		endif;
		
		if(!empty($_GET['LoaningBook']['fromDate']) && !empty($_GET['LoaningBook']['toDate'])){
			$this->fromDate = $_GET['LoaningBook']['fromDate'];
			$this->toDate = $_GET['LoaningBook']['toDate'];
			
			$this->fromDate = $this->fromDate;
			$this->toDate = $this->toDate;
			$criteria->addBetweenCondition('reimbursementBook.reimbursement_date', $this->fromDate, $this->toDate, 'AND');
		}

		$criteria->compare('id',$this->id);
		$criteria->compare('loaning_code',$this->loaning_code,true);
		$criteria->compare('member_code',$this->member_code,true);
		$criteria->compare('loaning_date',$this->loaning_date,true);
		$criteria->compare('reimbursementBook.denda',$this->denda);
		$criteria->compare('reimbursementBook.total_denda',$this->totalDenda);
		$criteria->compare('status',self::STATUS_DENDA);
		$criteria->compare('status_date',$this->status_date);

		$criteria->order = 'reimbursementBook.reimbursement_date DESC';
		
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
	
	public function getTotalReportDenda()
	{
		$reports = $this->reportDenda('noPagination');
		$subtotal = 0;
		if($reports!=null):
			//counting total keseluruhan
			foreach($reports->data as $data):
				$subtotal += $data->reimbursementBook->total_denda;
			endforeach;
		endif;
		
		return $subtotal;
	}
	
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LoaningBook the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function defaultScope() {
		return array(
			'order' => 't.created_at DESC',
		);
	}
	
	public function saveStatusBack() {
		$this->status = self::STATUS_BACK;
		$this->status_date = date('Y-m-d H:i:s');
		$this->saveAttributes(array('status', 'status_date'));
		if($this->loaningBookDetails):
			foreach($this->loaningBookDetails as $model):
				$model->status = LoaningBookDetail::STATUS_KEMBALI;
				$model->saveAttributes(array('status'));
				$model->savePlusQuantityBook();
			endforeach;
		endif;
		return $this->saveAttributes(array('status', 'status_date'));
	}
	
	public function saveStatusDenda() {
		$this->status = self::STATUS_DENDA;
		$this->status_date = date('Y-m-d H:i:s');
		if($this->loaningBookDetails):
			foreach($this->loaningBookDetails as $model):
				$model->status = LoaningBookDetail::STATUS_KEMBALI;
				$model->saveAttributes(array('status'));
				$model->savePlusQuantityBook();
			endforeach;
		endif;
		return $this->saveAttributes(array('status', 'status_date'));
	}
    
    public function findByLoaningCode($code) {
        $model = self::model()->findByAttributes(array('loaning_code'=>$code));
        if(!$model) return false;
        return $model;
    }
	
    public function findByMemberCode($code) {
        $model = self::model()->findByAttributes(array('member_code'=>$code));
        if(!$model) return false;
        return $model;
    }
	
	public function getLoanQuantity() {
		$quantity = 0;
		if($this->loaningBookDetails):
			foreach($this->loaningBookDetails as $detail){
				$quantity = $quantity + $detail->qty;
			}
		endif;
		return $quantity;
	}
	
	public function getBooksHtml() {
		$html = '';
		if($this->loaningBookDetails):
			$html .= CHtml::openTag('ol');
			foreach($this->loaningBookDetails as $detail) {
				$html .= CHtml::tag('li', array(), $detail->getBook()->title);
			}
			$html .= CHtml::closeTag('ol');
		endif;
		return $html;
	}
	
	public function getDendaWithTotal($code) {
		$model = $this->findByMemberCode($code);
		if(!$model) return false;
		
		if($model->reimbursement_date < date('Y-m-d')):
			$duration = self::getDuration(date('Y-m-d'), $model->reimbursement_date);
			$denda	  = Duration::model()->getDendaStudent();
			$total	  = ($denda * $duration);
		else:
			$denda	  = 0;
			$total	  = 0;
		endif;
		
		return array(
			'denda' => $denda,
			'total' => $total,
		);
	}
	
    public function generateCode()
	{
        $_d = date("ym");
        $_i = "LOAN-";
        $_left = $_i . $_d . '-';
        $_first = "000001";
        $_len = strlen($_left);
        $no = $_left . $_first;
      
        $lastPo = $this->find(
                array(
                    "select"=>"loaning_code",
                    "condition" => "left(loaning_code, " . $_len . ") = :_left",
                    "params" => array(":_left" => $_left),
                    "order" => "id DESC"
                ));

        if($lastPo != null):
            $_no = substr($lastPo->loaning_code, $_len);
            $_no++;
            $_no = substr("000000", strlen($_no)) . $_no;
            $no = $_left . $_no;
        endif;
		
        return $no;
    }
	
	public static function initialMemberLabels() {
		return array(
			self::MEMBER_STUDENT => 'Siswa',
			self::MEMBER_TEACHER => 'Guru',
			self::MEMBER_EMPLOYEE => 'Karyawan',
		);
	}
	
	public function initialMemberLabel() {
		return self::initialMemberLabels()[$this->initial_member];
	}
	
	public function listMember($id) {
		if($id=='') return null;
		$data = array();
		switch($id) {
			case self::MEMBER_STUDENT:
				$data = Student::model()->actived()->findAll(); break;
			case self::MEMBER_TEACHER:
				$data = Teacher::model()->actived()->findAll(); break;
			case self::MEMBER_EMPLOYEE:
				$data = Employee::model()->actived()->findAll(); break;
		}
		return $data;
	}
	
	public function getReimbursementDate($date, $duration) {
		$date = date_create($date);
		date_add($date, date_interval_create_from_date_string($duration." days"));
		return date_format($date,"Y-m-d");
	}
    
    public static function statusLabels() {
		return array(
			self::STATUS_LOAN => 'Pinjam',
			self::STATUS_BACK => 'Sudah Kembali',
			self::STATUS_DENDA => 'Denda',
		);
	}
    
    public function statusLabel() {
		$labels = self::statusLabels();
		return $labels[$this->status];
	}
	
	public function getStatusWithStyle($status=null) {
		if($status==null) $status = $this->status;
		$labels = self::statusLabels();
		switch($status) {
			case self::STATUS_LOAN: return '<label class="label label-warning">'.$labels[$status].'</label>';
			case self::STATUS_BACK: return '<label class="label label-success">'.$labels[$status].'</label>';
			case self::STATUS_DENDA: return '<label class="label label-danger">'.$labels[$status].'</label>';
			default: return '<label class="label label-primary">Not Known ('.$status.')</label>';
		}
	}
    
    public function buttonReimbursementBook() {
        $html = '';
        switch($this->status) {
            case self::STATUS_LOAN :
                $html = CHtml::link('Form Pengembalian Buku #'.$this->loaning_code, Yii::app()->createUrl('reimbursementBook/create', array('id'=>$this->id)), array('class'=>'btn btn-success'));
        }
        return $html;
    }
}
