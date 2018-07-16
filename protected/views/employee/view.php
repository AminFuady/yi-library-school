<?php
/* @var $this EmployeeController */
/* @var $model Employee */
?>

<?php
$this->breadcrumbs=array(
	'Karyawan'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Karyawan', 'url'=>array('index')),
	array('label'=>'Create Karyawan', 'url'=>array('create')),
	array('label'=>'Update Karyawan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Karyawan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Karyawan', 'url'=>array('admin')),
);
?>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>View Karyawan #<?php echo $model->id; ?>
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
						'nik',
						'code',
						'name',
						'address',
						'dob_place',
						array(
							'name' => 'dob',
							'value' => Lib::indoDate($model->dob),
							'type'=>'raw',
						),
						array(
							'name' => 'religion_id',
							'value' => $model->religion->name,
							'type'=>'raw',
						),
						'gender',
						'no_telp',
						array(
							'name' => 'photo',
							'value' => $model->getPhoto(),
							'type'=>'raw',
						),
						array(
							'name' => 'position_id',
							'value' => $model->position->name,
							'type'=>'raw',
						),
						array(
							'name' => 'date_in',
							'value' => Lib::indoDate($model->date_in),
							'type'=>'raw',
						),
						array(
							'name' => 'marital_status',
							'value' => $model->maritalStatusLabel(),
							'type'=>'raw',
						),
						array(
							'name' => 'previous_education_id',
							'value' => $model->previousEducation->name,
							'type'=>'raw',
						),
						'instance_previous_education',
						'graduation_year',
						array(
							'name' => 'employee_status',
							'value' => $model->getEmployeeStatusWithStyle(),
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
				?>
			</div>
		</div>
	</div>
</div>