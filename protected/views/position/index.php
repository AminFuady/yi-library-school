<?php
/* @var $this PositionController */
/* @var $model Position */


$this->breadcrumbs=array(
	'Posisi / Jabatan'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Posisi / Jabatan', 'url'=>array('index')),
	array('label'=>'Create Posisi / Jabatan', 'url'=>array('create')),
);

?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Manage Posisi / Jabatan
				</h3>
			</div>
			<div class="box-content">
				<?php echo CHtml::link('Tambah Posisi / Jabatan', array($this->id.'/create'), array('class'=>'btn btn-primary')); ?>
				<?php $this->widget('zii.widgets.grid.CGridView',array(
					'id'=>'position-grid',
					'itemsCssClass' => 'table table-bordered table-responsive table-nomargin',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
						'id',
						'name',
						'description',
						array(
							'name'=>'status',
							'value'=>'$data->getStatusWithStyle($data->status)',
							'type'=>'raw',
						),
						array(
							'name'=>'created_at',
							'value'=>'Lib::datetime($data->created_at)',
							'type'=>'raw',
						),
						array(
							'name'=>'created_by',
							'value'=>'$data->getCreatedBy()',
							'type'=>'raw',
						),
						array(
							'class'=>'CButtonColumn',
							'htmlOptions'=>array('style'=>'width:115px; text-align:center;'),
							'template'=>'{view}{update}{delete}',
							 'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
							'buttons'=>array(
								'view' => array(
									'label'=>'<i class="fa fa-search"></i>',
									'imageUrl'=>false,
									'options'=>array( 'class'=>'btn btn-default btn-sm', 'title'=>'View' ),
								),
								'update' => array(
									'label'=>'<i class="fa fa-pencil-square-o"></i>',
									'imageUrl'=>false,
									'options'=>array( 'class'=>'btn btn-blue btn-sm', 'title'=>'Update' ),
								),
								'delete' => array(
									'label'=>'<i class="fa fa-times"></i>',
									'imageUrl'=>false,
									'options'=>array( 'class'=>'btn btn-danger btn-sm delete', 'title'=>'Delete' ),
								),
							),
						),
					),
					'pager' => array(
						'maxButtonCount'=>8,
						'header' => false,
						'prevPageLabel' => 'Previous',
						'nextPageLabel' => 'Next',
						'firstPageLabel'=>'First',
						'lastPageLabel'=>'Last',
					),
				)); ?>
			</div>
		</div>
	</div>
</div>