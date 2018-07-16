<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->pageTitle = "View User `$model->name`";
?>


<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Manage Users
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
                        'name',
                        'email',
                        array(
                            'name'=>'password',
                            'value'=>'******',
                        ),
                        array(
                            'name'=>'status',
                            'value'=>$model->getStatusWithStyle(),
                            'type'=>'raw',
                        ),
                        DetailViewHelper::shortDate($model, 'last_visit'),
                        DetailViewHelper::shortDate($model, 'created_at'),
                        DetailViewHelper::author($model, 'created_by'),
                        DetailViewHelper::shortDate($model, 'updated_at'),
                        DetailViewHelper::author($model, 'updated_by'),
                    ),
                )); ?>
                <br/>
                <?php
                    echo CHtml::link('Back', array('user/index'), array('class'=>'btn btn-danger'));
                    echo "&nbsp;";
                    echo CHtml::link('Update',array('update','id'=>$model->id),array('class'=>'btn btn-primary'));
                ?>
            </div>
        </div>
    </div>
</div>