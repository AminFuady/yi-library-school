<?php
/* @var $this TeacherController */
/* @var $model Teacher */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('MyActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldCustomGroup($model,'id',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'member_code'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'nik'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'code'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'name'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'dob_place'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'dob',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'gender'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'religion_id',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'address'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'no_telp'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'date_in',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'marital_status',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'teacher_status',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'photo'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'previous_education_id',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'instance_previous_education'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'status',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'graduation_year',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'created_at',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'updated_by',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'updated_at',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'created_by',array('class'=>'form-control')); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->