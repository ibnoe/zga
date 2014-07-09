<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#delivery_order_for_invoiceoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#delivery_order_for_invoiceeditform').click(function(){$('#delivery_order_for_invoiceeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Delivery Order For Invoice</h3>

<p>
<div id="delivery_order_for_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/delivery_order_for_invoiceedit/submit" id="delivery_order_for_invoiceeditform" class="editform">

<?=form_hidden("delivery_order_for_invoice_id", $delivery_order_for_invoice_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#deliveryorder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'deliveryorder__date', 'value' => $deliveryorder__date, 'class' => 'date', 'id' => 'deliveryorder__date'));?></td></tr><tr class='basic'>
<td>Delivery Order No *</td><td><?=form_input(array('name' => 'deliveryorder__orderid', 'value' => $deliveryorder__orderid, 'id' => 'deliveryorder__orderid'));?></td></tr><tr class='basic'>
<td>DO Number</td><td><?=form_input(array('name' => 'deliveryorder__donum', 'value' => $deliveryorder__donum, 'id' => 'deliveryorder__donum'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#deliveryorder__dodate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>DO Date *</td><td><?=form_input(array('name' => 'deliveryorder__dodate', 'value' => $deliveryorder__dodate, 'class' => 'date', 'id' => 'deliveryorder__dodate'));?></td></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('deliveryorder__customer_id', $customer_opt, $deliveryorder__customer_id);?>&nbsp;<input id='deliveryorder__customer_id_lookup' type='button' value='Lookup'></input></td><div id='deliveryorder__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#deliveryorder__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#deliveryorder__customer_id_dialog').html(data);$('#deliveryorder__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=deliveryorder__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=deliveryorder__customer_id]').val(lines[0]);if (typeof window.delivery_order_for_invoice_selected_customer_id == 'function') { delivery_order_for_invoice_selected_customer_id("<?=site_url();?>"); }}$('#deliveryorder__customer_id_dialog').dialog('close');});$('#deliveryorder__customer_id_lookup').button().click(function() {$('#deliveryorder__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Warehouse *</td><td><?=form_dropdown('deliveryorder__warehouse_id', $warehouse_opt, $deliveryorder__warehouse_id);?>&nbsp;<input id='deliveryorder__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='deliveryorder__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#deliveryorder__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#deliveryorder__warehouse_id_dialog').html(data);$('#deliveryorder__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=deliveryorder__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=deliveryorder__warehouse_id]').val(lines[0]);if (typeof window.delivery_order_for_invoice_selected_warehouse_id == 'function') { delivery_order_for_invoice_selected_warehouse_id("<?=site_url();?>"); }}$('#deliveryorder__warehouse_id_dialog').dialog('close');});$('#deliveryorder__warehouse_id_lookup').button().click(function() {$('#deliveryorder__warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Delivered By</td><td><?=form_input(array('name' => 'deliveryorder__deliveredby', 'value' => $deliveryorder__deliveredby, 'id' => 'deliveryorder__deliveredby'));?></td></tr><tr class='basic'>
<td>Vehicle Number</td><td><?=form_input(array('name' => 'deliveryorder__vehicleno', 'value' => $deliveryorder__vehicleno, 'id' => 'deliveryorder__vehicleno'));?></td></tr><tr class='basic'>
<td>Special Instruction</td><td><?=form_textarea(array('name' => 'deliveryorder__notes', 'value' => $deliveryorder__notes, 'id' => 'deliveryorder__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/delivery_order_for_invoicelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


