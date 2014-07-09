<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_paymentoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_return_paymentview/index/' },
		}; 
		
		$('#purchase_return_paymentform').click(function(){$('#purchase_return_paymentform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Payment</h3>

<p>
<div id="purchase_return_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_paymentadd/submit" id="purchase_return_paymentform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchasereturnpayment__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchasereturnpayment__date', 'value' => $purchasereturnpayment__date, 'class' => 'purchasereturnpayment__datebasic'));?></td></tr>
<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'purchasereturnpayment__purchasereturnpaymentid', 'value' => $purchasereturnpayment__purchasereturnpaymentid, 'class' => 'basic', 'id' => 'purchasereturnpayment__purchasereturnpaymentid'));?></td></tr>
<tr class='basic'>
<td>Supplier *</td>
<?php if ($purchasereturnpayment__supplier_id > 0): ?>
<td><?=$supplier_opt[$purchasereturnpayment__supplier_id];?></td>
<?=form_hidden('purchasereturnpayment__supplier_id', $purchasereturnpayment__supplier_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasereturnpayment__supplier_id', $supplier_opt, $purchasereturnpayment__supplier_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency *</td>
<?php if ($purchasereturnpayment__currency_id > 0): ?>
<td><?=$currency_opt[$purchasereturnpayment__currency_id];?></td>
<?=form_hidden('purchasereturnpayment__currency_id', $purchasereturnpayment__currency_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasereturnpayment__currency_id', $currency_opt, $purchasereturnpayment__currency_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency Rate</td>
<td><?=form_input(array('name' => 'purchasereturnpayment__currencyrate', 'value' => $purchasereturnpayment__currencyrate, 'class' => 'basic', 'id' => 'purchasereturnpayment__currencyrate'));?></td></tr>
<tr class='basic'>
<td>Payment Type</td><script type="text/javascript">$(document).ready(function() {$('#purchasereturnpayment__paymenttype').change(function() { $('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#purchasereturnpayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#purchasereturnpayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td><?=form_dropdown('purchasereturnpayment__paymenttype', array('Cash Bank' => 'Cash Bank', 'Giro' => 'Giro', 'Credit Note' => 'Credit Note', ), $purchasereturnpayment__paymenttype, 'id="purchasereturnpayment__paymenttype" class="basic"');?></td></tr>
<tr class='cash_bank'>
<td>Cash Bank *</td>
<?php if ($purchasereturnpayment__cashbank_id > 0): ?>
<td><?=$cashbank_opt[$purchasereturnpayment__cashbank_id];?></td>
<?=form_hidden('purchasereturnpayment__cashbank_id', $purchasereturnpayment__cashbank_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasereturnpayment__cashbank_id', $cashbank_opt, $purchasereturnpayment__cashbank_id, 'class="cash_bank"');?></td>
<?php endif; ?></tr>
<tr class='giro'>
<td>Giro In *</td>
<?php if ($purchasereturnpayment__giroin_id > 0): ?>
<td><?=$giroin_opt[$purchasereturnpayment__giroin_id];?></td>
<?=form_hidden('purchasereturnpayment__giroin_id', $purchasereturnpayment__giroin_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasereturnpayment__giroin_id', $giroin_opt, $purchasereturnpayment__giroin_id, 'class="giro"');?></td>
<?php endif; ?></tr>
<tr class='credit_note'>
<td>Credit Note In *</td>
<?php if ($purchasereturnpayment__creditnotein_id > 0): ?>
<td><?=$creditnotein_opt[$purchasereturnpayment__creditnotein_id];?></td>
<?=form_hidden('purchasereturnpayment__creditnotein_id', $purchasereturnpayment__creditnotein_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasereturnpayment__creditnotein_id', $creditnotein_opt, $purchasereturnpayment__creditnotein_id, 'class="credit_note"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Amount To Pay</td>
<?=form_hidden('purchasereturnpayment__total', $purchasereturnpayment__total);?>
<td><?=number_format($purchasereturnpayment__total, 2);?></td></tr>
<tr class='basic'>
<td>Total Pay</td>
<td><?=form_input(array('name' => 'purchasereturnpayment__totalpay', 'value' => $purchasereturnpayment__totalpay, 'class' => 'basic', 'id' => 'purchasereturnpayment__totalpay'));?></td></tr>
<tr class='basic'>
<td>Adjustment</td>
<td><?=form_input(array('name' => 'purchasereturnpayment__adjustment', 'value' => $purchasereturnpayment__adjustment, 'class' => 'basic', 'id' => 'purchasereturnpayment__adjustment'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>


<table>
<th>Purchase Return Invoice
</th><?php foreach ($purchasereturnpaymentline_data as $row): ?>
<tr>
<?php if ($row['purchasereturnpaymentline__purchasereturninvoice_id'] > 0): ?>
<td><?=$purchasereturninvoice_opt[$row['purchasereturnpaymentline__purchasereturninvoice_id']];?></td>
<?=form_hidden('purchasereturnpaymentline__purchasereturninvoice_id[]', $row['purchasereturnpaymentline__purchasereturninvoice_id']);?>
<?php else: ?>
<td><?=form_dropdown('purchasereturnpaymentline__purchasereturninvoice_id[]', $purchasereturninvoice_opt, $row['purchasereturnpaymentline__purchasereturninvoice_id'], 'class="basic"');?></td>
<?php endif; ?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_paymentlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
