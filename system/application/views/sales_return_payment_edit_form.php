<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_return_paymentoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_return_paymenteditform').click(function(){$('#sales_return_paymenteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Return Payment</h3>

<p>
<div id="sales_return_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_paymentedit/submit" id="sales_return_paymenteditform" class="editform">

<?=form_hidden("sales_return_payment_id", $sales_return_payment_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#salesreturnpayment__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'salesreturnpayment__date', 'value' => $salesreturnpayment__date, 'class' => 'date', 'id' => 'salesreturnpayment__date'));?></td></tr><tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'salesreturnpayment__salesreturnpaymentid', 'value' => $salesreturnpayment__salesreturnpaymentid, 'id' => 'salesreturnpayment__salesreturnpaymentid'));?></td></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('salesreturnpayment__customer_id', $customer_opt, $salesreturnpayment__customer_id);?>&nbsp;<input id='salesreturnpayment__customer_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturnpayment__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturnpayment__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#salesreturnpayment__customer_id_dialog').html(data);$('#salesreturnpayment__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturnpayment__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturnpayment__customer_id]').val(lines[0]);if (typeof window.sales_return_payment_selected_customer_id == 'function') { sales_return_payment_selected_customer_id("<?=site_url();?>"); }}$('#salesreturnpayment__customer_id_dialog').dialog('close');});$('#salesreturnpayment__customer_id_lookup').button().click(function() {$('#salesreturnpayment__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('salesreturnpayment__currency_id', $currency_opt, $salesreturnpayment__currency_id);?>&nbsp;<input id='salesreturnpayment__currency_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturnpayment__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturnpayment__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#salesreturnpayment__currency_id_dialog').html(data);$('#salesreturnpayment__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturnpayment__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturnpayment__currency_id]').val(lines[0]);if (typeof window.sales_return_payment_selected_currency_id == 'function') { sales_return_payment_selected_currency_id("<?=site_url();?>"); }}$('#salesreturnpayment__currency_id_dialog').dialog('close');});$('#salesreturnpayment__currency_id_lookup').button().click(function() {$('#salesreturnpayment__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency Rate</td><td><?=form_input(array('name' => 'salesreturnpayment__currencyrate', 'value' => $salesreturnpayment__currencyrate, 'id' => 'salesreturnpayment__currencyrate'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#salesreturnpayment__paymenttype').change(function() { $('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#salesreturnpayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#salesreturnpayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td>Payment Type</td><td><?=form_dropdown('salesreturnpayment__paymenttype', array('Cash Bank' => 'Cash Bank', 'Giro' => 'Giro', 'Credit Note' => 'Credit Note', ), $salesreturnpayment__paymenttype, 'id="salesreturnpayment__paymenttype" class="basic"');?></td></tr><tr class='cash_bank'>
<td>Cash Bank *</td><td><?=form_dropdown('salesreturnpayment__cashbank_id', $cashbank_opt, $salesreturnpayment__cashbank_id);?>&nbsp;<input id='salesreturnpayment__cashbank_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturnpayment__cashbank_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturnpayment__cashbank_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/cash_banklookup', function(data) { $('#salesreturnpayment__cashbank_id_dialog').html(data);$('#salesreturnpayment__cashbank_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturnpayment__cashbank_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesreturnpayment__cashbank_id]').val(lines[0]);if (typeof window.sales_return_payment_selected_cashbank_id == 'function') { sales_return_payment_selected_cashbank_id("<?=site_url();?>"); }}$('#salesreturnpayment__cashbank_id_dialog').dialog('close');});$('#salesreturnpayment__cashbank_id_lookup').button().click(function() {$('#salesreturnpayment__cashbank_id_dialog').dialog('open');});});});</script></tr><tr class='giro'>
<td>Giro Out *</td><td><?=form_dropdown('salesreturnpayment__giroout_id', $giroout_opt, $salesreturnpayment__giroout_id);?>&nbsp;<input id='salesreturnpayment__giroout_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturnpayment__giroout_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturnpayment__giroout_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/giro_outlookup', function(data) { $('#salesreturnpayment__giroout_id_dialog').html(data);$('#salesreturnpayment__giroout_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturnpayment__giroout_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesreturnpayment__giroout_id]').val(lines[0]);if (typeof window.sales_return_payment_selected_giroout_id == 'function') { sales_return_payment_selected_giroout_id("<?=site_url();?>"); }}$('#salesreturnpayment__giroout_id_dialog').dialog('close');});$('#salesreturnpayment__giroout_id_lookup').button().click(function() {$('#salesreturnpayment__giroout_id_dialog').dialog('open');});});});</script></tr><tr class='credit_note'>
<td>Credit Note Out *</td><td><?=form_dropdown('salesreturnpayment__creditnoteout_id', $creditnoteout_opt, $salesreturnpayment__creditnoteout_id);?>&nbsp;<input id='salesreturnpayment__creditnoteout_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturnpayment__creditnoteout_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturnpayment__creditnoteout_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/credit_note_outlookup', function(data) { $('#salesreturnpayment__creditnoteout_id_dialog').html(data);$('#salesreturnpayment__creditnoteout_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturnpayment__creditnoteout_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesreturnpayment__creditnoteout_id]').val(lines[0]);if (typeof window.sales_return_payment_selected_creditnoteout_id == 'function') { sales_return_payment_selected_creditnoteout_id("<?=site_url();?>"); }}$('#salesreturnpayment__creditnoteout_id_dialog').dialog('close');});$('#salesreturnpayment__creditnoteout_id_lookup').button().click(function() {$('#salesreturnpayment__creditnoteout_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Total Pay</td><td><?=form_input(array('name' => 'salesreturnpayment__totalpay', 'value' => $salesreturnpayment__totalpay, 'id' => 'salesreturnpayment__totalpay'));?></td></tr><tr class='basic'>
<td>Adjustment</td><td><?=form_input(array('name' => 'salesreturnpayment__adjustment', 'value' => $salesreturnpayment__adjustment, 'id' => 'salesreturnpayment__adjustment'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_paymentlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


