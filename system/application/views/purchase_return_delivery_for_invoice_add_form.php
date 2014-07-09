<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_delivery_for_invoiceoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_return_delivery_for_invoiceview/index/' },
		}; 
		
		$('#purchase_return_delivery_for_invoiceform').click(function(){$('#purchase_return_delivery_for_invoiceform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Delivery For Invoice</h3>

<p>
<div id="purchase_return_delivery_for_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_delivery_for_invoiceadd/submit" id="purchase_return_delivery_for_invoiceform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchasereturndelivery__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchasereturndelivery__date', 'value' => $purchasereturndelivery__date, 'class' => 'purchasereturndelivery__datebasic'));?></td></tr>
<tr class='basic'>
<td>Delivery No *</td>
<td><?=form_input(array('name' => 'purchasereturndelivery__purchasereturndeliveryid', 'value' => $purchasereturndelivery__purchasereturndeliveryid, 'class' => 'basic', 'id' => 'purchasereturndelivery__purchasereturndeliveryid'));?></td></tr>
<tr class='basic'>
<td>Supplier *</td>
<td><?=form_dropdown('purchasereturndelivery__supplier_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasereturndelivery__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturndelivery__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturndelivery__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#purchasereturndelivery__supplier_id_dialog').html(data);$('#purchasereturndelivery__supplier_id_dialog a').attr('disabled', 'disabled');$('#purchasereturndelivery__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturndelivery__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturndelivery__supplier_id]').val(lines[0]);if (typeof window.purchase_return_delivery_for_invoice_selected_supplier_id == 'function') { purchase_return_delivery_for_invoice_selected_supplier_id("<?=site_url();?>"); }}$('#purchasereturndelivery__supplier_id_dialog').dialog('close');});$('#purchasereturndelivery__supplier_id_lookup').button().click(function() {$('#purchasereturndelivery__supplier_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Warehouse *</td>
<td><?=form_dropdown('purchasereturndelivery__warehouse_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasereturndelivery__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturndelivery__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturndelivery__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#purchasereturndelivery__warehouse_id_dialog').html(data);$('#purchasereturndelivery__warehouse_id_dialog a').attr('disabled', 'disabled');$('#purchasereturndelivery__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturndelivery__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchasereturndelivery__warehouse_id]').val(lines[0]);if (typeof window.purchase_return_delivery_for_invoice_selected_warehouse_id == 'function') { purchase_return_delivery_for_invoice_selected_warehouse_id("<?=site_url();?>"); }}$('#purchasereturndelivery__warehouse_id_dialog').dialog('close');});$('#purchasereturndelivery__warehouse_id_lookup').button().click(function() {$('#purchasereturndelivery__warehouse_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'purchasereturndelivery__notes', 'value' => $purchasereturndelivery__notes, 'class' => 'basic', 'id' => 'purchasereturndelivery__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_delivery_for_invoicelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
