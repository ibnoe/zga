<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_return_invoiceoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sales_return_invoiceview/index/' },
		}; 
		
		$('#sales_return_invoiceform').click(function(){$('#sales_return_invoiceform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Return Invoice</h3>

<p>
<div id="sales_return_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_invoiceadd/submit" id="sales_return_invoiceform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".salesreturninvoice__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'salesreturninvoice__date', 'value' => $salesreturninvoice__date, 'class' => 'salesreturninvoice__datebasic'));?></td></tr>
<tr class='basic'>
<td>Invoice No *</td>
<td><?=form_input(array('name' => 'salesreturninvoice__salesreturninvoiceid', 'value' => $salesreturninvoice__salesreturninvoiceid, 'class' => 'basic', 'id' => 'salesreturninvoice__salesreturninvoiceid'));?></td></tr>
<tr class='basic'>
<td>Sales Return Delivery *</td>
<td><?=form_dropdown('salesreturninvoice__salesreturndelivery_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesreturninvoice__salesreturndelivery_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturninvoice__salesreturndelivery_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturninvoice__salesreturndelivery_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/sales_return_delivery_for_invoicelookup', function(data) { $('#salesreturninvoice__salesreturndelivery_id_dialog').html(data);$('#salesreturninvoice__salesreturndelivery_id_dialog a').attr('disabled', 'disabled');$('#salesreturninvoice__salesreturndelivery_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturninvoice__salesreturndelivery_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturninvoice__salesreturndelivery_id]').val(lines[0]);if (typeof window.sales_return_invoice_selected_salesreturndelivery_id == 'function') { sales_return_invoice_selected_salesreturndelivery_id("<?=site_url();?>"); }}$('#salesreturninvoice__salesreturndelivery_id_dialog').dialog('close');});$('#salesreturninvoice__salesreturndelivery_id_lookup').button().click(function() {$('#salesreturninvoice__salesreturndelivery_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<?=form_hidden('salesreturninvoice__customer_id', $salesreturninvoice__customer_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesreturninvoice__currency_id', $salesreturninvoice__currency_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesreturninvoice__currencyrate', $salesreturninvoice__currencyrate);?></tr>
<tr class='basic'>
<td>Total</td>
<td><?=form_input(array('name' => 'salesreturninvoice__total', 'value' => $salesreturninvoice__total, 'class' => 'basic', 'id' => 'salesreturninvoice__total'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_invoicelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
