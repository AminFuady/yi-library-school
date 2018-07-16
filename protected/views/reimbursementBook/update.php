<?php
/* @var $this RackBookController */
/* @var $model RackBook */
?>

<?php
$this->breadcrumbs=array(
	'Rak Buku'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Rak Buku', 'url'=>array('index')),
	array('label'=>'Create Rak Buku', 'url'=>array('create')),
	array('label'=>'View Rak Buku', 'url'=>array('view', 'id'=>$model->id)),
);
?>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Update Rak Buku #<?php echo $model->id ?>
				</h3>
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>