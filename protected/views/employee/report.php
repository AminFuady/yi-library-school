<?php
/* @var $this CategoryBookController */
/* @var $model CategoryBook */


$this->breadcrumbs=array(
	'Guru'=>array('index'),
	'Reports',
);

$this->menu=array(
	array('label'=>'List Guru', 'url'=>array('index')),
	array('label'=>'Create Guru', 'url'=>array('create')),
);

?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Report Guru
				</h3>
<!--				<div class="actions">
					<a href="#" class="btn" id="export-xls"><i class="fa fa-file-excel-o"></i>&nbsp; Export (.xls)</a>
					<a href="#" class="btn" id="generate-pdf"><i class="fa fa-file-pdf-o"></i>&nbsp; Generate PDF</a>
				</div>-->
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_search-report', array('model'=>$model)); ?>
				<?php $this->widget('zii.widgets.grid.CGridView',array(
					'id'=>'book-grid',
					'itemsCssClass' => 'table table-bordered table-responsive table-nomargin',
					'pagerCssClass'=>'pagination',
					'dataProvider'=>$model->filterBetweenDate(),
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