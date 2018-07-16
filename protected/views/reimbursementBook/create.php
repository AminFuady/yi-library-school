<?php
/* @var $this RackBookController */
/* @var $model RackBook */
?>

<?php
$this->breadcrumbs=array(
	'Pengembalian Buku'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pengembalian Buku', 'url'=>array('index')),
);
?>

<div class="row">
	<div class="col-sm-6">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-book"></i>Form Pengembalian Buku
				</h3>
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="box box-color box-bordered lime">
			<div class="box-title">
				<h3>
					<i class="fa fa-book"></i>Detail Peminjaman Buku
				</h3>
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_form-loaning-detail', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>