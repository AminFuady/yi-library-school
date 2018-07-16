<?php

class ImportBookForm extends CFormModel
{
	public $file;
	public $filePath;
	public $fileName = 'sample-import-book.xlsx';
	
	public $success = 0;
	public $error = 0;
	public $errors = array();
	
	public function init() {
		$mainDir	= Yii::app()->basePath . "/../materials/";
		$this->filePath = $mainDir.'/imports/';
		if(!is_dir($mainDir)){ mkdir($mainDir); }
		if(!is_dir($this->filePath)){ mkdir($this->filePath); }
	}

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('file', 'required'),
			array('file', 'file', 
                'types'=>'xlsx',
				'allowEmpty'=>false,
                'enableClientValidation'=>true,
                'maxSize'=>1024 * 1024 * 2,
                'tooLarge'=>'File lebih dari 2MB, silahkan upload file yang lebih kecil.',
            ),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'file'=>'File',
		);
	}
	
	public function save() {
		foreach($this->readData() as $row):
			$model = new Book();
			$model->scenario = 'update';
			$model->code		= Book::model()->generateCode();
			$check = Book::model()->searchByTitle($row[0]);
			if($check) {
                $this->error++;
				$this->errors = CMap::mergeArray($this->errors, array('Duplicate: '.$row[0]));
				continue;
			}
			$model->title		= $row[0];
			$model->author		= $row[1];
			$model->publisher	= $row[2];
			$model->publish_year = $row[3];
			$model->publish_place = $row[4];
			$model->page		= $row[5];
			$model->height		= $row[6];
			$model->ddc			= $row[7];
			$model->isbn		= $row[8];
			$model->photo		= $model->photoDummy;
			$model->qty			= $row[9];
			$model->price		= $row[10];
			$model->category_book_id = $row[11];
			$model->source_book = $row[12];
			$model->no_inventaris = $row[13];
			$model->description = $row[14];
			$model->rack_book_id = $row[15];
			$model->status		= $row[16];
			$model->status_book = $row[17];
			
			if($model->save()):
				$this->success++;
			else:
				$this->error++;
				$this->errors = CMap::mergeArray($this->errors, array($row[0]));
			endif;
		endforeach;
		return true;
	}
	
	private function readData() {
		if($this->file->name == $this->fileName){
			$inputFileName = $this->file->tempName;

			new PHPExcel();

			// read file
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objReader->setReadDataOnly(true);
			$objPHPExcel = $objReader->load($inputFileName);
			$objWorksheet = $objPHPExcel->getActiveSheet();

			$highestRow = $objWorksheet->getHighestRow();
			$highestColumn = $objWorksheet->getHighestColumn();
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);


			$data = array();
			for ($row = 2; $row <= $highestRow; ++$row) {	
			  $rows = array();
			  for ($col = 0; $col < $highestColumnIndex; ++$col) {
				$rows[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
			  }
			  $data[] = $rows;
			}
			return $data;
		}
	}
	
	public function getDescriptionHtml() {
		$html   = MyTbHtml::alert('warning', 'Perhatian. Sebelum Import Data, diharapkan Download terlebih dahulu sample / template yang telah di rancang oleh system. '.$this->downloadSampleFileHtml());
		$html  .= MyTbHtml::alert('warning', 'Perhatian. Pada saat input data dalam Excel, kolom <b>Status</b> diisi dengan <b>10</b> artinya <b>Active</b> atau <b>0</b> artinya <b>Inactive</b>, jangan menuliskan Active atau Inactive, atau tidak akan bisa keinput dalam database.');
		$html  .= MyTbHtml::alert('warning', 'Perhatian. Pada saat input data dalam Excel, kolom <b>Status Buku</b> diisi dengan <b>10</b> artinya <b>Baru</b> atau <b>20</b> artinya <b>Bekas</b>, jangan menuliskan Baru atau Bekas, atau tidak akan bisa keinput dalam database.');
		$html  .= MyTbHtml::alert('warning', 'Perhatian. Disetiap Judul Kolom terdapat tanda (*) dibelakang, itu artinya wajib di isi.');
		
		$categoryLink = CHtml::link('Menuju Halaman Kategori Buku', Yii::app()->createUrl('categoryBook/actived'), array('target'=>'_blank'));
		$html .= MyTbHtml::alert('success', 'Informasi. Mengenai Kode Kategori Buku adalah sebagai berikut: <b>Ingat Pada Proses Input data dalam Excel, yang DIINPUT ADALAH ID, BUKAN NAME</b><br/>'. $categoryLink);
		
		$rackLink = CHtml::link('Menuju Halaman Rak Buku', Yii::app()->createUrl('rackBook/actived'), array('target'=>'_blank'));
		$html .= MyTbHtml::alert('success', 'Informasi. Mengenai Kode Rak Buku adalah sebagai berikut: <b>Ingat Pada Proses Input data dalam Excel, yang DIINPUT ADALAH ID, BUKAN NAME</b><br/>'. $rackLink);
		
		return $html;
	}
	
	public function downloadSampleFileLink() {
		return Yii::app()->createAbsoluteUrl('materials/'.$this->fileName);
	}
	
	public function downloadSampleFileHtml() {
		return CHtml::link('Sample Download Here', $this->downloadSampleFileLink(), array('target'=>'_blank'));
	}
}
