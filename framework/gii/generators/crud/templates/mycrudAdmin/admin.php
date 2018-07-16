<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
$mdl=new $this->modelClass;
$relations = $mdl->relations();
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Manage',
);\n";
?>

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="row-fluid">
<!-- block -->
	<div class="block">
	<div class="navbar navbar-inner block-header">
		<div class="muted pull-left"><h4>Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h4></div>
	</div>
<?php
$mdl=new $this->modelClass;
$relations = $mdl->relations();
//print_r($relations);
?>
<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'cssFile' => Yii::app()->theme->baseUrl . "/css/gridview.css",
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
		
	if($column->name=='id' or $column->name=='ID')
		echo "\t\t". "array('name'=>'".$column->name."', 'filter'=>false)\n,";
	else
	{
		if(array_key_exists($column->name, $this->tableSchema->foreignKeys))
		{
			$foreignKey = $this->tableSchema->foreignKeys[$column->name] ;
			$foreignTable = $foreignKey[0];
			$foreignModel = str_replace(' ','',ucwords(str_replace('_',' ',$foreignTable) ));
			$foreignField = $foreignKey[1];
			if($foreignTable=='user')
				$foreignValue ='username';
			else
				$foreignValue ='name';
				
			foreach($relations as $relname => $rel)
			{
				if($rel[0]=='CBelongsToRelation' && $rel[2]==$column->name)
				{
					echo "\t\tarray('name'=>'{$column->name}','value'=>'\$data->{$relname}?\$data->{$relname}->{$foreignValue}:\"\"','filter'=>CHtml::listData({$rel[1]}::model()->findAll(), '{$foreignField}', '{$foreignValue}')),\n";	
				}
			}

		}
		else if($column->dbType==='boolean'||$column->dbType==='tinyint(1)')
		{
			echo "\t\t";
			echo "array('name'=>'{$column->name}', 'value'=>'\$data->{$column->name}?\"True\":\"False\"', 'filter'=>array(0=>\"False\", 1=>\"True\"))";
			echo ",\n";			
		}
		else
			echo "\t\t'".$column->name."',\n";		
	}
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'CButtonColumn',
		),
		/*
		array
		(
		    'class'=>'CButtonColumn',
		    'template'=>'{email}{down}{delete}',
		    'buttons'=>array
		    (
		        'email' => array
		        (
		            'label'=>'Send an e-mail to this user',
		            'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
		            'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
		        ),
		        'down' => array
		        (
		            'label'=>'[-]',
		            'url'=>'"#"',
		            'visible'=>'$data->score > 0',
		            'click'=>'function(){alert("Going down!");}',
		        ),
		    ),
		),		
		*/
	),
)); ?>
	<div class="form-actions">	
		<a href="<?php echo "<?php echo \$this->createUrl('create')?>"; ?>" class="btn btn-danger">Create</a>	
	</div>
	</div>
</div>