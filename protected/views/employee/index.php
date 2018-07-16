<?php
/* @var $this StudentController */
/* @var $model Student */


$this->breadcrumbs=array(
	'Karyawan'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Karyawan', 'url'=>array('index')),
	array('label'=>'Create Karyawan', 'url'=>array('create')),
);

?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Manage Karyawan
				</h3>
			</div>
			<div class="box-content">
				<?php echo CHtml::link('Tambah Karyawan', array($this->id.'/create'), array('class'=>'btn btn-primary')); ?>
				<?php $this->widget('zii.widgets.grid.CGridView',array(
					'id'=>'employee-grid',
					'itemsCssClass' => 'table table-bordered table-responsive table-nomargin',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
						array(
							'header'=>'No',
							'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
						),
						'member_code',
						'name',
						array(
							'name' => 'dob',
							'value' => 'Lib::indoDate($data->dob)',
							'type'=>'raw',
						),
						array(
							'name' => 'date_in',
							'value' => 'Lib::indoDate($data->date_in)',
							'type'=>'raw',
						),
						array(
							'name' => 'employee_status',
							'value' => '$data->getEmployeeStatusWithStyle()',
							'type'=>'raw',
							'filter'=>Employee::employeeStatusLabels(),
						),
						array(
							'name' => 'status',
							'value' => '$data->getStatusWithStyle()',
							'type'=>'raw',
							'filter'=>Employee::statusLabels(),
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