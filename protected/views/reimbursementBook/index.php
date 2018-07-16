<?php
/* @var $this ReimbursementBookController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Reimbursement Books',
);

$this->menu=array(
	array('label'=>'Create ReimbursementBook','url'=>array('create')),
	array('label'=>'Manage ReimbursementBook','url'=>array('admin')),
);
?>

<h1>Reimbursement Books</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>