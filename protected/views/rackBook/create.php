<?php
/* @var $this RackBookController */
/* @var $model RackBook */
?>

<?php
$this->breadcrumbs=array(
	'Rak Buku'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Rak Buku', 'url'=>array('index')),
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Tambah Rak Buku
				</h3>
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>