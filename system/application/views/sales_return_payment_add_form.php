<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_return_paymentoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sales_return_paymentview/index/' },
		}; 
		
		$('#sales_return_paymentform').click(function(){$('#sales_return_paymentform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Return Payment</h3>

<p>
<div id="sales_return_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_paymentadd/submit" id="sales_return_paymentform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".salesreturnpayment__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'salesreturnpayment__date', 'value' => $salesreturnpayment__date, 'class' => 'salesreturnpayment__datebasic'));?></td></tr>
<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'salesreturnpayment__salesreturnpaymentid', 'value' => $salesreturnpayment__salesreturnpaymentid, 'class' => 'basic', 'id' => 'salesreturnpayment__salesreturnpaymentid'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<?php if ($salesreturnpayment__customer_id > 0): ?>
<td><?=$customer_opt[$salesreturnpayment__customer_id];?></td>
<?=form_hidden('salesreturnpayment__customer_id', $salesreturnpayment__customer_id);?>
<?php else: ?>
<td><?=form_dropdown('salesreturnpayment__customer_id', $customer_opt, $salesreturnpayment__customer_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency *</td>
<?php if ($salesreturnpayment__currency_id > 0): ?>
<td><?=$currency_opt[$salesreturnpayment__currency_id];?></td>
<?=form_hidden('salesreturnpayment__currency_id', $salesreturnpayment__currency_id);?>
<?php else: ?>
<td><?=form_dropdown('salesreturnpayment__currency_id', $currency_opt, $salesreturnpayment__currency_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency Rate</td>
<td><?=form_input(array('name' => 'salesreturnpayment__currencyrate', 'value' => $salesreturnpayment__currencyrate, 'class' => 'basic', 'id' => 'salesreturnpayment__currencyrate'));?></td></tr>
<tr class='basic'>
<td>Payment Type</td><script type="text/javascript">$(document).ready(function() {$('#salesreturnpayment__paymenttype').change(function() { $('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#salesreturnpayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#salesreturnpayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td><?=form_dropdown('salesreturnpayment__paymenttype', array('Cash Bank' => 'Cash Bank', 'Giro' => 'Giro', 'Credit Note' => 'Credit Note', ), $salesreturnpayment__paymenttype, 'id="salesreturnpayment__paymenttype" class="basic"');?></td></tr>
<tr class='cash_bank'>
<td>Cash Bank *</td>
<?php if ($salesreturnpayment__cashbank_id > 0): ?>
<td><?=$cashbank_opt[$salesreturnpayment__cashbank_id];?></td>
<?=form_hidden('salesreturnpayment__cashbank_id', $salesreturnpayment__cashbank_id);?>
<?php else: ?>
<td><?=form_dropdown('salesreturnpayment__cashbank_id', $cashbank_opt, $salesreturnpayment__cashbank_id, 'class="cash_bank"');?></td>
<?php endif; ?></tr>
<tr class='giro'>
<td>Giro Out *</td>
<?php if ($salesreturnpayment__giroout_id > 0): ?>
<td><?=$giroout_opt[$salesreturnpayment__giroout_id];?></td>
<?=form_hidden('salesreturnpayment__giroout_id', $salesreturnpayment__giroout_id);?>
<?php else: ?>
<td><?=form_dropdown('salesreturnpayment__giroout_id', $giroout_opt, $salesreturnpayment__giroout_id, 'class="giro"');?></td>
<?php endif; ?></tr>
<tr class='credit_note'>
<td>Credit Note Out *</td>
<?php if ($salesreturnpayment__creditnoteout_id > 0): ?>
<td><?=$creditnoteout_opt[$salesreturnpayment__creditnoteout_id];?></td>
<?=form_hidden('salesreturnpayment__creditnoteout_id', $salesreturnpayment__creditnoteout_id);?>
<?php else: ?>
<td><?=form_dropdown('salesreturnpayment__creditnoteout_id', $creditnoteout_opt, $salesreturnpayment__creditnoteout_id, 'class="credit_note"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Amount To Pay</td>
<?=form_hidden('salesreturnpayment__total', $salesreturnpayment__total);?>
<td><?=number_format($salesreturnpayment__total, 2);?></td></tr>
<tr class='basic'>
<td>Total Pay</td>
<td><?=form_input(array('name' => 'salesreturnpayment__totalpay', 'value' => $salesreturnpayment__totalpay, 'class' => 'basic', 'id' => 'salesreturnpayment__totalpay'));?></td></tr>
<tr class='basic'>
<td>Adjustment</td>
<td><?=form_input(array('name' => 'salesreturnpayment__adjustment', 'value' => $salesreturnpayment__adjustment, 'class' => 'basic', 'id' => 'salesreturnpayment__adjustment'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>


<table>
<th>Sales Return Invoice
</th><?php foreach ($salesreturnpaymentline_data as $row): ?>
<tr>
<?php if ($row['salesreturnpaymentline__salesreturninvoice_id'] > 0): ?>
<td><?=$salesreturninvoice_opt[$row['salesreturnpaymentline__salesreturninvoice_id']];?></td>
<?=form_hidden('salesreturnpaymentline__salesreturninvoice_id[]', $row['salesreturnpaymentline__salesreturninvoice_id']);?>
<?php else: ?>
<td><?=form_dropdown('salesreturnpaymentline__salesreturninvoice_id[]', $salesreturninvoice_opt, $row['salesreturnpaymentline__salesreturninvoice_id'], 'class="basic"');?></td>
<?php endif; ?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_paymentlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
