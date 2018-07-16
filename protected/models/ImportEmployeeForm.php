<?php

class ImportEmployeeForm extends CFormModel
{
	public $file;
	public $filePath;
	public $fileName = 'sample-import-employee.xlsx';
	
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
			$model = new Employee();
			$model->scenario = 'update';
			$model->member_code	= Employee::model()->generateCode();
			$check = Employee::model()->findByNik($row[0]);
			if($check) {
                $this->error++;
				$this->errors = CMap::mergeArray($this->errors, array('Duplicate Nik: '.$row[0]));
				continue;
			}
			$model->nik 		= $row[0];
			$model->name    	= $row[1];
			$model->dob_place	= $row[2];
			$model->dob         = $row[3];
			$model->gender      = $row[4];
			$model->religion_id = $row[5];
			$model->address		= $row[6];
			$model->no_telp		= $row[7];
			$model->position_id	= $row[8];
			$model->date_in		= $row[9];
			$model->photo		= $model->photoDummy;
			$model->marital_status = $row[10];
			$model->previous_education_id = $row[11];
			$model->instance_previous_education = $row[12];
			$model->graduation_year = $row[13];
			$model->employee_status = $row[14];
			$model->status      = $row[15];
			
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
	
	public function getDescriptionHtml() {
		$html   = MyTbHtml::alert('warning', 'Perhatian. Sebelum Import Data, diharapkan Download terlebih dahulu sample / template yang telah di rancang oleh system. '.$this->downloadSampleFileHtml());
		$html  .= MyTbHtml::alert('warning', 'Perhatian. Pada saat input data dalam Excel, kolom <b>Status</b> diisi dengan <b>10</b> artinya <b>Active</b> atau <b>0</b> artinya <b>Inactive</b>, jangan menuliskan Active atau Inactive, atau tidak akan bisa keinput dalam database.');
		$html  .= MyTbHtml::alert('warning', 'Perhatian. Pada saat input data dalam Excel, kolom <b>Status Guru</b> diisi dengan <b>10</b> artinya <b>PNS</b> atau <b>20</b> artinya <b>Honorer</b>, jangan menuliskan PNS atau Honorer, atau tidak akan bisa keinput dalam database.');
		$html  .= MyTbHtml::alert('warning', 'Perhatian. Disetiap Judul Kolom terdapat tanda (*) dibelakang, itu artinya wajib di isi.');
		
		$religionLink = CHtml::link('Menuju Halaman Agama', Yii::app()->createUrl('religion/actived'), array('target'=>'_blank'));
		$html .= MyTbHtml::alert('success', 'Informasi. Mengenai Kode Agama adalah sebagai berikut: <b>Ingat Pada Proses Input data dalam Excel, yang DIINPUT ADALAH ID, BUKAN NAME</b><br/>'. $religionLink);
        
		$religionLink = CHtml::link('Menuju Halaman Posisi/Jabatan', Yii::app()->createUrl('position/actived'), array('target'=>'_blank'));
		$html .= MyTbHtml::alert('success', 'Informasi. Mengenai Kode Posisi/Jabatan adalah sebagai berikut: <b>Ingat Pada Proses Input data dalam Excel, yang DIINPUT ADALAH ID, BUKAN NAME</b><br/>'. $religionLink);
		
		$departementLink = CHtml::link('Menuju Halaman Pendidikan Terakhir', Yii::app()->createUrl('previousEducation/actived'), array('target'=>'_blank'));
		$html .= MyTbHtml::alert('success', 'Informasi. Mengenai Kode Pendidikan Terakhir adalah sebagai berikut: <b>Ingat Pada Proses Input data dalam Excel, yang DIINPUT ADALAH ID, BUKAN NAME</b><br/>'. $departementLink);
		
		return $html;
	}
	
	public function downloadSampleFileLink() {
		return Yii::app()->createAbsoluteUrl('materials/'.$this->fileName);
	}
	
	public function downloadSampleFileHtml() {
		return CHtml::link('Sample Download Here', $this->downloadSampleFileLink(), array('target'=>'_blank'));
	}
}
