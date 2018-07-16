<?php
/* @var $this LoaningBookController */
/* @var $model LoaningBook */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('MyActiveForm', array(
	'id'=>'loaning-book-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
	)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
			<?php echo $form->hiddenField($model, 'duration'); ?>
            <?php echo $form->textFieldCustomGroup($model,'loaning_code', array('value'=>$model->isNewRecord ? LoaningBook::model()->generateCode() : $model->loaning_code, 'readonly'=>true)); ?>
			
			<?php echo $form->dropDownListCustomGroup($model,'initial_member', LoaningBook::initialMemberLabels(), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>
	
            <?php echo $form->dropDownListCustomGroup($model,'member_code', array(), array('class'=>'form-control select2-me', 'prompt'=>'--Choose One--')); ?>

            <div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'loaning_date', array('class'=>'control-label')); ?>
					<?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
							'model' => $model,
							'attribute' => 'loaning_date',
							'htmlOptions' => array('class'=>'form-control'),
							'pluginOptions' => array(
								'format' => 'yyyy-mm-dd',
								'autoclose' => true,
								'startDate' => '-1m',
							)
						));
					?>
				</div>
				<div class="col-xs-12 col-md-6">
					<?php echo $form->error($model,'loaning_date', array('class'=>'error-text help-block')); ?>
				</div>
			</div>
	
			<div class="row control-group form-group">
				<div class="col-xs-12 col-md-6">
					<?php echo $form->labelEx($model, 'reimbursement_date', array('class'=>'control-label')); ?>
					<div class="input-group">
						<?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
								'model' => $model,
								'attribute' => 'reimbursement_date',
								'htmlOptions' => array('class'=>'form-control'),
								'pluginOptions' => array(
									'format' => 'yyyy-mm-dd',
									'autoclose' => true,
									'startDate' => '-1m',
								)
							));
						?>
						<div id="duration-label" class="input-group-addon"></div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<?php echo $form->error($model,'reimbursement_date', array('class'=>'error-text help-block')); ?>
					<p id="error-until" class="error-text help-block"></p>
				</div>
			</div>

            <div class="box">
				<div class="box-title">
					<h3>
						<i class="fa fa-list-ul"></i> Detail Buku yang di Pinjam
					</h3>
					<div class="actions">
						<a href="#" id="add-detail" class="btn"><i class="fa fa-plus-square"></i>&nbsp; Tambah Detail</a>
					</div>
				</div>
				<div class="box-content">
					<div id="loan-detail">
						<?php
							$index = 0;
							foreach($model->loaningBookDetails as $id => $detail):
								$this->renderPartial('detail/_form-detail', array(
									'model'	=> $detail,
									'index'	=> $id,
								));
								$index++;
							endforeach;
						?>
					</div>
				</div>
			</div>            

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
	
	$(document).ready(function(){
		
		var _index		= '<?php echo $index; ?>';
		var wrapper		= $("#loan-detail");
		var initialMember = $("#LoaningBook_initial_member").trigger("change");
		var memberCode = $("#LoaningBook_member_code").trigger('change');
		var start = document.getElementById("LoaningBook_loaning_date");
		var end = document.getElementById("LoaningBook_reimbursement_date");
		var errorUntil = document.getElementById("error-until");
		var duration = document.getElementById('LoaningBook_duration');
		var durationLabel = document.getElementById('duration-label');
		
		$("#add-detail").click(function(e){
			e.preventDefault();
			$.ajax({
				url: "<?php echo Yii::app()->createUrl('loaningBook/ajaxFormLoanDetail') ?>"+"?index="+_index,
				success: function(data){
					$(wrapper).append(data);
				}
			});
			_index++;
			return;
		});
		//Menampilkan detail clothes ketika load pertama
		if (_index == 0) {
			$('#add-detail').click();
		}
		
		$(initialMember).change(function(){
			$.ajax({
				url : '<?php echo Yii::app()->createUrl('loaningBook/ajaxListMember') ?>?id='+initialMember.val(),
				dataType : 'json',
				delay:250,
				success : function(data) {
					$(memberCode).val(null).trigger('change');
					$(memberCode).html('').trigger('change');
					$(memberCode).select2({data: data['select']});
					duration.value = data['duration'];
					durationLabel.innerHTML = '';
					return false;
				}
			});
		});
		
		$(initialMember).change();
		
		$(start).change(function(){
			durationLabel.innerHTML = 'Durasi '+ duration.value +' Hari';
			getReimbursementDate(start.value, duration.value);
		});
		
		function getReimbursementDate($value, $duration) {
			$.get('<?php echo Yii::app()->createUrl('loaningBook/ajaxGetReimbursementDate') ?>?date='+$value+'&duration='+$duration, function(data){
				end.value = data;
			});
		}
	});
</script>