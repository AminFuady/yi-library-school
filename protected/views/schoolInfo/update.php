<?php
/* @var $this RackBookController */
/* @var $model RackBook */
?>

<?php
$this->breadcrumbs=array(
	'Info Sekolah'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Info Sekolah', 'url'=>array('index')),
	array('label'=>'View Info Sekolah', 'url'=>array('view', 'id'=>$model->id)),
);
?>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Update Info Sekolah #<?php echo $model->id ?>
				</h3>
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>