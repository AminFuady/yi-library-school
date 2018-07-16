<?php
/* @var $this GradeController */
/* @var $model Grade */
?>

<?php
$this->breadcrumbs=array(
	'Kelas'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Kelas', 'url'=>array('index')),
	array('label'=>'Create Kelas', 'url'=>array('create')),
	array('label'=>'Update Kelas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Kelas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>View Kelas #<?php echo $model->id; ?>
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
						'name',
						'description',
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