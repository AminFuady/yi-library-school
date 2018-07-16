<?php
/* @var $this CategoryBookController */
/* @var $model CategoryBook */
?>

<?php
$this->breadcrumbs=array(
	'Jurusan'=>array('index'),
	'Tambah',
);

$this->menu=array(
	array('label'=>'List Jurusan', 'url'=>array('index')),
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Tambah Jurusan
				</h3>
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>