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
	'Create',
);\n";
?>

?>
<div class="row-fluid">
<!-- block -->
	<div class="block">
	<div class="navbar navbar-inner block-header">
		<div class="muted pull-left"><h4>Create <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h4></div>
	</div>
	<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
	</div>
</div>