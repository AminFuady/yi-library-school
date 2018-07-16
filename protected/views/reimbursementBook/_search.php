<?php
/* @var $this ReimbursementBookController */
/* @var $model ReimbursementBook */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('MyActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldCustomGroup($model,'id',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'loaning_book_id',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'reimbursement_date',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'denda'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'total_denda'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'description'); ?>

                    <?php echo $form->textFieldCustomGroup($model,'user_id',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'created_at',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'created_by',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'updated_at',array('class'=>'form-control')); ?>

                    <?php echo $form->textFieldCustomGroup($model,'updated_by',array('class'=>'form-control')); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->