<?php
$this->breadcrumbs=array(
	'Pendapatan Denda'=>array('index'),
	'Reports',
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Report Pendapatan Denda
				</h3>
<!--				<div class="actions">
					<a href="#" class="btn" id="export-xls"><i class="fa fa-file-excel-o"></i>&nbsp; Export (.xls)</a>
					<a href="#" class="btn" id="generate-pdf"><i class="fa fa-file-pdf-o"></i>&nbsp; Generate PDF</a>
				</div>-->
			</div>
			<div class="box-content">
				<?php $this->renderPartial('_search-report', array('model'=>$model, 'filterLabel'=>'Tanggal Pengembalian')); ?>
				<?php $this->widget('zii.widgets.grid.CGridView',array(
					'id'=>'loaning-book-grid',
					'itemsCssClass' => 'table table-bordered table-responsive table-nomargin',
					'pagerCssClass'=>'pagination',
					'dataProvider'=>$model->reportDenda(),
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
							'name'=>'denda',
							'value'=>'$data->reimbursementBook->getDenda()',
						),
                        array(
							'name'=>'totalDenda',
							'value'=>'$data->reimbursementBook->getTotalDenda()',
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
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: right;"><h4>Total Keseluruhan</h4></th>
							<th style="text-align: right;width:15%;"><h4>Rp. <?php echo Lib::rupiah($model->getTotalReportDenda()); ?></h4></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>	