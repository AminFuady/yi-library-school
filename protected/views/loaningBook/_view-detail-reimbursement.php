<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		DetailViewHelper::date($model, 'reimbursement_date'),
		array(
			'name' => 'denda',
			'value' => $model->getDenda(),
			'type' => 'raw',
		),
		array(
			'name' => 'total_denda',
			'value' => $model->getTotalDenda(),
			'type' => 'raw',
		),
		'description',
		DetailViewHelper::shortDate($model, 'created_at'),
		DetailViewHelper::author($model, 'created_by'),
		DetailViewHelper::shortDate($model, 'updated_at'),
		DetailViewHelper::author($model, 'updated_by'),
	),
)); ?>