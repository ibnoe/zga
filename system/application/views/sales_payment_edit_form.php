<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_paymentoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_paymenteditform').click(function(){$('#sales_paymenteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Payment</h3>

<p>
<div id="sales_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_paymentedit/submit" id="sales_paymenteditform" class="editform">

<?=form_hidden("sales_payment_id", $sales_payment_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#salespayment__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'salespayment__date', 'value' => $salespayment__date, 'class' => 'date', 'id' => 'salespayment__date'));?></td></tr><tr class='basic'>
<td>Sales Payment No *</td><td><?=form_input(array('name' => 'salespayment__orderid', 'value' => $salespayment__orderid, 'id' => 'salespayment__orderid'));?></td></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('salespayment__customer_id', $customer_opt, $salespayment__customer_id);?>&nbsp;<input id='salespayment__customer_id_lookup' type='button' value='Lookup'></input></td><div id='salespayment__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salespayment__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#salespayment__customer_id_dialog').html(data);$('#salespayment__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salespayment__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salespayment__customer_id]').val(lines[0]);if (typeof window.sales_payment_selected_customer_id == 'function') { sales_payment_selected_customer_id("<?=site_url();?>"); }}$('#salespayment__customer_id_dialog').dialog('close');});$('#salespayment__customer_id_lookup').button().click(function() {$('#salespayment__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('salespayment__currency_id', $currency_opt, $salespayment__currency_id);?>&nbsp;<input id='salespayment__currency_id_lookup' type='button' value='Lookup'></input></td><div id='salespayment__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salespayment__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#salespayment__currency_id_dialog').html(data);$('#salespayment__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salespayment__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salespayment__currency_id]').val(lines[0]);if (typeof window.sales_payment_selected_currency_id == 'function') { sales_payment_selected_currency_id("<?=site_url();?>"); }}$('#salespayment__currency_id_dialog').dialog('close');});$('#salespayment__currency_id_lookup').button().click(function() {$('#salespayment__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency Rate</td><td><?=form_input(array('name' => 'salespayment__currencyrate', 'value' => $salespayment__currencyrate, 'id' => 'salespayment__currencyrate'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#salespayment__paymenttype').change(function() { $('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#salespayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#salespayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td>Payment Type</td><td><?=form_dropdown('salespayment__paymenttype', array('Cash Bank' => 'Cash Bank', 'Giro' => 'Giro', 'Credit Note' => 'Credit Note', ), $salespayment__paymenttype, 'id="salespayment__paymenttype" class="basic"');?></td></tr><tr class='cash_bank'>
<td>Cash Bank *</td><td><?=form_dropdown('salespayment__cashbank_id', $cashbank_opt, $salespayment__cashbank_id);?>&nbsp;<input id='salespayment__cashbank_id_lookup' type='button' value='Lookup'></input></td><div id='salespayment__cashbank_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salespayment__cashbank_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/cash_banklookup', function(data) { $('#salespayment__cashbank_id_dialog').html(data);$('#salespayment__cashbank_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salespayment__cashbank_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salespayment__cashbank_id]').val(lines[0]);if (typeof window.sales_payment_selected_cashbank_id == 'function') { sales_payment_selected_cashbank_id("<?=site_url();?>"); }}$('#salespayment__cashbank_id_dialog').dialog('close');});$('#salespayment__cashbank_id_lookup').button().click(function() {$('#salespayment__cashbank_id_dialog').dialog('open');});});});</script></tr><tr class='giro'>
<td>Giro In *</td><td><?=form_dropdown('salespayment__giroin_id', $giroin_opt, $salespayment__giroin_id);?>&nbsp;<input id='salespayment__giroin_id_lookup' type='button' value='Lookup'></input></td><div id='salespayment__giroin_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salespayment__giroin_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/giro_inlookup', function(data) { $('#salespayment__giroin_id_dialog').html(data);$('#salespayment__giroin_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salespayment__giroin_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salespayment__giroin_id]').val(lines[0]);if (typeof window.sales_payment_selected_giroin_id == 'function') { sales_payment_selected_giroin_id("<?=site_url();?>"); }}$('#salespayment__giroin_id_dialog').dialog('close');});$('#salespayment__giroin_id_lookup').button().click(function() {$('#salespayment__giroin_id_dialog').dialog('open');});});});</script></tr><tr class='credit_note'>
<td>Credit Note Out *</td><td><?=form_dropdown('salespayment__creditnoteout_id', $creditnoteout_opt, $salespayment__creditnoteout_id);?>&nbsp;<input id='salespayment__creditnoteout_id_lookup' type='button' value='Lookup'></input></td><div id='salespayment__creditnoteout_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salespayment__creditnoteout_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/credit_note_outlookup', function(data) { $('#salespayment__creditnoteout_id_dialog').html(data);$('#salespayment__creditnoteout_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salespayment__creditnoteout_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salespayment__creditnoteout_id]').val(lines[0]);if (typeof window.sales_payment_selected_creditnoteout_id == 'function') { sales_payment_selected_creditnoteout_id("<?=site_url();?>"); }}$('#salespayment__creditnoteout_id_dialog').dialog('close');});$('#salespayment__creditnoteout_id_lookup').button().click(function() {$('#salespayment__creditnoteout_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Total Pay</td><td><?=form_input(array('name' => 'salespayment__totalpay', 'value' => $salespayment__totalpay, 'id' => 'salespayment__totalpay'));?></td></tr><tr class='basic'>
<td>Adjustment</td><td><?=form_input(array('name' => 'salespayment__adjustment', 'value' => $salespayment__adjustment, 'id' => 'salespayment__adjustment'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_paymentlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


