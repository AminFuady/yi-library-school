<?php
/* @var $this LoaningBookController */
/* @var $model LoaningBook */
?>

<?php
$this->breadcrumbs=array(
	'Peminjaman Buku'=>array('index'),
	$model->loaning_code,
);

$this->menu=array(
	array('label'=>'List Peminjaman Buku', 'url'=>array('index')),
	array('label'=>'Create Peminjaman Buku', 'url'=>array('create')),
	array('label'=>'Update Peminjaman Buku', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Peminjaman Buku', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>View Peminjaman Buku #<?php echo $model->loaning_code; ?>
				</h3>
			</div>
			<div class="box-content">
                <?php
					echo CHtml::link('Update', array($this->id.'/update/'.$model->id), array('class'=>'btn btn-primary'));
					echo "&nbsp;&nbsp;";
					echo CHtml::link('Back', array($this->id.'/index'), array('class'=>'btn btn-danger'));
                    echo "&nbsp;&nbsp;";
                    echo $model->buttonReimbursementBook();
				?>
                <br/>
                <br/>
                <?php $this->widget('zii.widgets.CDetailView',array(
                    'htmlOptions' => array(
                        'class' => 'table table-striped table-condensed table-hover',
                    ),
                    'data'=>$model,
                    'attributes'=>array(
                        'id',
                        'loaning_code',
                        array(
                            'name' => 'initial_member',
                            'value' => $model->initialMemberLabel(),
                        ),
                        'member_code',
                        DetailViewHelper::date($model, 'loaning_date'),
                        DetailViewHelper::date($model, 'reimbursement_date'),
                        array(
							'name' => 'status',
							'value' => $model->getStatusWithStyle($model->status),
							'type'=>'raw',
						),
						DetailViewHelper::shortDate($model, 'created_at'),
						DetailViewHelper::author($model, 'created_by'),
						DetailViewHelper::shortDate($model, 'updated_at'),
						DetailViewHelper::author($model, 'updated_by'),
					),
				)); ?>
				<br/>
                <div class="box">
                    <div class="box-title">
                        <h3>
                            <i class="fa fa-list-ul"></i> Detail Buku yang di Pinjam
                        </h3>
                    </div>
                    <div class="box-content">
                        <?php $this->renderPartial('detail/_view-detail', array('model'=>$details)); ?>
                    </div>
                </div>
				<?php if(isset($model->reimbursementBook)):	?>
					<div class="box">
						<div class="box-title">
							<h3>
								<i class="fa fa-list-ul"></i> Detail Pengembalian Buku
							</h3>
						</div>
						<div class="box-content">
							<?php $this->renderPartial('_view-detail-reimbursement', array('model'=>$model->reimbursementBook)); ?>
						</div>
					</div>
				<?php endif; ?>
				
			</div>
		</div>
	</div>
</div>