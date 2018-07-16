<?php

/**
 * This is the model class for table "book".
 *
 * The followings are the available columns in table 'book':
 * @property integer $id
 * @property string $code
 * @property string $title
 * @property string $author
 * @property string $publisher
 * @property integer $publish_year
 * @property string $publish_place
 * @property integer $page
 * @property integer $height
 * @property string $ddc
 * @property string $isbn
 * @property string $qty
 * @property string $price
 * @property integer $category_book_id
 * @property string $source_book
 * @property string $no_inventaris
 * @property string $description
 * @property integer $rack_book_id
 * @property integer $status
 * @property string $photo
 * @property integer $status_book
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Book extends MyActiveRecord
{
	const STATUS_BOOK_NEW = '10'; //baru
	const STATUS_BOOK_USED = '20'; //bekas
	
	public $photoPath;
	public $photoUrl;
	public $photoDummy;
	public $fromDate;
	public $toDate;
	
	public function init() {
		$this->photoDummy = 'book_dummy.png';
		$mainDir	= Yii::app()->basePath . "/../images/";
		$this->photoUrl = Yii::app()->request->baseUrl . '/images/book/';
		$this->photoPath = $mainDir.'/book/';
		if(!is_dir($mainDir)){ mkdir($mainDir); }
		if(!is_dir($this->photoPath)){ mkdir($this->photoPath); }
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'book';
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
			array('code, title, author, publisher, publish_year, publish_place, qty, price, category_book_id, source_book, rack_book_id, status, status_book', 'required'),
			array('publish_year, page, height, qty, price, category_book_id, rack_book_id, status, status_book, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>80),
			array('title', 'length', 'max'=>300),
			array('author, publisher, photo', 'length', 'max'=>100),
			array('publish_place, ddc, isbn', 'length', 'max'=>50),
			array('qty, price', 'length', 'max'=>12),
			array('source_book', 'length', 'max'=>70),
			array('no_inventaris', 'length', 'max'=>20),
			array('description', 'length', 'max'=>500),
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
			array('created_at, updated_at, photo, height, ddc, isbn, no_inventaris, description, page', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, title, author, publisher, publish_year, publish_place, page, height, ddc, isbn, qty, price, category_book_id, source_book, no_inventaris, description, rack_book_id, status, photo, status_book, created_at, updated_at, created_by, updated_by', 'safe', 'on'=>'search'),
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
			'categoryBook' => array(self::BELONGS_TO, 'CategoryBook', 'category_book_id'),
			'rackBook' => array(self::BELONGS_TO, 'RackBook', 'rack_book_id'),
		);
	}
	
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->code = $this->generateCode();
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
			'code' => 'Kode Buku',
			'title' => 'Judul Buku',
			'author' => 'Penulis',
			'publisher' => 'Penerbit',
			'publish_year' => 'Tahun Terbit',
			'publish_place' => 'Tempat Terbit',
			'page' => 'Halaman',
			'height' => 'Tinggi',
			'ddc' => 'Ddc',
			'isbn' => 'Isbn',
			'qty' => 'Jumlah Buku',
			'price' => 'Harga Buku',
			'category_book_id' => 'Kategori Buku',
			'source_book' => 'Sumber Buku',
			'no_inventaris' => 'No Inventaris',
			'description' => 'Deskripsi',
			'rack_book_id' => 'Rak Buku',
			'status' => 'Status',
			'photo' => 'Photo',
			'status_book' => 'Status Buku',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'created_by' => 'Created By',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('publish_year',$this->publish_year);
		$criteria->compare('publish_place',$this->publish_place,true);
		$criteria->compare('page',$this->page);
		$criteria->compare('height',$this->height);
		$criteria->compare('ddc',$this->ddc,true);
		$criteria->compare('isbn',$this->isbn,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('category_book_id',$this->category_book_id);
		$criteria->compare('source_book',$this->source_book,true);
		$criteria->compare('no_inventaris',$this->no_inventaris,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('rack_book_id',$this->rack_book_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('status_book',$this->status_book);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function filterBetweenDate($pagination=null)
	{	
		$criteria = new CDbCriteria;
		
		if(!empty($_GET['Book']['fromDate']) && !empty($_GET['Book']['toDate'])){
			$this->fromDate = $_GET['Book']['fromDate'];
			$this->toDate = $_GET['Book']['toDate'];
			
			$this->fromDate = $this->fromDate.' 00:00:00';
			$this->toDate = $this->toDate.' 23:59:59';
			$criteria->addBetweenCondition('created_at', $this->fromDate, $this->toDate, 'AND');
		}
		
		$criteria->order = 'created_at DESC';
		
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
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function defaultScope() {
		return array(
			'order' => 'title ASC',
		);
	}
	
	public function saveMinQuantity($qty) {
		$this->qty = ($this->qty - $qty);
		return $this->saveAttributes(array('qty'));
	}
	
	public function savePlusQuantity($qty) {
		$this->qty = ($this->qty + $qty);
		return $this->saveAttributes(array('qty'));
	}
	
	public function scopes() {
		return CMap::mergeArray(array(
				'availableQty' => array('condition'=>'qty > 0')
			), parent::scopes());
	}
    
    public function findByCode($code) {
        $model = self::model()->findByAttributes(array('code'=>$code));
        if(!$model) return false;
        return $model;
    }
	
	public function searchByTitle($title) {
		$criteria = new CDbCriteria();
		$criteria->addSearchCondition('title', $title, true, 'AND', 'LIKE');
		$model = self::model()->find($criteria);
		if(!$model) return false;
		return $model;
	}
	
	public function saveQuantity($quantity) {
		$this->qty = $quantity;
		return $this->saveAttributes(array('qty'));
	}
	
	public function getCodeWithTitle() {
		return $this->code .' - '. $this->title;
	}
	
	public static function statusBookLabels() {
		return array(
			self::STATUS_BOOK_NEW => 'Baru',
			self::STATUS_BOOK_USED => 'Bekas',
		);
	}
	
	public function statusBookLabel() {
		$labels = self::statusBookLabels();
		return $labels[$this->status];
	}
	
	public function getStatusBookWithStyle($status=null) {
		if($status==null) $status = $this->status;
		$labels = self::statusLabels();
		switch($status) {
			case self::STATUS_BOOK_NEW: return '<label class="label label-success">'.$labels[$status].'</label>';
			case self::STATUS_BOOK_USED: return '<label class="label label-danger">'.$labels[$status].'</label>';
			default: return '<label class="label label-primary">Not Known ('.$status.')</label>';
		}
	}
	
	public function generateCode()
	{
        $_d = date("ym");
        $_i = "BO-";
        $_left = $_i . $_d . '-';
        $_first = "000001";
        $_len = strlen($_left);
        $no = $_left . $_first;
      
        $lastPo = $this->find(
                array(
                    "select"=>"code",
                    "condition" => "left(code, " . $_len . ") = :_left",
                    "params" => array(":_left" => $_left),
                    "order" => "id DESC"
                ));

        if($lastPo != null):
            $_no = substr($lastPo->code, $_len);
            $_no++;
            $_no = substr("000000", strlen($_no)) . $_no;
            $no = $_left . $_no;
        endif;
		
        return $no;
    }
	
	public function photoName() {
		$labels         = (isset($this->title)) ? $this->title : date('Y');
		$labels         = str_replace(' ', '-', strtolower($labels));
		$uploadedFile   = md5(date('Y-m-d H:i:s')). '.' . $this->photo->getExtensionName();
		$fileName       = "{$labels}-{$uploadedFile}";  // random number + file name
		return $fileName;
	}
	
	public function getPrice() {
		return 'Rp. '.Lib::rupiah($this->price);
	}
	
	public function getHeight() {
		return $this->height . ' Cm';
	}
	
	public function getPhoto($htmlOptions=array('style'=>'width:30%')) {
		$url = $this->photoUrl.$this->photo;
		$img = CHtml::image($url, $this->title, $htmlOptions);
		return $img;
	}
	
}
