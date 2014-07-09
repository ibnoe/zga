<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_return_order_open_sentoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_return_order_open_senteditform').click(function(){$('#purchase_return_order_open_senteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Return Order Open Sent</h3>

<p>
<div id="purchase_return_order_open_sentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_order_open_sentedit/submit" id="purchase_return_order_open_senteditform" class="editform">

<?=form_hidden("purchase_return_order_open_sent_id", $purchase_return_order_open_sent_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#purchasereturnorder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'purchasereturnorder__date', 'value' => $purchasereturnorder__date, 'class' => 'date', 'id' => 'purchasereturnorder__date'));?></td></tr><tr class='basic'>
<td>Return ID *</td><td><?=form_input(array('name' => 'purchasereturnorder__purchasereturnorderid', 'value' => $purchasereturnorder__purchasereturnorderid, 'id' => 'purchasereturnorder__purchasereturnorderid'));?></td></tr><tr class='basic'>
<td>Supplier *</td><td><?=form_dropdown('purchasereturnorder__supplier_id', $supplier_opt, $purchasereturnorder__supplier_id);?>&nbsp;<input id='purchasereturnorder__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnorder__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnorder__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#purchasereturnorder__supplier_id_dialog').html(data);$('#purchasereturnorder__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnorder__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturnorder__supplier_id]').val(lines[0]);if (typeof window.purchase_return_order_open_sent_selected_supplier_id == 'function') { purchase_return_order_open_sent_selected_supplier_id("<?=site_url();?>"); }}$('#purchasereturnorder__supplier_id_dialog').dialog('close');});$('#purchasereturnorder__supplier_id_lookup').button().click(function() {$('#purchasereturnorder__supplier_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('purchasereturnorder__currency_id', $currency_opt, $purchasereturnorder__currency_id);?>&nbsp;<input id='purchasereturnorder__currency_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnorder__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnorder__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#purchasereturnorder__currency_id_dialog').html(data);$('#purchasereturnorder__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnorder__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturnorder__currency_id]').val(lines[0]);if (typeof window.purchase_return_order_open_sent_selected_currency_id == 'function') { purchase_return_order_open_sent_selected_currency_id("<?=site_url();?>"); }}$('#purchasereturnorder__currency_id_dialog').dialog('close');});$('#purchasereturnorder__currency_id_lookup').button().click(function() {$('#purchasereturnorder__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency Rate</td><td><?=form_input(array('name' => 'purchasereturnorder__currencyrate', 'value' => $purchasereturnorder__currencyrate, 'id' => 'purchasereturnorder__currencyrate'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'purchasereturnorder__notes', 'value' => $purchasereturnorder__notes, 'id' => 'purchasereturnorder__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_order_open_sentlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


