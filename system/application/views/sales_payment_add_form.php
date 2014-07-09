<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_paymentoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sales_paymentview/index/' },
		}; 
		
		$('#sales_paymentform').click(function(){$('#sales_paymentform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Payment</h3>

<p>
<div id="sales_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_paymentadd/submit" id="sales_paymentform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".salespayment__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'salespayment__date', 'value' => $salespayment__date, 'class' => 'salespayment__datebasic'));?></td></tr>
<tr class='basic'>
<td>Sales Payment No *</td>
<td><?=form_input(array('name' => 'salespayment__orderid', 'value' => $salespayment__orderid, 'class' => 'basic', 'id' => 'salespayment__orderid'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<?php if ($salespayment__customer_id > 0): ?>
<td><?=$customer_opt[$salespayment__customer_id];?></td>
<?=form_hidden('salespayment__customer_id', $salespayment__customer_id);?>
<?php else: ?>
<td><?=form_dropdown('salespayment__customer_id', $customer_opt, $salespayment__customer_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency *</td>
<?php if ($salespayment__currency_id > 0): ?>
<td><?=$currency_opt[$salespayment__currency_id];?></td>
<?=form_hidden('salespayment__currency_id', $salespayment__currency_id);?>
<?php else: ?>
<td><?=form_dropdown('salespayment__currency_id', $currency_opt, $salespayment__currency_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency Rate</td>
<td><?=form_input(array('name' => 'salespayment__currencyrate', 'value' => $salespayment__currencyrate, 'class' => 'basic', 'id' => 'salespayment__currencyrate'));?></td></tr>
<tr class='basic'>
<td>Payment Type</td><script type="text/javascript">$(document).ready(function() {$('#salespayment__paymenttype').change(function() { $('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#salespayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#salespayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td><?=form_dropdown('salespayment__paymenttype', array('Cash Bank' => 'Cash Bank', 'Giro' => 'Giro', 'Credit Note' => 'Credit Note', ), $salespayment__paymenttype, 'id="salespayment__paymenttype" class="basic"');?></td></tr>
<tr class='cash_bank'>
<td>Cash Bank *</td>
<?php if ($salespayment__cashbank_id > 0): ?>
<td><?=$cashbank_opt[$salespayment__cashbank_id];?></td>
<?=form_hidden('salespayment__cashbank_id', $salespayment__cashbank_id);?>
<?php else: ?>
<td><?=form_dropdown('salespayment__cashbank_id', $cashbank_opt, $salespayment__cashbank_id, 'class="cash_bank"');?></td>
<?php endif; ?></tr>
<tr class='giro'>
<td>Giro In *</td>
<?php if ($salespayment__giroin_id > 0): ?>
<td><?=$giroin_opt[$salespayment__giroin_id];?></td>
<?=form_hidden('salespayment__giroin_id', $salespayment__giroin_id);?>
<?php else: ?>
<td><?=form_dropdown('salespayment__giroin_id', $giroin_opt, $salespayment__giroin_id, 'class="giro"');?></td>
<?php endif; ?></tr>
<tr class='credit_note'>
<td>Credit Note Out *</td>
<?php if ($salespayment__creditnoteout_id > 0): ?>
<td><?=$creditnoteout_opt[$salespayment__creditnoteout_id];?></td>
<?=form_hidden('salespayment__creditnoteout_id', $salespayment__creditnoteout_id);?>
<?php else: ?>
<td><?=form_dropdown('salespayment__creditnoteout_id', $creditnoteout_opt, $salespayment__creditnoteout_id, 'class="credit_note"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Amount To Pay</td>
<?=form_hidden('salespayment__total', $salespayment__total);?>
<td><?=number_format($salespayment__total, 2);?></td></tr>
<tr class='basic'>
<td>Total Pay</td>
<td><?=form_input(array('name' => 'salespayment__totalpay', 'value' => $salespayment__totalpay, 'class' => 'basic', 'id' => 'salespayment__totalpay'));?></td></tr>
<tr class='basic'>
<td>Adjustment</td>
<td><?=form_input(array('name' => 'salespayment__adjustment', 'value' => $salespayment__adjustment, 'class' => 'basic', 'id' => 'salespayment__adjustment'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>


<table>
<th>Sales Invoice
</th><?php foreach ($salespaymentline_data as $row): ?>
<tr>
<?php if ($row['salespaymentline__salesinvoice_id'] > 0): ?>
<td><?=$salesinvoice_opt[$row['salespaymentline__salesinvoice_id']];?></td>
<?=form_hidden('salespaymentline__salesinvoice_id[]', $row['salespaymentline__salesinvoice_id']);?>
<?php else: ?>
<td><?=form_dropdown('salespaymentline__salesinvoice_id[]', $salesinvoice_opt, $row['salespaymentline__salesinvoice_id'], 'class="basic"');?></td>
<?php endif; ?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_paymentlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
