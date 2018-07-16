<?php
/* @var $this LoaningBookController */
/* @var $model LoaningBook */


$this->breadcrumbs=array(
	'Peminjaman Buku'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Peminjaman Buku', 'url'=>array('index')),
	array('label'=>'Create Peminjaman Buku', 'url'=>array('create')),
	array('label'=>'List Peminjaman Melewat Batas (Denda)', 'url'=>array('denda')),
);

?>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>Manage Peminjaman Buku
				</h3>
			</div>
			<div class="box-content">
                <?php echo CHtml::link('Form Peminjaman Buku', array($this->id.'/create'), array('class'=>'btn btn-success')); ?>
                <?php echo CHtml::link('List Peminjaman Melewat Batas (Denda)', array($this->id.'/denda'), array('class'=>'btn btn-primary')); ?>
                <?php $this->widget('zii.widgets.grid.CGridView',array(
                    'id'=>'loaning-book-grid',
                    'itemsCssClass' => 'table table-bordered table-responsive table-nomargin',
                    'dataProvider'=>$model->search(),
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