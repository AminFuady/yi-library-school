<?php
/* @var $this EmployeeController */
/* @var $model Employee */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('MyActiveForm', array(
	'id'=>'employee-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
	)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldCustomGroup($model,'member_code', array('value'=>$model->isNewRecord ? Employee::model()->generateCode() : $model->member_code, 'readonly'=>true)); ?>

            <?php echo $form->textFieldCustomGroup($model,'nik'); ?>

            <?php echo $form->textFieldCustomGroup($model,'code'); ?>

            <?php echo $form->textFieldCustomGroup($model,'name'); ?>

            <?php echo $form->textAreaCustomGroup($model,'address'); ?>

            <?php echo $form->textFieldCustomGroup($model,'dob_place'); ?>

            <div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'dob', array('class'=>'control-label')); ?>
					<?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
							'model' => $model,
							'attribute' => 'dob',
							'htmlOptions' => array('class'=>'form-control'),
							'pluginOptions' => array(
								'format' => 'yyyy-mm-dd',
							)
						));
					?>
				</div>
				<div class="col-xs-12 col-md-6">
					<?php echo $form->error($model,'dob', array('class'=>'error-text help-block')); ?>
				</div>
			</div>

            <?php echo $form->dropDownListCustomGroup($model,'gender', Employee::genderLabels(), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <?php echo $form->dropDownListCustomGroup($model,'religion_id', CHtml::listData(Religion::model()->actived()->findAll(), 'id', 'name'), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <?php echo $form->textFieldCustomGroup($model,'no_telp'); ?>

            <?php echo $form->dropDownListCustomGroup($model,'position_id', CHtml::listData(Position::model()->actived()->findAll(), 'id', 'name'), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'date_in', array('class'=>'control-label')); ?>
					<?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
							'model' => $model,
							'attribute' => 'date_in',
							'htmlOptions' => array('class'=>'form-control'),
							'pluginOptions' => array(
								'format' => 'yyyy-mm-dd',
							)
						));
					?>
				</div>
				<div class="col-xs-12 col-md-6">
					<?php echo $form->error($model,'date_in', array('class'=>'error-text help-block')); ?>
				</div>
			</div>

            <?php echo $form->dropDownListCustomGroup($model,'marital_status', Employee::maritalStatusLabels(), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'photo', array('class'=>'control-label')); ?>
					<?php echo $form->fileField($model,'photo', array('class'=>'form-control')); ?>
				</div>
				<div class="col-xs-12 col-md-6">
					<?php echo $form->error($model,'photo', array('class'=>'error-text help-block')); ?>
				</div>
			</div>
	
			<div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php
						if(!$model->isNewRecord):
							echo $model->getPhoto();
						endif;
					?>
				</div>
				<div class="col-xs-12 col-md-6"></div>
			</div>

            <?php echo $form->dropDownListCustomGroup($model,'previous_education_id', CHtml::listData(PreviousEducation::model()->actived()->findAll(), 'id', 'name'), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <?php echo $form->textFieldCustomGroup($model,'instance_previous_education'); ?>
	
			<div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'graduation_year', array('class'=>'control-label')); ?>
					<?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
							'model' => $model,
							'attribute' => 'graduation_year',
							'htmlOptions' => array('class'=>'form-control'),
							'pluginOptions' => array(
								'format' => 'yyyy',
								'viewMode' => "years", 
								'minViewMode' => "years",
							)
						));
					?>
				</div>
				<div class="col-xs-12 col-md-6">
					<?php echo $form->error($model,'graduation_year', array('class'=>'error-text help-block')); ?>
				</div>
			</div>

			<?php echo $form->dropDownListCustomGroup($model,'employee_status', Employee::employeeStatusLabels(), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>
	
            <?php echo $form->dropDownListCustomGroup($model,'status', Employee::statusLabels(), array('class'=>'form-control select2-me')); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->