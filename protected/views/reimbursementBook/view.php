<?php
/* @var $this ReimbursementBookController */
/* @var $model ReimbursementBook */
?>

<?php
$this->breadcrumbs=array(
	'Reimbursement Books'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ReimbursementBook', 'url'=>array('index')),
	array('label'=>'Create ReimbursementBook', 'url'=>array('create')),
	array('label'=>'Update ReimbursementBook', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReimbursementBook', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View ReimbursementBook #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'loaning_book_id',
		'reimbursement_date',
		'denda',
		'total_denda',
		'description',
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
	),
)); ?>