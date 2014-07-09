<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#receive_items_for_invoiceoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/receive_items_for_invoiceview/index/' },
		}; 
		
		$('#receive_items_for_invoiceform').click(function(){$('#receive_items_for_invoiceform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Receive Items For Invoice</h3>

<p>
<div id="receive_items_for_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/receive_items_for_invoiceadd/submit" id="receive_items_for_invoiceform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".receiveditem__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'receiveditem__date', 'value' => $receiveditem__date, 'class' => 'receiveditem__datebasic'));?></td></tr>
<tr class='basic'>
<td>Receive Item No *</td>
<td><?=form_input(array('name' => 'receiveditem__orderid', 'value' => $receiveditem__orderid, 'class' => 'basic', 'id' => 'receiveditem__orderid'));?></td></tr>
<tr class='basic'>
<td>Surat Jalan No *</td>
<td><?=form_input(array('name' => 'receiveditem__suratjalanno', 'value' => $receiveditem__suratjalanno, 'class' => 'basic', 'id' => 'receiveditem__suratjalanno'));?></td></tr>
<tr class='basic'>
<td>Supplier *</td>
<td><?=form_dropdown('receiveditem__supplier_id', array(), '', 'class="basic"');?>&nbsp;<input id='receiveditem__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='receiveditem__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#receiveditem__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#receiveditem__supplier_id_dialog').html(data);$('#receiveditem__supplier_id_dialog a').attr('disabled', 'disabled');$('#receiveditem__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=receiveditem__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=receiveditem__supplier_id]').val(lines[0]);if (typeof window.receive_items_for_invoice_selected_supplier_id == 'function') { receive_items_for_invoice_selected_supplier_id("<?=site_url();?>"); }}$('#receiveditem__supplier_id_dialog').dialog('close');});$('#receiveditem__supplier_id_lookup').button().click(function() {$('#receiveditem__supplier_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Warehouse *</td>
<td><?=form_dropdown('receiveditem__warehouse_id', array(), '', 'class="basic"');?>&nbsp;<input id='receiveditem__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='receiveditem__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#receiveditem__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#receiveditem__warehouse_id_dialog').html(data);$('#receiveditem__warehouse_id_dialog a').attr('disabled', 'disabled');$('#receiveditem__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=receiveditem__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=receiveditem__warehouse_id]').val(lines[0]);if (typeof window.receive_items_for_invoice_selected_warehouse_id == 'function') { receive_items_for_invoice_selected_warehouse_id("<?=site_url();?>"); }}$('#receiveditem__warehouse_id_dialog').dialog('close');});$('#receiveditem__warehouse_id_lookup').button().click(function() {$('#receiveditem__warehouse_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/receive_items_for_invoicelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
