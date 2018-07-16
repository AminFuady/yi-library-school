<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			<?php echo CHtml::activeLabelEx($model,'['.$index.']code', array('class'=>'control-label col-sm-1')); ?>
			<div class="col-sm-5">
				<?php echo CHTml::activeDropDownList($model, '['.$index.']code', (CHtml::listData(Book::model()->availableQty()->actived()->findAll(), 'code', 'codeWithTitle')), array('empty'=> '--Choose One--', 'class'=>'select2-me form-control')); ?>
				<?php echo CHtml::error($model,'['.$index.']code'); ?>
			</div>
			<div class="col-sm-1 no-padding">
				<?php echo CHTml::textField('modQty_'.$index, null, array('class'=>'form-control', 'readonly'=>true)); ?>
			</div>
			<div class="col-sm-2 no-padding">
				<?php echo CHTml::activeTextField($model, '['.$index.']qty', array('class'=>'form-control', 'placeholder'=>CHtml::encode($model->getAttributeLabel('qty')))); ?>
				<?php echo CHtml::error($model,'['.$index.']qty'); ?>
			</div>
			<div class="col-sm-2">
				<?php echo CHTml::activeTextArea($model, '['.$index.']description', array('class'=>'form-control', 'style'=>'height:34px;', 'placeholder'=>CHtml::encode($model->getAttributeLabel('description')))); ?>
				<?php echo CHtml::error($model,'['.$index.']description'); ?>
			</div>
			<div class="col-sm-1">
        		<?php echo CHtml::link('<i class="fa fa-times"></i>', '#', array('type'=>'raw','class'=>'btn btn-danger', 'title'=>'Delete Detail','onclick' => 'deleteItem(this, ' . $index . '); return false;')); ?>
			</div>
		</div>
	</div>
</div>
<script>
	$('.select2-me').select2();
</script>
<br/>
<?php
Yii::app()->clientScript->registerScript('deleteItem', "
function deleteItem(elm, index)
{
    element=$(elm).parent().parent();
    /* animate div */
    $(element).animate(
    {
        opacity: 0.25, 
        left: '+=50', 
        height: 'toggle'
    }, 500,
    function() {
        /* remove div */
        $(element).remove();
    });
}", CClientScript::POS_END);
?>
<script>
	$(document).ready(function(){
		var book = $('#LoaningBookDetail_<?php echo $index ?>_code').trigger('change'),
			modQty = document.getElementById('modQty_<?php echo $index ?>'),
			quantity = document.getElementById('LoaningBookDetail_<?php echo $index ?>_qty');
		
		$(book).change(function() {
			$.get('<?php echo Yii::app()->createUrl('book/ajaxBookDetail') ?>?id='+book.val(), function(data){
				if(data){
					var data = JSON.parse(data);
					modQty.value = data.qty;
				}else{
					modQty.value = "";
				}
			});
		});

		$(quantity).bind('keyup', function(){
			if(Number(modQty.value)==''){
				alert('Pilih terlebih dahulu Buku..');
				quantity.value = '';
				book.focus();
				return false;
			}
			if(Number(quantity.value) > Number(modQty.value)){
				alert('Jumlah Buku melebihi batas.. Jumlah Buku tidak melebihi '+modQty.value);
				quantity.value = '';
				return false;
			}
		});
		
	});
</script>