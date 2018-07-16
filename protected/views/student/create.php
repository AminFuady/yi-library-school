<?php
/* @var $this PositionController */
/* @var $model Position */
?>

<?php
$this->breadcrumbs=array(
	'Siswa'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Siswa', 'url'=>array('index')),
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Tambah Siswa
				</h3>
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>