<?php

/**
 * This is the model class for table "detail_loaning_book".
 *
 * The followings are the available columns in table 'detail_loaning_book':
 * @property integer $id
 * @property integer $loaning_book_id
 * @property string $code
 * @property string $qty
 * @property string $description
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class LoaningBookDetail extends MyActiveRecord
{
    const STATUS_PROSES = 10;
    const STATUS_KEMBALI = 20;
    const STATUS_HILANG = 30;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detail_loaning_book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('loaning_book_id, code, qty', 'required'),
			array('loaning_book_id, status, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>20),
			array('qty', 'length', 'max'=>12),
			array('description', 'length', 'max'=>500),
            array('status', 'default', 'value'=>self::STATUS_PROSES),
			array('created_at, updated_at, status, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, loaning_book_id, code, qty, description, status, created_at, created_by, updated_at, updated_by', 'safe', 'on'=>'search'),
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
			'loaningBook' => array(self::BELONGS_TO, 'LoaningBook', 'loaning_book_id'),
		);
	}
    
    public function getBook() {
        $book = Book::model()->findByCode($this->code);
        if($book) return $book;
        return false;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'loaning_book_id' => 'Peminjaman Buku',
			'code' => 'Kode Buku',
			'qty' => 'Jumlah Buku',
			'description' => 'Keterangan',
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
		$criteria->compare('loaning_book_id',$this->loaning_book_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('qty',$this->qty,true);
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
	 * @return DetailLoaningBook the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public static function statusLabels() {
		return array(
			self::STATUS_PROSES => 'Proses Pinjam',
			self::STATUS_KEMBALI => 'Kembali',
			self::STATUS_HILANG => 'Hilang',
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
			case self::STATUS_PROSES: return '<label class="label label-warning">'.$labels[$status].'</label>';
			case self::STATUS_KEMBALI: return '<label class="label label-success">'.$labels[$status].'</label>';
			case self::STATUS_HILANG: return '<label class="label label-danger">'.$labels[$status].'</label>';
			default: return '<label class="label label-primary">Not Known ('.$status.')</label>';
		}
	}
    
    public function geToLinkBook($target='_BLANK') {
        $link = Yii::app()->createUrl('book/view', array('id'=>$this->getBook()->id));
        return CHtml::link($this->code, $link, array('target'=>$target));
    }
	
	public function saveMinQuantityBook(){
		$book = Book::model()->findByCode($this->code);
		return $book->saveMinQuantity($this->qty);
	}
	
	public function savePlusQuantityBook(){
		$book = Book::model()->findByCode($this->code);
		return $book->savePlusQuantity($this->qty);
	}
	
}
