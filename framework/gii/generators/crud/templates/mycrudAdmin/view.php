<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="row-fluid">
<!-- block -->
	<div class="block">
<?php
$mdl=new $this->modelClass;
$relations = $mdl->relations();
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

?>

	<div class="navbar navbar-inner block-header">
		<div class="muted pull-left"><h4>View <?php echo $this->modelClass." #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h4></div>
	</div>

<?php
$mdl=new $this->modelClass;
$relations = $mdl->relations();
?>
<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array(
		'class'=>'table table-striped table-bordered table-view',
	),	
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
{
	if(array_key_exists($column->name, $this->tableSchema->foreignKeys))
	{
		$foreignKey = $this->tableSchema->foreignKeys[$column->name] ;
		$foreignTable = $foreignKey[0];
		$foreignModel = ucwords($foreignTable);
		$foreignField = $foreignKey[1];
		if($foreignTable=='user')
			$foreignValue ='username';
		else
			$foreignValue ='name';
			
		foreach($relations as $relname => $rel)
		{
			if($rel[0]=='CBelongsToRelation' && $rel[2]==$column->name)
			{
				echo "\t\tarray('value'=>\$model->{$relname}?\$model->{$relname}->{$foreignValue}:'','name'=>'{$relname}'),\n";						
			}
		}
	}	
	else if($column->dbType==='boolean'||$column->dbType==='tinyint(1)')
	{
		echo "\t\t";
		echo "array('name'=>'{$column->name}', 'value'=>\$model->{$column->name}?\"True\":\"False\")";
		echo ",\n";			
	}
	else
		echo "\t\t'".$column->name."',\n";
}
?>
	),
)); ?>

	<div class="form-actions">
	<a href="<?php echo "<?php echo \$this->createUrl('update',array('id'=>\$model->{$this->tableSchema->primaryKey} ))?>"; ?>" class="btn btn-primary">Update</a>
	<a href="<?php echo "<?php echo \$this->createUrl('delete',array('id'=>\$model->{$this->tableSchema->primaryKey} ))?>"; ?>" onclick="return confirm('Are you sure you want to Delete this?')" class="btn btn-primary">Delete</a>
	<a href="<?php echo "<?php echo \$this->createUrl('index')?>"; ?>" class="btn btn-primary">Back</a>
	</div>
	</div>
</div>