<?php

class ImportStudentForm extends CFormModel
{
	public $file;
	public $filePath;
	public $fileName = 'sample-import-student.xlsx';
	
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
			$model = new Student();
			$model->scenario = 'update';
			$model->member_code = Student::model()->generateCode();
			$check = Student::model()->findByNisn($row[0]);
			if($check) {
                $this->error++;
				$this->errors = CMap::mergeArray($this->errors, array('Duplicate Nisn: '.$row[0]));
				continue;
			}
			$model->nisn		= $row[0];
			$model->nis 		= $row[1];
			$model->name    	= $row[2];
			$model->dob_place   = $row[3];
			$model->dob         = $row[4];
			$model->gender		= $row[5];
			$model->religion_id	= $row[6];
			$model->address		= $row[7];
			$model->no_telp		= $row[8];
			$model->photo		= $model->photoDummy;
			$model->grade_id	= $row[9];
			$model->departement_id = $row[10];
			$model->extracurricular = $row[11];
			$model->semester    = $row[12];
			$model->date_in     = $row[13];
			$model->previous_education_id = $row[14];
			$model->family_status = $row[15];
			$model->child_of	= $row[16];
			$model->family_qty  = $row[17];
			$model->father_name = $row[18];
			$model->mother_name = $row[19];
			$model->family_address = $row[20];
			$model->family_telp = $row[21];
			$model->father_work = $row[22];
			$model->mother_work = $row[23];
			$model->father_earning = $row[24];
			$model->mother_earning = $row[25];
			$model->wali_name   = $row[26];
			$model->wali_address = $row[27];
			$model->wali_telp   = $row[28];
			$model->wali_work   = $row[29];
			$model->student_status = $row[30];
			$model->status      = $row[31];
			
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
		$html  .= MyTbHtml::alert('warning', 'Perhatian. Pada saat input data dalam Excel, kolom <b>Status Siswa</b> diisi dengan <b>10</b> artinya <b>Aktif</b> atau <b>20</b> artinya <b>Alumni</b> atau <b>30</b> artinya <b>Baru Masuk</b>, jangan menuliskan Aktif atau Alumni atau Baru Masuk, atau tidak akan bisa keinput dalam database.');
		$html  .= MyTbHtml::alert('warning', 'Perhatian. Disetiap Judul Kolom terdapat tanda (*) dibelakang, itu artinya wajib di isi.');
		
		$religionLink = CHtml::link('Menuju Halaman Agama', Yii::app()->createUrl('religion/actived'), array('target'=>'_blank'));
		$html .= MyTbHtml::alert('success', 'Informasi. Mengenai Kode Agama adalah sebagai berikut: <b>Ingat Pada Proses Input data dalam Excel, yang DIINPUT ADALAH ID, BUKAN NAME</b><br/>'. $religionLink);
		
		$gradeLink = CHtml::link('Menuju Halaman Kelas', Yii::app()->createUrl('grade/actived'), array('target'=>'_blank'));
		$html .= MyTbHtml::alert('success', 'Informasi. Mengenai Kode kelas adalah sebagai berikut: <b>Ingat Pada Proses Input data dalam Excel, yang DIINPUT ADALAH ID, BUKAN NAME</b><br/>'. $gradeLink);
		
		$departementLink = CHtml::link('Menuju Halaman Jurusan', Yii::app()->createUrl('departement/actived'), array('target'=>'_blank'));
		$html .= MyTbHtml::alert('success', 'Informasi. Mengenai Kode Jurusan adalah sebagai berikut: <b>Ingat Pada Proses Input data dalam Excel, yang DIINPUT ADALAH ID, BUKAN NAME</b><br/>'. $departementLink);
		
		$departementLink = CHtml::link('Menuju Halaman Pendidikan Sebelumnya', Yii::app()->createUrl('previousEducation/actived'), array('target'=>'_blank'));
		$html .= MyTbHtml::alert('success', 'Informasi. Mengenai Kode Pendidikan Sebelumnya adalah sebagai berikut: <b>Ingat Pada Proses Input data dalam Excel, yang DIINPUT ADALAH ID, BUKAN NAME</b><br/>'. $departementLink);
		
		return $html;
	}
	
	public function downloadSampleFileLink() {
		return Yii::app()->createAbsoluteUrl('materials/'.$this->fileName);
	}
	
	public function downloadSampleFileHtml() {
		return CHtml::link('Sample Download Here', $this->downloadSampleFileLink(), array('target'=>'_blank'));
	}
}
