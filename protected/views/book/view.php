<?php
/* @var $this BookController */
/* @var $model Book */
?>

<?php
$this->breadcrumbs=array(
	'Buku'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Buku', 'url'=>array('index')),
	array('label'=>'Create Buku', 'url'=>array('create')),
	array('label'=>'Update Buku', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Buku', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Buku', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="fa fa-th-list"></i>View Buku #<?php echo $model->id; ?>
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
						'code',
						'title',
						'author',
						'publisher',
						'publish_year',
						'publish_place',
						'page',
						'height',
						array(
							'name'=>'height',
							'value'=>$model->getHeight(),
						),
						'ddc',
						'isbn',
						'qty',
						array(
							'name'=>'price',
							'value'=>$model->getPrice(),
						),
						array(
							'name'=>'category_book_id',
							'value'=>$model->categoryBook->name,
						),
						'source_book',
						'no_inventaris',
						'description',
						array(
							'name'=>'rack_book_id',
							'value'=>$model->rackBook->name,
						),
						array(
							'name'=>'photo',
							'value'=>$model->getPhoto(),
							'type'=>'raw',
						),
						array(
							'name' => 'status_book',
							'value' => $model->getStatusBookWithStyle($model->status_book),
							'type'=>'raw',
						),
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
				<?php
					echo CHtml::link('Update', array($this->id.'/update/'.$model->id), array('class'=>'btn btn-primary'));
					echo "&nbsp;&nbsp;";
					echo CHtml::link('Back', array($this->id.'/index'), array('class'=>'btn btn-danger'));
				?>
			</div>
		</div>
	</div>
</div>