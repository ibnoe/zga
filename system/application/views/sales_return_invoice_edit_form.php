<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_return_invoiceoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_return_invoiceeditform').click(function(){$('#sales_return_invoiceeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Return Invoice</h3>

<p>
<div id="sales_return_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_invoiceedit/submit" id="sales_return_invoiceeditform" class="editform">

<?=form_hidden("sales_return_invoice_id", $sales_return_invoice_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#salesreturninvoice__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'salesreturninvoice__date', 'value' => $salesreturninvoice__date, 'class' => 'date', 'id' => 'salesreturninvoice__date'));?></td></tr><tr class='basic'>
<td>Invoice No *</td><td><?=form_input(array('name' => 'salesreturninvoice__salesreturninvoiceid', 'value' => $salesreturninvoice__salesreturninvoiceid, 'id' => 'salesreturninvoice__salesreturninvoiceid'));?></td></tr><tr class='basic'>
<td>Sales Return Delivery *</td><td><?=form_dropdown('salesreturninvoice__salesreturndelivery_id', $salesreturndelivery_opt, $salesreturninvoice__salesreturndelivery_id);?>&nbsp;<input id='salesreturninvoice__salesreturndelivery_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturninvoice__salesreturndelivery_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturninvoice__salesreturndelivery_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/sales_return_delivery_for_invoicelookup', function(data) { $('#salesreturninvoice__salesreturndelivery_id_dialog').html(data);$('#salesreturninvoice__salesreturndelivery_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturninvoice__salesreturndelivery_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturninvoice__salesreturndelivery_id]').val(lines[0]);if (typeof window.sales_return_invoice_selected_salesreturndelivery_id == 'function') { sales_return_invoice_selected_salesreturndelivery_id("<?=site_url();?>"); }}$('#salesreturninvoice__salesreturndelivery_id_dialog').dialog('close');});$('#salesreturninvoice__salesreturndelivery_id_lookup').button().click(function() {$('#salesreturninvoice__salesreturndelivery_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'>
<td>Total</td><td><?=form_input(array('name' => 'salesreturninvoice__total', 'value' => $salesreturninvoice__total, 'id' => 'salesreturninvoice__total'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_invoicelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


