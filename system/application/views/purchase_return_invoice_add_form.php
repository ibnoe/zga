<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_invoiceoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_return_invoiceview/index/' },
		}; 
		
		$('#purchase_return_invoiceform').click(function(){$('#purchase_return_invoiceform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Invoice</h3>

<p>
<div id="purchase_return_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_invoiceadd/submit" id="purchase_return_invoiceform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchasereturninvoice__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchasereturninvoice__date', 'value' => $purchasereturninvoice__date, 'class' => 'purchasereturninvoice__datebasic'));?></td></tr>
<tr class='basic'>
<td>Invoice No *</td>
<td><?=form_input(array('name' => 'purchasereturninvoice__purchasereturninvoiceid', 'value' => $purchasereturninvoice__purchasereturninvoiceid, 'class' => 'basic', 'id' => 'purchasereturninvoice__purchasereturninvoiceid'));?></td></tr>
<tr class='basic'>
<td>Purchase Return Delivery *</td>
<td><?=form_dropdown('purchasereturninvoice__purchasereturndelivery_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasereturninvoice__purchasereturndelivery_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturninvoice__purchasereturndelivery_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturninvoice__purchasereturndelivery_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/purchase_return_delivery_for_invoicelookup', function(data) { $('#purchasereturninvoice__purchasereturndelivery_id_dialog').html(data);$('#purchasereturninvoice__purchasereturndelivery_id_dialog a').attr('disabled', 'disabled');$('#purchasereturninvoice__purchasereturndelivery_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturninvoice__purchasereturndelivery_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturninvoice__purchasereturndelivery_id]').val(lines[0]);if (typeof window.purchase_return_invoice_selected_purchasereturndelivery_id == 'function') { purchase_return_invoice_selected_purchasereturndelivery_id("<?=site_url();?>"); }}$('#purchasereturninvoice__purchasereturndelivery_id_dialog').dialog('close');});$('#purchasereturninvoice__purchasereturndelivery_id_lookup').button().click(function() {$('#purchasereturninvoice__purchasereturndelivery_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<?=form_hidden('purchasereturninvoice__supplier_id', $purchasereturninvoice__supplier_id);?></tr>
<tr class='basic'>
<?=form_hidden('purchasereturninvoice__currency_id', $purchasereturninvoice__currency_id);?></tr>
<tr class='basic'>
<?=form_hidden('purchasereturninvoice__currencyrate', $purchasereturninvoice__currencyrate);?></tr>
<tr class='basic'>
<td>Total</td>
<td><?=form_input(array('name' => 'purchasereturninvoice__total', 'value' => $purchasereturninvoice__total, 'class' => 'basic', 'id' => 'purchasereturninvoice__total'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_invoicelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
