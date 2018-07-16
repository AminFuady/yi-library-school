<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('MyActiveForm', array(
	'id'=>'book-form',
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

            <?php echo $form->textFieldCustomGroup($model,'code', array('value'=>$model->isNewRecord ? Book::model()->generateCode() : $model->code, 'readonly'=>true)); ?>

            <?php echo $form->textFieldCustomGroup($model,'title'); ?>

            <?php echo $form->textFieldCustomGroup($model,'author'); ?>

            <?php echo $form->textFieldCustomGroup($model,'publisher'); ?>
	
			<div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'publish_year', array('class'=>'control-label')); ?>
					<?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
							'model' => $model,
							'attribute' => 'publish_year',
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
					<?php echo $form->error($model,'publish_year', array('class'=>'error-text help-block')); ?>
				</div>
			</div>
	
			<?php echo $form->textFieldCustomGroup($model,'publish_place'); ?>

            <?php echo $form->textFieldCustomGroup($model,'page',array('class'=>'form-control')); ?>

            <div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'height', array('class'=>'control-label')); ?>
					<div class="input-group">
						<?php echo $form->textField($model,'height',array('class'=>'form-control')); ?>
						<div class="input-group-addon">Cm</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<?php echo $form->error($model,'height', array('class'=>'error-text help-block')); ?>
				</div>
			</div>

            <?php echo $form->textFieldCustomGroup($model,'ddc'); ?>

            <?php echo $form->textFieldCustomGroup($model,'isbn'); ?>

            <?php echo $form->textFieldCustomGroup($model,'qty'); ?>

            <div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'price', array('class'=>'control-label')); ?>
					<div class="input-group">
						<div class="input-group-addon">Rp.</div>
						<?php echo $form->textField($model,'price',array('class'=>'form-control')); ?>
						<div class="input-group-addon">.00</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<?php echo $form->error($model,'price', array('class'=>'error-text help-block')); ?>
				</div>
			</div>

            <?php echo $form->dropDownListCustomGroup($model,'category_book_id', CHtml::listData(CategoryBook::model()->actived()->findAll(), 'id', 'name'), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <?php echo $form->textFieldCustomGroup($model,'source_book'); ?>

            <?php echo $form->textFieldCustomGroup($model,'no_inventaris'); ?>

            <?php echo $form->textAreaCustomGroup($model,'description'); ?>

            <?php echo $form->dropDownListCustomGroup($model,'rack_book_id', CHtml::listData(RackBook::model()->actived()->findAll(), 'id', 'name'), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

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

            <?php echo $form->dropDownListCustomGroup($model,'status_book', Book::statusBookLabels(), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>
	
			<?php echo $form->dropDownListCustomGroup($model,'status', Book::statusLabels(), array('class'=>'form-control select2-me')); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->