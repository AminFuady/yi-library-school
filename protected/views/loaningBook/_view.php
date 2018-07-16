<?php
/* @var $this LoaningBookController */
/* @var $data LoaningBook */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('loaning_code')); ?>:</b>
	<?php echo CHtml::encode($data->loaning_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_code')); ?>:</b>
	<?php echo CHtml::encode($data->member_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('loaning_date')); ?>:</b>
	<?php echo CHtml::encode($data->loaning_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reimbursement_date')); ?>:</b>
	<?php echo CHtml::encode($data->reimbursement_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	*/ ?>

</div>