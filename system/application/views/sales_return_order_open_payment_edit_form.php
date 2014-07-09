<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_return_order_open_paymentoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_return_order_open_paymenteditform').click(function(){$('#sales_return_order_open_paymenteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Return Order Open Payment</h3>

<p>
<div id="sales_return_order_open_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_order_open_paymentedit/submit" id="sales_return_order_open_paymenteditform" class="editform">

<?=form_hidden("sales_return_order_open_payment_id", $sales_return_order_open_payment_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#salesreturnorder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'salesreturnorder__date', 'value' => $salesreturnorder__date, 'class' => 'date', 'id' => 'salesreturnorder__date'));?></td></tr><tr class='basic'>
<td>Return ID *</td><td><?=form_input(array('name' => 'salesreturnorder__salesreturnorderid', 'value' => $salesreturnorder__salesreturnorderid, 'id' => 'salesreturnorder__salesreturnorderid'));?></td></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('salesreturnorder__customer_id', $customer_opt, $salesreturnorder__customer_id);?>&nbsp;<input id='salesreturnorder__customer_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturnorder__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturnorder__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#salesreturnorder__customer_id_dialog').html(data);$('#salesreturnorder__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturnorder__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturnorder__customer_id]').val(lines[0]);if (typeof window.sales_return_order_open_payment_selected_customer_id == 'function') { sales_return_order_open_payment_selected_customer_id("<?=site_url();?>"); }}$('#salesreturnorder__customer_id_dialog').dialog('close');});$('#salesreturnorder__customer_id_lookup').button().click(function() {$('#salesreturnorder__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('salesreturnorder__currency_id', $currency_opt, $salesreturnorder__currency_id);?>&nbsp;<input id='salesreturnorder__currency_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturnorder__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturnorder__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#salesreturnorder__currency_id_dialog').html(data);$('#salesreturnorder__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturnorder__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturnorder__currency_id]').val(lines[0]);if (typeof window.sales_return_order_open_payment_selected_currency_id == 'function') { sales_return_order_open_payment_selected_currency_id("<?=site_url();?>"); }}$('#salesreturnorder__currency_id_dialog').dialog('close');});$('#salesreturnorder__currency_id_lookup').button().click(function() {$('#salesreturnorder__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency Rate</td><td><?=form_input(array('name' => 'salesreturnorder__currencyrate', 'value' => $salesreturnorder__currencyrate, 'id' => 'salesreturnorder__currencyrate'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'salesreturnorder__notes', 'value' => $salesreturnorder__notes, 'id' => 'salesreturnorder__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_order_open_paymentlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


