<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_paymentoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_paymenteditform').click(function(){$('#purchase_paymenteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Payment</h3>

<p>
<div id="purchase_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_paymentedit/submit" id="purchase_paymenteditform" class="editform">

<?=form_hidden("purchase_payment_id", $purchase_payment_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#purchasepayment__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'purchasepayment__date', 'value' => $purchasepayment__date, 'class' => 'date', 'id' => 'purchasepayment__date'));?></td></tr><tr class='basic'>
<td>Purchase Payment No *</td><td><?=form_input(array('name' => 'purchasepayment__purchasepaymentid', 'value' => $purchasepayment__purchasepaymentid, 'id' => 'purchasepayment__purchasepaymentid'));?></td></tr><tr class='basic'>
<td>Supplier *</td><td><?=form_dropdown('purchasepayment__supplier_id', $supplier_opt, $purchasepayment__supplier_id);?>&nbsp;<input id='purchasepayment__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='purchasepayment__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasepayment__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#purchasepayment__supplier_id_dialog').html(data);$('#purchasepayment__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasepayment__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasepayment__supplier_id]').val(lines[0]);if (typeof window.purchase_payment_selected_supplier_id == 'function') { purchase_payment_selected_supplier_id("<?=site_url();?>"); }}$('#purchasepayment__supplier_id_dialog').dialog('close');});$('#purchasepayment__supplier_id_lookup').button().click(function() {$('#purchasepayment__supplier_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('purchasepayment__currency_id', $currency_opt, $purchasepayment__currency_id);?>&nbsp;<input id='purchasepayment__currency_id_lookup' type='button' value='Lookup'></input></td><div id='purchasepayment__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasepayment__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#purchasepayment__currency_id_dialog').html(data);$('#purchasepayment__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasepayment__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasepayment__currency_id]').val(lines[0]);if (typeof window.purchase_payment_selected_currency_id == 'function') { purchase_payment_selected_currency_id("<?=site_url();?>"); }}$('#purchasepayment__currency_id_dialog').dialog('close');});$('#purchasepayment__currency_id_lookup').button().click(function() {$('#purchasepayment__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency Rate</td><td><?=form_input(array('name' => 'purchasepayment__currencyrate', 'value' => $purchasepayment__currencyrate, 'id' => 'purchasepayment__currencyrate'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#purchasepayment__paymenttype').change(function() { $('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#purchasepayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#purchasepayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td>Payment Type</td><td><?=form_dropdown('purchasepayment__paymenttype', array('Cash Bank' => 'Cash Bank', 'Giro' => 'Giro', 'Credit Note' => 'Credit Note', ), $purchasepayment__paymenttype, 'id="purchasepayment__paymenttype" class="basic"');?></td></tr><tr class='cash_bank'>
<td>Cash Bank *</td><td><?=form_dropdown('purchasepayment__cashbank_id', $cashbank_opt, $purchasepayment__cashbank_id);?>&nbsp;<input id='purchasepayment__cashbank_id_lookup' type='button' value='Lookup'></input></td><div id='purchasepayment__cashbank_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasepayment__cashbank_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/cash_banklookup', function(data) { $('#purchasepayment__cashbank_id_dialog').html(data);$('#purchasepayment__cashbank_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasepayment__cashbank_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchasepayment__cashbank_id]').val(lines[0]);if (typeof window.purchase_payment_selected_cashbank_id == 'function') { purchase_payment_selected_cashbank_id("<?=site_url();?>"); }}$('#purchasepayment__cashbank_id_dialog').dialog('close');});$('#purchasepayment__cashbank_id_lookup').button().click(function() {$('#purchasepayment__cashbank_id_dialog').dialog('open');});});});</script></tr><tr class='giro'>
<td>Giro Out *</td><td><?=form_dropdown('purchasepayment__giroout_id', $giroout_opt, $purchasepayment__giroout_id);?>&nbsp;<input id='purchasepayment__giroout_id_lookup' type='button' value='Lookup'></input></td><div id='purchasepayment__giroout_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasepayment__giroout_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/giro_outlookup', function(data) { $('#purchasepayment__giroout_id_dialog').html(data);$('#purchasepayment__giroout_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasepayment__giroout_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchasepayment__giroout_id]').val(lines[0]);if (typeof window.purchase_payment_selected_giroout_id == 'function') { purchase_payment_selected_giroout_id("<?=site_url();?>"); }}$('#purchasepayment__giroout_id_dialog').dialog('close');});$('#purchasepayment__giroout_id_lookup').button().click(function() {$('#purchasepayment__giroout_id_dialog').dialog('open');});});});</script></tr><tr class='credit_note'>
<td>Credit Note In *</td><td><?=form_dropdown('purchasepayment__creditnotein_id', $creditnotein_opt, $purchasepayment__creditnotein_id);?>&nbsp;<input id='purchasepayment__creditnotein_id_lookup' type='button' value='Lookup'></input></td><div id='purchasepayment__creditnotein_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasepayment__creditnotein_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/credit_note_inlookup', function(data) { $('#purchasepayment__creditnotein_id_dialog').html(data);$('#purchasepayment__creditnotein_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasepayment__creditnotein_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchasepayment__creditnotein_id]').val(lines[0]);if (typeof window.purchase_payment_selected_creditnotein_id == 'function') { purchase_payment_selected_creditnotein_id("<?=site_url();?>"); }}$('#purchasepayment__creditnotein_id_dialog').dialog('close');});$('#purchasepayment__creditnotein_id_lookup').button().click(function() {$('#purchasepayment__creditnotein_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Total Payment</td><td><?=form_input(array('name' => 'purchasepayment__totalpay', 'value' => $purchasepayment__totalpay, 'id' => 'purchasepayment__totalpay'));?></td></tr><tr class='basic'>
<td>Adjustment</td><td><?=form_input(array('name' => 'purchasepayment__adjustment', 'value' => $purchasepayment__adjustment, 'id' => 'purchasepayment__adjustment'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_paymentlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


