<?php
/* @var $this RackBookController */
/* @var $model RackBook */
?>

<?php
$this->breadcrumbs=array(
	'Info Sekolah'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Info Sekolah', 'url'=>array('index')),
	array('label'=>'Update Info Sekolah', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>View Info Sekolah #<?php echo $model->id ?>
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
						'npsn',
						'name',
						'description',
						'no_telp',
						'email',
						'kepsek',
						'address',
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
