<?php
/* @var $this DurationController */
/* @var $model Duration */
?>

<?php
$this->breadcrumbs=array(
	'Durations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Duration', 'url'=>array('index')),
	array('label'=>'Manage Duration', 'url'=>array('admin')),
);
?>

<h1>Create Duration</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>