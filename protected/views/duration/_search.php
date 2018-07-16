<?php
/* @var $this DurationController */
/* @var $model Duration */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('MyActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldCustomGroup($model,'id',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'name'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'value'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'description'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'status',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'created_at',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'created_by',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'updated_at',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'updated_by',array('class'=>'form-control')); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->