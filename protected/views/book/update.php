<?php
/* @var $this CategoryBookController */
/* @var $model CategoryBook */
?>

<?php
$this->breadcrumbs=array(
	'Buku'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Buku', 'url'=>array('index')),
	array('label'=>'Create Buku', 'url'=>array('create')),
	array('label'=>'View Buku', 'url'=>array('view', 'id'=>$model->id)),
);
?>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Update Buku #<?php echo $model->id; ?>
				</h3>
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>