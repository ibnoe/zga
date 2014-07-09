<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_return_paymentoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_return_paymenteditform').click(function(){$('#purchase_return_paymenteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Return Payment</h3>

<p>
<div id="purchase_return_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_paymentedit/submit" id="purchase_return_paymenteditform" class="editform">

<?=form_hidden("purchase_return_payment_id", $purchase_return_payment_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#purchasereturnpayment__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'purchasereturnpayment__date', 'value' => $purchasereturnpayment__date, 'class' => 'date', 'id' => 'purchasereturnpayment__date'));?></td></tr><tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'purchasereturnpayment__purchasereturnpaymentid', 'value' => $purchasereturnpayment__purchasereturnpaymentid, 'id' => 'purchasereturnpayment__purchasereturnpaymentid'));?></td></tr><tr class='basic'>
<td>Supplier *</td><td><?=form_dropdown('purchasereturnpayment__supplier_id', $supplier_opt, $purchasereturnpayment__supplier_id);?>&nbsp;<input id='purchasereturnpayment__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnpayment__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnpayment__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#purchasereturnpayment__supplier_id_dialog').html(data);$('#purchasereturnpayment__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnpayment__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturnpayment__supplier_id]').val(lines[0]);if (typeof window.purchase_return_payment_selected_supplier_id == 'function') { purchase_return_payment_selected_supplier_id("<?=site_url();?>"); }}$('#purchasereturnpayment__supplier_id_dialog').dialog('close');});$('#purchasereturnpayment__supplier_id_lookup').button().click(function() {$('#purchasereturnpayment__supplier_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('purchasereturnpayment__currency_id', $currency_opt, $purchasereturnpayment__currency_id);?>&nbsp;<input id='purchasereturnpayment__currency_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnpayment__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnpayment__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#purchasereturnpayment__currency_id_dialog').html(data);$('#purchasereturnpayment__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnpayment__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturnpayment__currency_id]').val(lines[0]);if (typeof window.purchase_return_payment_selected_currency_id == 'function') { purchase_return_payment_selected_currency_id("<?=site_url();?>"); }}$('#purchasereturnpayment__currency_id_dialog').dialog('close');});$('#purchasereturnpayment__currency_id_lookup').button().click(function() {$('#purchasereturnpayment__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency Rate</td><td><?=form_input(array('name' => 'purchasereturnpayment__currencyrate', 'value' => $purchasereturnpayment__currencyrate, 'id' => 'purchasereturnpayment__currencyrate'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#purchasereturnpayment__paymenttype').change(function() { $('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#purchasereturnpayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#purchasereturnpayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td>Payment Type</td><td><?=form_dropdown('purchasereturnpayment__paymenttype', array('Cash Bank' => 'Cash Bank', 'Giro' => 'Giro', 'Credit Note' => 'Credit Note', ), $purchasereturnpayment__paymenttype, 'id="purchasereturnpayment__paymenttype" class="basic"');?></td></tr><tr class='cash_bank'>
<td>Cash Bank *</td><td><?=form_dropdown('purchasereturnpayment__cashbank_id', $cashbank_opt, $purchasereturnpayment__cashbank_id);?>&nbsp;<input id='purchasereturnpayment__cashbank_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnpayment__cashbank_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnpayment__cashbank_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/cash_banklookup', function(data) { $('#purchasereturnpayment__cashbank_id_dialog').html(data);$('#purchasereturnpayment__cashbank_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnpayment__cashbank_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchasereturnpayment__cashbank_id]').val(lines[0]);if (typeof window.purchase_return_payment_selected_cashbank_id == 'function') { purchase_return_payment_selected_cashbank_id("<?=site_url();?>"); }}$('#purchasereturnpayment__cashbank_id_dialog').dialog('close');});$('#purchasereturnpayment__cashbank_id_lookup').button().click(function() {$('#purchasereturnpayment__cashbank_id_dialog').dialog('open');});});});</script></tr><tr class='giro'>
<td>Giro In *</td><td><?=form_dropdown('purchasereturnpayment__giroin_id', $giroin_opt, $purchasereturnpayment__giroin_id);?>&nbsp;<input id='purchasereturnpayment__giroin_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnpayment__giroin_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnpayment__giroin_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/giro_inlookup', function(data) { $('#purchasereturnpayment__giroin_id_dialog').html(data);$('#purchasereturnpayment__giroin_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnpayment__giroin_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchasereturnpayment__giroin_id]').val(lines[0]);if (typeof window.purchase_return_payment_selected_giroin_id == 'function') { purchase_return_payment_selected_giroin_id("<?=site_url();?>"); }}$('#purchasereturnpayment__giroin_id_dialog').dialog('close');});$('#purchasereturnpayment__giroin_id_lookup').button().click(function() {$('#purchasereturnpayment__giroin_id_dialog').dialog('open');});});});</script></tr><tr class='credit_note'>
<td>Credit Note In *</td><td><?=form_dropdown('purchasereturnpayment__creditnotein_id', $creditnotein_opt, $purchasereturnpayment__creditnotein_id);?>&nbsp;<input id='purchasereturnpayment__creditnotein_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnpayment__creditnotein_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnpayment__creditnotein_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/credit_note_inlookup', function(data) { $('#purchasereturnpayment__creditnotein_id_dialog').html(data);$('#purchasereturnpayment__creditnotein_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnpayment__creditnotein_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchasereturnpayment__creditnotein_id]').val(lines[0]);if (typeof window.purchase_return_payment_selected_creditnotein_id == 'function') { purchase_return_payment_selected_creditnotein_id("<?=site_url();?>"); }}$('#purchasereturnpayment__creditnotein_id_dialog').dialog('close');});$('#purchasereturnpayment__creditnotein_id_lookup').button().click(function() {$('#purchasereturnpayment__creditnotein_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Total Pay</td><td><?=form_input(array('name' => 'purchasereturnpayment__totalpay', 'value' => $purchasereturnpayment__totalpay, 'id' => 'purchasereturnpayment__totalpay'));?></td></tr><tr class='basic'>
<td>Adjustment</td><td><?=form_input(array('name' => 'purchasereturnpayment__adjustment', 'value' => $purchasereturnpayment__adjustment, 'id' => 'purchasereturnpayment__adjustment'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_paymentlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


