<?php
/* @var $this SchoolInfoController */
/* @var $model SchoolInfo */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('MyActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldCustomGroup($model,'id',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'npsn'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'name'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'description'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'no_telp'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'email'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'kepsek'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'address'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'logo'); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->