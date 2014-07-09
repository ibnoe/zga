<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#receive_items_for_invoiceoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#receive_items_for_invoiceeditform').click(function(){$('#receive_items_for_invoiceeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Receive Items For Invoice</h3>

<p>
<div id="receive_items_for_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/receive_items_for_invoiceedit/submit" id="receive_items_for_invoiceeditform" class="editform">

<?=form_hidden("receive_items_for_invoice_id", $receive_items_for_invoice_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#receiveditem__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'receiveditem__date', 'value' => $receiveditem__date, 'class' => 'date', 'id' => 'receiveditem__date'));?></td></tr><tr class='basic'>
<td>Receive Item No *</td><td><?=form_input(array('name' => 'receiveditem__orderid', 'value' => $receiveditem__orderid, 'id' => 'receiveditem__orderid'));?></td></tr><tr class='basic'>
<td>Surat Jalan No *</td><td><?=form_input(array('name' => 'receiveditem__suratjalanno', 'value' => $receiveditem__suratjalanno, 'id' => 'receiveditem__suratjalanno'));?></td></tr><tr class='basic'>
<td>Supplier *</td><td><?=form_dropdown('receiveditem__supplier_id', $supplier_opt, $receiveditem__supplier_id);?>&nbsp;<input id='receiveditem__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='receiveditem__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#receiveditem__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#receiveditem__supplier_id_dialog').html(data);$('#receiveditem__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=receiveditem__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=receiveditem__supplier_id]').val(lines[0]);if (typeof window.receive_items_for_invoice_selected_supplier_id == 'function') { receive_items_for_invoice_selected_supplier_id("<?=site_url();?>"); }}$('#receiveditem__supplier_id_dialog').dialog('close');});$('#receiveditem__supplier_id_lookup').button().click(function() {$('#receiveditem__supplier_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Warehouse *</td><td><?=form_dropdown('receiveditem__warehouse_id', $warehouse_opt, $receiveditem__warehouse_id);?>&nbsp;<input id='receiveditem__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='receiveditem__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#receiveditem__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#receiveditem__warehouse_id_dialog').html(data);$('#receiveditem__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=receiveditem__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=receiveditem__warehouse_id]').val(lines[0]);if (typeof window.receive_items_for_invoice_selected_warehouse_id == 'function') { receive_items_for_invoice_selected_warehouse_id("<?=site_url();?>"); }}$('#receiveditem__warehouse_id_dialog').dialog('close');});$('#receiveditem__warehouse_id_lookup').button().click(function() {$('#receiveditem__warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/receive_items_for_invoicelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


