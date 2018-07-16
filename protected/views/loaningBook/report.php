<?php

$this->breadcrumbs=array(
	'Peminjaman Buku'=>array('index'),
	'Reports',
);

$this->menu=array(
	array('label'=>'List Peminjaman Buku', 'url'=>array('index')),
	array('label'=>'Create Peminjaman Buku', 'url'=>array('create')),
);

?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Report Peminjaman Buku
				</h3>
<!--				<div class="actions">
					<a href="#" class="btn" id="export-xls"><i class="fa fa-file-excel-o"></i>&nbsp; Export (.xls)</a>
					<a href="#" class="btn" id="generate-pdf"><i class="fa fa-file-pdf-o"></i>&nbsp; Generate PDF</a>
				</div>-->
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_search-report', array('model'=>$model, 'filterLabel'=>'Tanggal Peminjaman')); ?>
				<?php $this->widget('zii.widgets.grid.CGridView',array(
					'id'=>'loaning-book-grid',
					'itemsCssClass' => 'table table-bordered table-responsive table-nomargin',
					'pagerCssClass'=>'pagination',
					'dataProvider'=>$model->report(),
					'filter'=>$model,
					'columns'=>array(
                        array(
							'header'=>'No',
							'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
						),
                        'loaning_code',
                        array(
							'name'=>'initial_member',
							'value'=>'$data->initialMemberLabel()',
                            'filter'=>LoaningBook::initialMemberLabels(),
						),
                        'member_code',
                        array(
							'name'=>'loaning_date',
							'value'=>'Lib::date($data->loaning_date)',
							'filter'=>false,
						),
                        array(
							'name'=>'reimbursement_date',
							'value'=>'Lib::date($data->reimbursement_date)',
						),
                        array(
							'name'=>'status',
							'value'=>'$data->getStatusWithStyle()',
                            'filter'=>LoaningBook::statusLabels(),
                            'type'=>'raw',
						),
                        array(
							'class'=>'CButtonColumn',
							'htmlOptions'=>array('style'=>'width:115px; text-align:center;'),
							'template'=>'{view}',
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