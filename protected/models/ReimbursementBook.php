<?php

/**
 * This is the model class for table "reimbursement_book".
 *
 * The followings are the available columns in table 'reimbursement_book':
 * @property integer $id
 * @property string $loaning_book_id
 * @property string $reimbursement_date
 * @property string $denda
 * @property string $total_denda
 * @property string $description
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class ReimbursementBook extends MyActiveRecord
{
    public $member_code;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reimbursement_book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('member_code', 'required', 'on'=>'insert'),
			array('reimbursement_date, denda, total_denda, description', 'required'),
			array('user_id, created_by, loaning_book_id, updated_by', 'numerical', 'integerOnly'=>true),
			array('denda, total_denda', 'length', 'max'=>12),
			array('description', 'length', 'max'=>500),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, loaning_book_id, reimbursement_date, denda, total_denda, description, created_at, created_by, updated_at, updated_by', 'safe', 'on'=>'search'),
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
            'loaningBook' => array(self::BELONGS_TO, 'LoaningBook', 'loaning_book_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'loaning_book_id' => 'Kode Peminjaman',
			'reimbursement_date' => 'Tanggal Pengembalian',
			'denda' => 'Denda',
			'total_denda' => 'Total Denda',
			'description' => 'Deskripsi',
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
		$criteria->compare('loaning_book_id',$this->loaning_book_id,true);
		$criteria->compare('reimbursement_date',$this->reimbursement_date,true);
		$criteria->compare('denda',$this->denda,true);
		$criteria->compare('total_denda',$this->total_denda,true);
		$criteria->compare('description',$this->description,true);
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
	 * @return ReimbursementBook the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getDenda() {
		return "Rp. ". Lib::rupiah($this->denda) . "/hari";
	}
	
	public function getTotalDenda() {
		return "Rp. ". Lib::rupiah($this->total_denda);
	}
}
