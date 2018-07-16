<?php
/* @var $this StudentController */
/* @var $data Student */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_code')); ?>:</b>
	<?php echo CHtml::encode($data->member_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nisn')); ?>:</b>
	<?php echo CHtml::encode($data->nisn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nis')); ?>:</b>
	<?php echo CHtml::encode($data->nis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::encode($data->photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dob_place')); ?>:</b>
	<?php echo CHtml::encode($data->dob_place); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('religion_id')); ?>:</b>
	<?php echo CHtml::encode($data->religion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_telp')); ?>:</b>
	<?php echo CHtml::encode($data->no_telp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grade_id')); ?>:</b>
	<?php echo CHtml::encode($data->grade_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departement_id')); ?>:</b>
	<?php echo CHtml::encode($data->departement_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extracurricular')); ?>:</b>
	<?php echo CHtml::encode($data->extracurricular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester')); ?>:</b>
	<?php echo CHtml::encode($data->semester); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in')); ?>:</b>
	<?php echo CHtml::encode($data->date_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('previous_education_id')); ?>:</b>
	<?php echo CHtml::encode($data->previous_education_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mother_name')); ?>:</b>
	<?php echo CHtml::encode($data->mother_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_status')); ?>:</b>
	<?php echo CHtml::encode($data->family_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('child_of')); ?>:</b>
	<?php echo CHtml::encode($data->child_of); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_qty')); ?>:</b>
	<?php echo CHtml::encode($data->family_qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_address')); ?>:</b>
	<?php echo CHtml::encode($data->family_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('father_earning')); ?>:</b>
	<?php echo CHtml::encode($data->father_earning); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_telp')); ?>:</b>
	<?php echo CHtml::encode($data->family_telp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('father_work')); ?>:</b>
	<?php echo CHtml::encode($data->father_work); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mother_work')); ?>:</b>
	<?php echo CHtml::encode($data->mother_work); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('father_name')); ?>:</b>
	<?php echo CHtml::encode($data->father_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mother_earning')); ?>:</b>
	<?php echo CHtml::encode($data->mother_earning); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wali_address')); ?>:</b>
	<?php echo CHtml::encode($data->wali_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wali_telp')); ?>:</b>
	<?php echo CHtml::encode($data->wali_telp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wali_work')); ?>:</b>
	<?php echo CHtml::encode($data->wali_work); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('student_status')); ?>:</b>
	<?php echo CHtml::encode($data->student_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wali_name')); ?>:</b>
	<?php echo CHtml::encode($data->wali_name); ?>
	<br />

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