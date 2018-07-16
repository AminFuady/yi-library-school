<?php
/* @var $this LoaningBookController */
/* @var $model LoaningBook */
?>

<?php
$this->breadcrumbs=array(
	'Peminjaman Buku'=>array('index'),
	$model->loaning_code=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Peminjaman Buku', 'url'=>array('index')),
	array('label'=>'Create Peminjaman Buku', 'url'=>array('create')),
	array('label'=>'View Peminjaman Buku', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Update Form Peminjaman #<?php echo $model->id; ?>
				</h3>
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>