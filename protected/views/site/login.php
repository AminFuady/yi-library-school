
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange' => true,
	),
)); 
$labelOptions = array('class'=>'control-label visible-ie8 visible-ie9');
$inputOptions = array('class'=>'form-control form-control-solid placeholder-no-fix');
?>

		<div class="form-title">
			<span class="form-title">Login Administrator</span>
		</div>
		
		<div class="form-group">
			<?php echo $form->labelEx($model,'username', $labelOptions); ?>
			<?php echo $form->textField($model,'username', $inputOptions); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		<div class="form-group">
			<?php echo $form->labelEx($model,'password', $labelOptions); ?>
			<?php echo $form->passwordField($model,'password', $inputOptions); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>

		<div class="form-group rememberMe">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
		</div>
		<div class="form-actions">
			<?php echo CHtml::submitButton('Login', array('class'=>'btn btn-primary btn-block uppercase')); ?>
		</div>

<?php $this->endWidget(); ?>
