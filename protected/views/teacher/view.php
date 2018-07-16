<?php
/* @var $this TeacherController */
/* @var $model Teacher */
?>

<?php
$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Guru', 'url'=>array('index')),
	array('label'=>'Create Guru', 'url'=>array('create')),
	array('label'=>'Update Guru', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Guru', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>View Guru #<?php echo $model->id; ?>
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
							'name'=>'date_in',
							'value'=>Lib::indoDate($model->date_in),
							'type'=>'raw',
						),
						array(
							'name'=>'marital_status',
							'value'=>$model->getMaritalStatusWithStyle(),
							'type'=>'raw',
						),
						array(
							'name'=>'photo',
							'value'=>$model->getPhoto(),
							'type'=>'raw',
						),
						array(
							'name'=>'previous_education_id',
							'value'=>$model->previousEducation->name,
							'type'=>'raw',
						),
						'instance_previous_education',
						'graduation_year',
						array(
							'name' => 'teacher_status',
							'value' => $model->getTeacherStatusWithStyle(),
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