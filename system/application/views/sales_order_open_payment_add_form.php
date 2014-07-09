<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_order_open_paymentoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sales_order_open_paymentview/index/' },
		}; 
		
		$('#sales_order_open_paymentform').click(function(){$('#sales_order_open_paymentform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Order Open Payment</h3>

<p>
<div id="sales_order_open_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_order_open_paymentadd/submit" id="sales_order_open_paymentform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>SO ID *</td>
<td><?=form_input(array('name' => 'salesorder__orderid', 'value' => $salesorder__orderid, 'class' => 'basic', 'id' => 'salesorder__orderid'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".salesorder__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'salesorder__date', 'value' => $salesorder__date, 'class' => 'salesorder__datebasic'));?></td></tr>
<tr class='basic'>
<td>No Penawaran</td>
<td><?=form_input(array('name' => 'salesorder__nopenawaran', 'value' => $salesorder__nopenawaran, 'class' => 'basic', 'id' => 'salesorder__nopenawaran'));?></td></tr>
<tr class='basic'>
<td>No PO</td>
<td><?=form_input(array('name' => 'salesorder__customerponumber', 'value' => $salesorder__customerponumber, 'class' => 'basic', 'id' => 'salesorder__customerponumber'));?></td></tr>
<tr class='basic'>
<td>Marketing Officer</td>
<td><?=form_dropdown('salesorder__marketingofficer_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorder__marketingofficer_id_lookup' type='button' value='Lookup'></input></td><div id='salesorder__marketingofficer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorder__marketingofficer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/marketing_officerlookup', function(data) { $('#salesorder__marketingofficer_id_dialog').html(data);$('#salesorder__marketingofficer_id_dialog a').attr('disabled', 'disabled');$('#salesorder__marketingofficer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorder__marketingofficer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorder__marketingofficer_id]').val(lines[0]);if (typeof window.sales_order_open_payment_selected_marketingofficer_id == 'function') { sales_order_open_payment_selected_marketingofficer_id("<?=site_url();?>"); }}$('#salesorder__marketingofficer_id_dialog').dialog('close');});$('#salesorder__marketingofficer_id_lookup').button().click(function() {$('#salesorder__marketingofficer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Description</td>
<td><?=form_input(array('name' => 'salesorder__notes', 'value' => $salesorder__notes, 'class' => 'basic', 'id' => 'salesorder__notes'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<td><?=form_dropdown('salesorder__customer_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorder__customer_id_lookup' type='button' value='Lookup'></input></td><div id='salesorder__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorder__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#salesorder__customer_id_dialog').html(data);$('#salesorder__customer_id_dialog a').attr('disabled', 'disabled');$('#salesorder__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorder__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorder__customer_id]').val(lines[0]);if (typeof window.sales_order_open_payment_selected_customer_id == 'function') { sales_order_open_payment_selected_customer_id("<?=site_url();?>"); }}$('#salesorder__customer_id_dialog').dialog('close');});$('#salesorder__customer_id_lookup').button().click(function() {$('#salesorder__customer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Currency *</td>
<td><?=form_dropdown('salesorder__currency_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorder__currency_id_lookup' type='button' value='Lookup'></input></td><div id='salesorder__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorder__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#salesorder__currency_id_dialog').html(data);$('#salesorder__currency_id_dialog a').attr('disabled', 'disabled');$('#salesorder__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorder__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorder__currency_id]').val(lines[0]);if (typeof window.sales_order_open_payment_selected_currency_id == 'function') { sales_order_open_payment_selected_currency_id("<?=site_url();?>"); }}$('#salesorder__currency_id_dialog').dialog('close');});$('#salesorder__currency_id_lookup').button().click(function() {$('#salesorder__currency_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Currency Rate</td>
<td><?=form_input(array('name' => 'salesorder__currencyrate', 'value' => $salesorder__currencyrate, 'class' => 'basic', 'id' => 'salesorder__currencyrate'));?></td></tr>
<tr class='basic'>
<?=form_hidden('salesorder__status', $salesorder__status);?></tr>
<tr class='basic'>
<?=form_hidden('salesorder__modulename', $salesorder__modulename);?></tr>
<tr class='basic'>
<td>Gross Amount</td>
<td><?=form_input(array('name' => 'salesorder__total', 'value' => $salesorder__total, 'class' => 'basic', 'id' => 'salesorder__total'));?></td></tr>
<tr class='basic'>
<td>Total Discount</td>
<td><?=form_input(array('name' => 'salesorder__totaldiscount', 'value' => $salesorder__totaldiscount, 'class' => 'basic', 'id' => 'salesorder__totaldiscount'));?></td></tr>
<tr class='basic'>
<td>Total Tax</td>
<td><?=form_input(array('name' => 'salesorder__totaltax', 'value' => $salesorder__totaltax, 'class' => 'basic', 'id' => 'salesorder__totaltax'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_order_open_paymentlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
