<?php
/* @var $this PositionController */
/* @var $model Position */
?>

<?php
$this->breadcrumbs=array(
	'Pendidikan Terakhir'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pendidikan Terakhir', 'url'=>array('index')),
	array('label'=>'Create Pendidikan Terakhir', 'url'=>array('create')),
	array('label'=>'View Pendidikan Terakhir', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Update Pendidikan Terakhir #<?php echo $model->id; ?>
				</h3>
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>