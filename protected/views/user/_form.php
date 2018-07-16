<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form TbActiveForm */
?>
    <?php $form=$this->beginWidget('MyActiveForm', array(
	'id'=>'user-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
	)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>
	<?php $htmlOptions	= array('divInput'=>'col-xs-12 col-md-8', 
		'divError'=>'col-xs-12 col-md-8', 'errorOptions'=>array('class'=>'error'));
	?>
    <?php echo $form->errorSummary($model); ?>
	
	<div class="col-xs-12 col-md-6">
		<?php echo $form->textFieldCustomGroup($model,'name',$htmlOptions); ?>
		
		<?php echo $form->textFieldCustomGroup($model,'email',$htmlOptions); ?>
		
		<?php if (!$model->isNewRecord) : ?>
			<?php echo $form->passwordFieldCustomGroup($model,'current_password',$htmlOptions); ?>
			<?php echo $form->passwordFieldCustomGroup($model,'new_password',$htmlOptions); ?>
			<?php echo $form->passwordFieldCustomGroup($model,'confirm_password',$htmlOptions); ?>
		<?php else: ?>
			<?php echo $form->passwordFieldCustomGroup($model,'password',$htmlOptions); ?>
		<?php endif; ?>
		
        <?php
        $userType	= User::getTypeLabels();
		?>
		<?php echo $form->dropDownListCustomGroup($model,'type',$userType,$htmlOptions + array('class'=>'form-control select2-me')); ?>
        <?php
		if(!$model->isNewRecord){
			echo $form->dropDownListCustomGroup($model,'status', User::statusLabels(),$htmlOptions + array('class'=>'form-control select2-me'));
		}
		?>
						
<div class="box-footer">
	<?php echo TbHtml::link('Back',array($this->id.'/'),array('class'=>'btn btn-danger btn-large')); ?>
	<?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		'class'=>'btn btn-primary btn-large'
	)); ?>
	
    <?php $this->endWidget(); ?>

</div>