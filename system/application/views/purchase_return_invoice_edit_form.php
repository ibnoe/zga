<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_return_invoiceoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_return_invoiceeditform').click(function(){$('#purchase_return_invoiceeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Return Invoice</h3>

<p>
<div id="purchase_return_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_invoiceedit/submit" id="purchase_return_invoiceeditform" class="editform">

<?=form_hidden("purchase_return_invoice_id", $purchase_return_invoice_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#purchasereturninvoice__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'purchasereturninvoice__date', 'value' => $purchasereturninvoice__date, 'class' => 'date', 'id' => 'purchasereturninvoice__date'));?></td></tr><tr class='basic'>
<td>Invoice No *</td><td><?=form_input(array('name' => 'purchasereturninvoice__purchasereturninvoiceid', 'value' => $purchasereturninvoice__purchasereturninvoiceid, 'id' => 'purchasereturninvoice__purchasereturninvoiceid'));?></td></tr><tr class='basic'>
<td>Purchase Return Delivery *</td><td><?=form_dropdown('purchasereturninvoice__purchasereturndelivery_id', $purchasereturndelivery_opt, $purchasereturninvoice__purchasereturndelivery_id);?>&nbsp;<input id='purchasereturninvoice__purchasereturndelivery_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturninvoice__purchasereturndelivery_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturninvoice__purchasereturndelivery_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/purchase_return_delivery_for_invoicelookup', function(data) { $('#purchasereturninvoice__purchasereturndelivery_id_dialog').html(data);$('#purchasereturninvoice__purchasereturndelivery_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturninvoice__purchasereturndelivery_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturninvoice__purchasereturndelivery_id]').val(lines[0]);if (typeof window.purchase_return_invoice_selected_purchasereturndelivery_id == 'function') { purchase_return_invoice_selected_purchasereturndelivery_id("<?=site_url();?>"); }}$('#purchasereturninvoice__purchasereturndelivery_id_dialog').dialog('close');});$('#purchasereturninvoice__purchasereturndelivery_id_lookup').button().click(function() {$('#purchasereturninvoice__purchasereturndelivery_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'>
<td>Total</td><td><?=form_input(array('name' => 'purchasereturninvoice__total', 'value' => $purchasereturninvoice__total, 'id' => 'purchasereturninvoice__total'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_invoicelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


