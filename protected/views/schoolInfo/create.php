<?php
/* @var $this SchoolInfoController */
/* @var $model SchoolInfo */
?>

<?php
$this->breadcrumbs=array(
	'School Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SchoolInfo', 'url'=>array('index')),
	array('label'=>'Manage SchoolInfo', 'url'=>array('admin')),
);
?>

<h1>Create SchoolInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>