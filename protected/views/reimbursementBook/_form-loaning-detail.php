<table class="table table-striped">
    <tr>
        <th><?php echo LoaningBook::model()->getAttributeLabel('loaning_code') ?></th>
        <td><?php echo TbHtml::textField('loaning_code', null, array('class'=>'form-control', 'readonly'=>true)); ?></td>
    </tr>
    <tr>
        <th><?php echo LoaningBook::model()->getAttributeLabel('loaning_date') ?></th>
        <td><?php echo TbHtml::textField('loaning_date', null, array('class'=>'form-control', 'readonly'=>true)); ?></td>
    </tr>
    <tr>
        <th><?php echo LoaningBook::model()->getAttributeLabel('reimbursement_date') ?></th>
        <td><?php echo TbHtml::textField('reimbursement_date', null, array('class'=>'form-control', 'readonly'=>true)); ?></td>
    </tr>
    <tr>
        <th><?php echo LoaningBook::model()->getAttributeLabel('status') ?></th>
        <td><?php echo TbHtml::textField('status', null, array('class'=>'form-control', 'readonly'=>true)); ?></td>
    </tr>
    <tr>
        <th>Jumlah Buku yang di Pinjam</th>
        <td><?php echo TbHtml::textField('qtyBook', null, array('class'=>'form-control', 'readonly'=>true)); ?></td>
    </tr>
    <tr>
        <th colspan="2">Detail Buku yang di Pinjam</th>
	</tr>
	<tr>
		<td id="bookDetails" colspan="2"></td>
	</tr>
</table>