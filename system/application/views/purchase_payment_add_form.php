<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_paymentoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_paymentview/index/' },
		}; 
		
		$('#purchase_paymentform').click(function(){$('#purchase_paymentform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Payment</h3>

<p>
<div id="purchase_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_paymentadd/submit" id="purchase_paymentform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchasepayment__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchasepayment__date', 'value' => $purchasepayment__date, 'class' => 'purchasepayment__datebasic'));?></td></tr>
<tr class='basic'>
<td>Purchase Payment No *</td>
<td><?=form_input(array('name' => 'purchasepayment__purchasepaymentid', 'value' => $purchasepayment__purchasepaymentid, 'class' => 'basic', 'id' => 'purchasepayment__purchasepaymentid'));?></td></tr>
<tr class='basic'>
<td>Supplier *</td>
<?php if ($purchasepayment__supplier_id > 0): ?>
<td><?=$supplier_opt[$purchasepayment__supplier_id];?></td>
<?=form_hidden('purchasepayment__supplier_id', $purchasepayment__supplier_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasepayment__supplier_id', $supplier_opt, $purchasepayment__supplier_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency *</td>
<?php if ($purchasepayment__currency_id > 0): ?>
<td><?=$currency_opt[$purchasepayment__currency_id];?></td>
<?=form_hidden('purchasepayment__currency_id', $purchasepayment__currency_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasepayment__currency_id', $currency_opt, $purchasepayment__currency_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency Rate</td>
<td><?=form_input(array('name' => 'purchasepayment__currencyrate', 'value' => $purchasepayment__currencyrate, 'class' => 'basic', 'id' => 'purchasepayment__currencyrate'));?></td></tr>
<tr class='basic'>
<td>Payment Type</td><script type="text/javascript">$(document).ready(function() {$('#purchasepayment__paymenttype').change(function() { $('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#purchasepayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#purchasepayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td><?=form_dropdown('purchasepayment__paymenttype', array('Cash Bank' => 'Cash Bank', 'Giro' => 'Giro', 'Credit Note' => 'Credit Note', ), $purchasepayment__paymenttype, 'id="purchasepayment__paymenttype" class="basic"');?></td></tr>
<tr class='cash_bank'>
<td>Cash Bank *</td>
<?php if ($purchasepayment__cashbank_id > 0): ?>
<td><?=$cashbank_opt[$purchasepayment__cashbank_id];?></td>
<?=form_hidden('purchasepayment__cashbank_id', $purchasepayment__cashbank_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasepayment__cashbank_id', $cashbank_opt, $purchasepayment__cashbank_id, 'class="cash_bank"');?></td>
<?php endif; ?></tr>
<tr class='giro'>
<td>Giro Out *</td>
<?php if ($purchasepayment__giroout_id > 0): ?>
<td><?=$giroout_opt[$purchasepayment__giroout_id];?></td>
<?=form_hidden('purchasepayment__giroout_id', $purchasepayment__giroout_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasepayment__giroout_id', $giroout_opt, $purchasepayment__giroout_id, 'class="giro"');?></td>
<?php endif; ?></tr>
<tr class='credit_note'>
<td>Credit Note In *</td>
<?php if ($purchasepayment__creditnotein_id > 0): ?>
<td><?=$creditnotein_opt[$purchasepayment__creditnotein_id];?></td>
<?=form_hidden('purchasepayment__creditnotein_id', $purchasepayment__creditnotein_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasepayment__creditnotein_id', $creditnotein_opt, $purchasepayment__creditnotein_id, 'class="credit_note"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Amount To Pay</td>
<?=form_hidden('purchasepayment__total', $purchasepayment__total);?>
<td><?=number_format($purchasepayment__total, 2);?></td></tr>
<tr class='basic'>
<td>Total Payment</td>
<td><?=form_input(array('name' => 'purchasepayment__totalpay', 'value' => $purchasepayment__totalpay, 'class' => 'basic', 'id' => 'purchasepayment__totalpay'));?></td></tr>
<tr class='basic'>
<td>Adjustment</td>
<td><?=form_input(array('name' => 'purchasepayment__adjustment', 'value' => $purchasepayment__adjustment, 'class' => 'basic', 'id' => 'purchasepayment__adjustment'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>


<table>
<th>Purchase Invoice
</th><?php foreach ($purchasepaymentline_data as $row): ?>
<tr>
<?php if ($row['purchasepaymentline__purchaseinvoice_id'] > 0): ?>
<td><?=$purchaseinvoice_opt[$row['purchasepaymentline__purchaseinvoice_id']];?></td>
<?=form_hidden('purchasepaymentline__purchaseinvoice_id[]', $row['purchasepaymentline__purchaseinvoice_id']);?>
<?php else: ?>
<td><?=form_dropdown('purchasepaymentline__purchaseinvoice_id[]', $purchaseinvoice_opt, $row['purchasepaymentline__purchaseinvoice_id'], 'class="basic"');?></td>
<?php endif; ?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_paymentlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
