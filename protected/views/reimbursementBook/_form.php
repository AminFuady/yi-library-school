<?php
/* @var $this ReimbursementBookController */
/* @var $model ReimbursementBook */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('MyActiveForm', array(
	'id'=>'reimbursement-book-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
	)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <?php
        $htmlOptions = array('errorOptions'=>array('class'=>'error-text'));
		$htmlOptions+= array('divInput'=>'col-xs-12 col-md-12');
		$htmlOptions+= array('divError'=>'col-xs-12 col-md-12');
    ?>

            <div class="row control-group form-group">
                <div class="col-xs-12 col-md-12">
                    <?php echo $form->labelEx($model, 'member_code', array('class'=>'control-label')) ?>
                    <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'model'=>$model,
                            'attribute'=>'member_code',
                            'source'=>$this->createUrl('loaningBook/autocomplete'),
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                    'showAnim'=>'fold',
									'select' => 'js:function(event, ui) {
										var loaningCode = document.getElementById("loaning_code"),
										loaningDate = document.getElementById("loaning_date"),
										loaningBookId = document.getElementById("ReimbursementBook_loaning_book_id"),
										reimbursementDate = document.getElementById("reimbursement_date"),
										status = document.getElementById("status"),
										qtyBook = document.getElementById("qtyBook"),
										bookDetails = document.getElementById("bookDetails"),
										formDenda = document.getElementById("ReimbursementBook_denda"),
										formTotalDenda = document.getElementById("ReimbursementBook_total_denda");
										
										$.get("'.Yii::app()->createUrl("loaningBook/ajaxGetLoaningBookWithDendaByMember") .'?memberCode="+ui.item.value, function(data){
											if(data) {
												  var data = JSON.parse(data);
												  loaningCode.value = data.loaning_code;
												  loaningBookId.value = data.loaning_book_id;
												  loaningDate.value = data.loaning_date;
												  reimbursementDate.value = data.reimbursement_date;
												  status.value = data.status;
												  qtyBook.value = data.qtyBook;
												  bookDetails.innerHTML = data.bookDetails;
												  formDenda.value = data.denda;
												  formTotalDenda.value = data.totalDenda;
											}else{
												  loaningCode.value = "";
												  loaningDate.value = "";
												  loaningBookId.value = "";
												  reimbursementDate.value = "";
												  status.value = "";
												  qtyBook.value = "";
												  bookDetails.innerHTML = "";
												  formDenda.value = "";
												  formTotalDenda.value = "";
											}
										 });
									}',
									'change'=>'js:function(event, ui) {
										var loaningCode = document.getElementById("loaning_code"),
										loaningBookId = document.getElementById("ReimbursementBook_loaning_book_id"),
										loaningDate = document.getElementById("loaning_date"),
										reimbursementDate = document.getElementById("reimbursement_date"),
										status = document.getElementById("status"),
										qtyBook = document.getElementById("qtyBook"),
										bookDetails = document.getElementById("bookDetails");
										if (!ui.item || $(this).val()=="") {
											if ($(this).val()!="") {
												$("#ReimbursementBook_member_code").html("<div class=' . "'" . 'error' . "'" . '>Unknown Product</div>");
												$("#ReimbursementBook_member_code").slideDown(250);
											};
											$(this).val("");
											
											loaningBookId.value = "";
											loaningCode.value = "";
											loaningDate.value = "";
											reimbursementDate.value = "";
											status.value = "";
											qtyBook.value = "";
											bookDetails.innerHTML = "";
										}
										return false;
									}',
                            ),
                            'htmlOptions'=>array(
                                'class'=>'form-control',
                                'placeholder'=>CHtml::encode($model->getAttributeLabel('member_code')),
                            ),
                        ));
                    ?>
                </div>
                <div class="col-xs-12 col-md-12">
                    <?php echo $form->error($model, 'member_code', array('class'=>'error-text help-block')) ?>
                </div>
            </div>
            
    
            <?php echo $form->hiddenField($model,'loaning_book_id'); ?>

            <?php echo $form->textFieldCustomGroup($model,'reimbursement_date',$htmlOptions + array('value'=>($model->isNewRecord) ? date('Y-m-d') : $model->reimbursement_date, 'readonly'=>true)); ?>

            <div class="row control-group form-group">
				<div class="col-xs-12 col-md-12">
					<?php echo $form->labelEx($model, 'denda', array('class'=>'control-label')); ?>
					<div class="input-group">
						<div class="input-group-addon">Rp.</div>
						<?php echo $form->textField($model,'denda',array('class'=>'form-control', 'readonly'=>true)); ?>
						<div class="input-group-addon">/hari</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-12">
					<?php echo $form->error($model,'denda', array('class'=>'error-text help-block')); ?>
				</div>
			</div>
    
            <div class="row control-group form-group">
				<div class="col-xs-12 col-md-12">
					<?php echo $form->labelEx($model, 'total_denda', array('class'=>'control-label')); ?>
					<div class="input-group">
						<div class="input-group-addon">Rp.</div>
						<?php echo $form->textField($model,'total_denda',array('class'=>'form-control', 'readonly'=>true)); ?>
						<div class="input-group-addon">.00</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-12">
					<?php echo $form->error($model,'total_denda', array('class'=>'error-text help-block')); ?>
				</div>
			</div>

            <?php echo $form->textAreaCustomGroup($model,'description', $htmlOptions); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
	$(document).ready(function(){
		var loaningCode = document.getElementById("loaning_code"),
			loaningBookId = document.getElementById("ReimbursementBook_loaning_book_id"),
			loaningDate = document.getElementById("loaning_date"),
			reimbursementDate = document.getElementById("reimbursement_date"),
			status = document.getElementById("status"),
			qtyBook = document.getElementById("qtyBook"),
			bookDetails = document.getElementById("bookDetails"),
			memberCode = document.getElementById("ReimbursementBook_member_code"),
			formDenda = document.getElementById("ReimbursementBook_denda"),
			formTotalDenda = document.getElementById("ReimbursementBook_total_denda");
			
		$(memberCode).change(function(){
			$.get('<?php echo Yii::app()->createUrl("loaningBook/ajaxGetLoaningBookWithDendaByMember")?>?memberCode='+memberCode.value, function(data){
				if(data){
					var data = JSON.parse(data);
					loaningCode.value = data.loaning_code;
					loaningBookId.value = data.loaning_book_id;
					loaningDate.value = data.loaning_date;
					reimbursementDate.value = data.reimbursement_date;
					status.value = data.status;
					qtyBook.value = data.qtyBook;
					bookDetails.innerHTML = data.bookDetails;
					formDenda.value = data.denda;
					formTotalDenda.value = data.totalDenda;
				}else{
					loaningCode.value = "";
					loaningBookId.value = "";
					loaningDate.value = "";
					reimbursementDate.value = "";
					status.value = "";
					qtyBook.value = "";
					bookDetails.innerHTML = "";
					formDenda.value = "";
					formTotalDenda.value = "";
				}
			});
		});
		$(memberCode).change();
		
	});
</script>