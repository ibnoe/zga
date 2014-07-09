<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_return_delivery_for_invoiceoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_return_delivery_for_invoiceeditform').click(function(){$('#purchase_return_delivery_for_invoiceeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Return Delivery For Invoice</h3>

<p>
<div id="purchase_return_delivery_for_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_delivery_for_invoiceedit/submit" id="purchase_return_delivery_for_invoiceeditform" class="editform">

<?=form_hidden("purchase_return_delivery_for_invoice_id", $purchase_return_delivery_for_invoice_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#purchasereturndelivery__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'purchasereturndelivery__date', 'value' => $purchasereturndelivery__date, 'class' => 'date', 'id' => 'purchasereturndelivery__date'));?></td></tr><tr class='basic'>
<td>Delivery No *</td><td><?=form_input(array('name' => 'purchasereturndelivery__purchasereturndeliveryid', 'value' => $purchasereturndelivery__purchasereturndeliveryid, 'id' => 'purchasereturndelivery__purchasereturndeliveryid'));?></td></tr><tr class='basic'>
<td>Supplier *</td><td><?=form_dropdown('purchasereturndelivery__supplier_id', $supplier_opt, $purchasereturndelivery__supplier_id);?>&nbsp;<input id='purchasereturndelivery__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturndelivery__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturndelivery__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#purchasereturndelivery__supplier_id_dialog').html(data);$('#purchasereturndelivery__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturndelivery__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturndelivery__supplier_id]').val(lines[0]);if (typeof window.purchase_return_delivery_for_invoice_selected_supplier_id == 'function') { purchase_return_delivery_for_invoice_selected_supplier_id("<?=site_url();?>"); }}$('#purchasereturndelivery__supplier_id_dialog').dialog('close');});$('#purchasereturndelivery__supplier_id_lookup').button().click(function() {$('#purchasereturndelivery__supplier_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Warehouse *</td><td><?=form_dropdown('purchasereturndelivery__warehouse_id', $warehouse_opt, $purchasereturndelivery__warehouse_id);?>&nbsp;<input id='purchasereturndelivery__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturndelivery__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturndelivery__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#purchasereturndelivery__warehouse_id_dialog').html(data);$('#purchasereturndelivery__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturndelivery__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchasereturndelivery__warehouse_id]').val(lines[0]);if (typeof window.purchase_return_delivery_for_invoice_selected_warehouse_id == 'function') { purchase_return_delivery_for_invoice_selected_warehouse_id("<?=site_url();?>"); }}$('#purchasereturndelivery__warehouse_id_dialog').dialog('close');});$('#purchasereturndelivery__warehouse_id_lookup').button().click(function() {$('#purchasereturndelivery__warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'purchasereturndelivery__notes', 'value' => $purchasereturndelivery__notes, 'id' => 'purchasereturndelivery__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_delivery_for_invoicelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


