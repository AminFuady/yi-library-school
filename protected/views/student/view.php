<?php
/* @var $this StudentController */
/* @var $model Student */
?>

<?php
$this->breadcrumbs=array(
	'Siswa'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Siswa', 'url'=>array('index')),
	array('label'=>'Create Siswa', 'url'=>array('create')),
	array('label'=>'Update Siswa', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Cetak Kartu Anggota', 'url'=>array('printMember', 'id'=>$model->id)),
	array('label'=>'Delete Siswa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>View Siswa #<?php echo $model->id; ?>
				</h3>
			</div>
			<div class="box-content">
				<?php $this->widget('zii.widgets.CDetailView',array(
					'htmlOptions' => array(
						'class' => 'table table-striped table-condensed table-hover',
					),
					'data'=>$model,
					'attributes'=>array(
						'id',
						'member_code',
						'nisn',
						'nis',
						'name',
						array(
							'name'=>'photo',
							'value'=>$model->getPhoto(),
							'type'=>'raw',
						),
						'dob_place',
						array(
							'name'=>'dob',
							'value'=>Lib::indoDate($model->dob),
							'type'=>'raw',
						),
						'gender',
						array(
							'name'=>'religion_id',
							'value'=>$model->religion->name,
							'type'=>'raw',
						),
						'address',
						'no_telp',
						array(
							'name'=>'grade_id',
							'value'=>$model->grade->name,
							'type'=>'raw',
						),
						array(
							'name'=>'departement_id',
							'value'=>$model->departement->name,
							'type'=>'raw',
						),
						'extracurricular',
						array(
							'name'=>'semester',
							'value'=>$model->getSemesterWithStyle(),
							'type'=>'raw',
						),
						array(
							'name'=>'date_in',
							'value'=>Lib::indoDate($model->date_in),
							'type'=>'raw',
						),
						array(
							'name'=>'previous_education_id',
							'value'=>$model->previousEducation->name,
							'type'=>'raw',
						),
						array(
							'name'=>'family_status',
							'value'=>$model->getFamilyStatusWithStyle($model->family_status),
							'type'=>'raw',
						),
						'child_of',
						'family_qty',
						'father_name',
						'mother_name',
						'family_address',
						'family_telp',
						'father_work',
						'mother_work',
						array(
							'name'=>'father_earning',
							'value'=>$model->getFatherEarning(),
							'type'=>'raw',
						),
						array(
							'name'=>'mother_earning',
							'value'=>$model->getMotherEarning(),
							'type'=>'raw',
						),
						'wali_name',
						'wali_address',
						'wali_telp',
						'wali_work',
						array(
							'name'=>'expire_date',
							'value'=>Lib::indoDate($model->expire_date),
							'type'=>'raw',
						),
						array(
							'name' => 'student_status',
							'value' => $model->getStudentStatusWithStyle(),
							'type'=>'raw',
						),
						array(
							'name' => 'status',
							'value' => $model->getStatusWithStyle($model->status),
							'type'=>'raw',
						),
						DetailViewHelper::shortDate($model, 'created_at'),
						DetailViewHelper::author($model, 'created_by'),
						DetailViewHelper::shortDate($model, 'updated_at'),
						DetailViewHelper::author($model, 'updated_by'),
					),
				)); ?>
				<br/>
				<?php
					echo CHtml::link('Update', array($this->id.'/update/'.$model->id), array('class'=>'btn btn-primary'));
					echo "&nbsp;&nbsp;";
					echo CHtml::link('Back', array($this->id.'/index'), array('class'=>'btn btn-danger'));
					echo "&nbsp;&nbsp;";
					echo CHtml::link('Cetak Kartu Anggota', array($this->id.'/printMember/'.$model->id), array('class'=>'btn btn-success'));
				?>
			</div>
		</div>
	</div>
</div>