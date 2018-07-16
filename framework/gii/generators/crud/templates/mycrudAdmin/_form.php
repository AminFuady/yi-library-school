<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="block-content collapse in">
    <div class="span12">
	<?php
	$mdl=new $this->modelClass;
	$relations = $mdl->relations();
	?>
	 
<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
        'class'=>'form-horizontal',
    ),
)); ?>\n"; ?>
<fieldset>
<legend>Fields with <span class="required">*</span> are required.</legend>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
	else if(stripos($column->name,'date')!==false)
	{
		echo "<div class=\"control-group\">\n";
		echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; 
		echo "<div class=\"controls\">\n"; 
		echo "<?php \$this->widget('zii.widgets.jui.CJuiDatePicker', 
						array(
							'model'=>\$model,
							'attribute'=>'{$column->name}',
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>'yy-mm-dd',
								'changeMonth'=>true,
								'changeYear'=>true,
								'duration'=>'fast',
								'showAnim' =>'scale',
								'yearRange'=>'-50',
							),
							'htmlOptions'=>array('style'=>'height:16px;','id'=>'{$column->name}'),
					));
		?>\n";
		echo "<span class=\"help-inline text-error\">\n";
		echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; 
		echo "</span>\n";
		echo "</div>\n";
		echo "</div>\n";
		continue;
	}
	else if(array_key_exists($column->name, $this->tableSchema->foreignKeys) && $column->name != 'created_by_id')
	{
		//print_r($this->tableSchema->foreignKeys[$column->name]);
		$foreignKey = $this->tableSchema->foreignKeys[$column->name] ;
		$foreignTable = $foreignKey[0];
		//$foreignModel = str_replace(' ','',ucwords(str_replace('_',' ',$foreignTable) ));
		$foreignField = $foreignKey[1];
		if($foreignTable=='user')
			$foreignValue ='username';
		else
			$foreignValue ='name';
			
		foreach($relations as $relname => $rel)
		{
			if($rel[0]=='CBelongsToRelation' && $rel[2]==$column->name)
			{
				$value = "\$model->$relname->$foreignValue";
				$foreignModel = $rel[1];
				break;						
			}
		}
		
		
		echo "<div class=\"control-group\">\n";
		echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; 
		echo "<div class=\"controls\">\n"; 
		echo "<?php echo \$form->dropDownlist(\$model,'{$column->name}', \n
			(CHtml::listData($foreignModel::model()->findAll(),'{$foreignField}','{$foreignValue}')),
			array(
			'empty'=>'--Choose one--',
			'class'=>'chzn-select',
			//'ajax' => array(
			//	'type'=>'POST', 
			///	'url'=>CController::createUrl('dataPokok/ambilkotan'), 
			//	'data' => 'js:{nasabah:$(this).val()}',
			//	'update'=>'#DataPokok_id_city', 
			//	),
			)); ?>\n";
		echo "</div>\n";
		echo "</div>\n";
		continue;
	}
	else
	{
?>
		<div class="control-group">
			<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
		<div class="controls">
			<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
			<span class="help-inline text-error"><?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>"; ?></span>
		</div>
		</div>

<?php
	}
}
?>
	<div class="form-actions">
		<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>\n"; ?>
		<button type="reset" class="btn">Cancel</button>
	</div>
</fieldset>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
	</div>
</div>
