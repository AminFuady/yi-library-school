<?php
/* @var $this StudentController */
/* @var $model Student */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('MyActiveForm', array(
	'id'=>'student-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
	)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldCustomGroup($model,'member_code', array('value'=>$model->isNewRecord ? Student::model()->generateCode() : $model->member_code, 'readonly'=>true)); ?>

            <?php echo $form->textFieldCustomGroup($model,'nisn'); ?>

            <?php echo $form->textFieldCustomGroup($model,'nis'); ?>

            <?php echo $form->textFieldCustomGroup($model,'name'); ?>

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

            <?php echo $form->dropDownListCustomGroup($model,'gender', Student::genderLabels(), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <?php echo $form->dropDownListCustomGroup($model,'religion_id', CHtml::listData(Religion::model()->actived()->findAll(), 'id', 'name'), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <?php echo $form->textAreaCustomGroup($model,'address'); ?>

            <?php echo $form->textFieldCustomGroup($model,'no_telp'); ?>

            <?php echo $form->dropDownListCustomGroup($model,'grade_id', CHtml::listData(Grade::model()->actived()->findAll(), 'id', 'name'), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <?php echo $form->dropDownListCustomGroup($model,'departement_id', CHtml::listData(Departement::model()->actived()->findAll(), 'id', 'name'), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <?php echo $form->textFieldCustomGroup($model,'extracurricular'); ?>

            <?php echo $form->dropDownListCustomGroup($model,'semester', Student::semesterLabels(), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

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

            <?php echo $form->dropDownListCustomGroup($model,'previous_education_id', CHtml::listData(PreviousEducation::model()->actived()->findAll(), 'id', 'name'), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <?php echo $form->textFieldCustomGroup($model,'father_name'); ?>
				
			<?php echo $form->textFieldCustomGroup($model,'mother_name'); ?>

            <?php echo $form->dropDownListCustomGroup($model,'family_status', Student::familyStatusLabels(), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <?php echo $form->textFieldCustomGroup($model,'child_of',array('class'=>'form-control')); ?>

            <?php echo $form->textFieldCustomGroup($model,'family_qty',array('class'=>'form-control')); ?>

            <?php echo $form->textFieldCustomGroup($model,'family_address'); ?>

            <?php echo $form->textFieldCustomGroup($model,'family_telp'); ?>

            <?php echo $form->textFieldCustomGroup($model,'father_work'); ?>

            <?php echo $form->textFieldCustomGroup($model,'mother_work'); ?>

            <div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'father_earning', array('class'=>'control-label')); ?>
					<div class="input-group">
						<div class="input-group-addon">Rp.</div>
						<?php echo $form->textField($model,'father_earning',array('class'=>'form-control')); ?>
						<div class="input-group-addon">.00</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<?php echo $form->error($model,'father_earning', array('class'=>'error-text help-block')); ?>
				</div>
			</div>
	
            <div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'mother_earning', array('class'=>'control-label')); ?>
					<div class="input-group">
						<div class="input-group-addon">Rp.</div>
						<?php echo $form->textField($model,'mother_earning',array('class'=>'form-control')); ?>
						<div class="input-group-addon">.00</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<?php echo $form->error($model,'mother_earning', array('class'=>'error-text help-block')); ?>
				</div>
			</div>
	
			<?php echo $form->textFieldCustomGroup($model,'wali_name'); ?>

            <?php echo $form->textFieldCustomGroup($model,'wali_address'); ?>

            <?php echo $form->textFieldCustomGroup($model,'wali_telp'); ?>

            <?php echo $form->textFieldCustomGroup($model,'wali_work'); ?>
	
			<?php if(!$model->isNewRecord):?>
				<div class="row control-group form-group">
					<div class="col-xs-12 col-md-6">
						<?php echo $form->labelEx($model, 'expire_date', array('class'=>'control-label')); ?>
						<?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
								'model' => $model,
								'attribute' => 'expire_date',
								'htmlOptions' => array('class'=>'form-control'),
								'pluginOptions' => array(
									'format' => 'yyyy-mm-dd',
								)
							));
						?>
					</div>
					<div class="col-xs-12 col-md-6">
						<?php echo $form->error($model,'expire_date', array('class'=>'error-text help-block')); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php echo $form->dropDownListCustomGroup($model,'student_status', Student::studentStatusLabels(), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>
	
			<?php echo $form->dropDownListCustomGroup($model,'status', Student::statusLabels(), array('class'=>'form-control select2-me')); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->