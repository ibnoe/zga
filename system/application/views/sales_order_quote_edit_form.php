<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_order_quoteoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_order_quoteeditform').click(function(){$('#sales_order_quoteeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Order Quote</h3>

<p>
<div id="sales_order_quoteoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_order_quoteedit/submit" id="sales_order_quoteeditform" class="editform">

<?=form_hidden("sales_order_quote_id", $sales_order_quote_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>No Penawaran *</td><td><?=form_input(array('name' => 'salesorder__nopenawaran', 'value' => $salesorder__nopenawaran, 'id' => 'salesorder__nopenawaran'));?></td></tr><tr class='basic'>
<td>No PO</td><td><?=form_input(array('name' => 'salesorder__customerponumber', 'value' => $salesorder__customerponumber, 'id' => 'salesorder__customerponumber'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#salesorder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'salesorder__date', 'value' => $salesorder__date, 'class' => 'date', 'id' => 'salesorder__date'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'salesorder__notes', 'value' => $salesorder__notes, 'id' => 'salesorder__notes'));?></td></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('salesorder__customer_id', $customer_opt, $salesorder__customer_id);?>&nbsp;<input id='salesorder__customer_id_lookup' type='button' value='Lookup'></input></td><div id='salesorder__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorder__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#salesorder__customer_id_dialog').html(data);$('#salesorder__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorder__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorder__customer_id]').val(lines[0]);if (typeof window.sales_order_quote_selected_customer_id == 'function') { sales_order_quote_selected_customer_id("<?=site_url();?>"); }}$('#salesorder__customer_id_dialog').dialog('close');});$('#salesorder__customer_id_lookup').button().click(function() {$('#salesorder__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('salesorder__currency_id', $currency_opt, $salesorder__currency_id);?>&nbsp;<input id='salesorder__currency_id_lookup' type='button' value='Lookup'></input></td><div id='salesorder__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorder__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#salesorder__currency_id_dialog').html(data);$('#salesorder__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorder__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorder__currency_id]').val(lines[0]);if (typeof window.sales_order_quote_selected_currency_id == 'function') { sales_order_quote_selected_currency_id("<?=site_url();?>"); }}$('#salesorder__currency_id_dialog').dialog('close');});$('#salesorder__currency_id_lookup').button().click(function() {$('#salesorder__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency Rate</td><td><?=form_input(array('name' => 'salesorder__currencyrate', 'value' => $salesorder__currencyrate, 'id' => 'salesorder__currencyrate'));?></td></tr><tr class='basic'>
<td>Marketing Officer</td><td><?=form_dropdown('salesorder__marketingofficer_id', $marketingofficer_opt, $salesorder__marketingofficer_id);?>&nbsp;<input id='salesorder__marketingofficer_id_lookup' type='button' value='Lookup'></input></td><div id='salesorder__marketingofficer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorder__marketingofficer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/marketing_officerlookup', function(data) { $('#salesorder__marketingofficer_id_dialog').html(data);$('#salesorder__marketingofficer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorder__marketingofficer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorder__marketingofficer_id]').val(lines[0]);if (typeof window.sales_order_quote_selected_marketingofficer_id == 'function') { sales_order_quote_selected_marketingofficer_id("<?=site_url();?>"); }}$('#salesorder__marketingofficer_id_dialog').dialog('close');});$('#salesorder__marketingofficer_id_lookup').button().click(function() {$('#salesorder__marketingofficer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#salesorder__status').change(function() { $('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#salesorder__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});$('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#salesorder__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});</script>
<td>Status</td><td><?=form_dropdown('salesorder__status', array('Waiting For Approval' => 'Waiting For Approval', 'Rejected' => 'Rejected', 'Approved' => 'Approved', ), $salesorder__status, 'id="salesorder__status" class="basic"');?></td></tr><tr class='approved'>
<td>SO ID *</td><td><?=form_input(array('name' => 'salesorder__orderid', 'value' => $salesorder__orderid, 'id' => 'salesorder__orderid'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_order_quotelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


