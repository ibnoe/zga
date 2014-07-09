<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_invoiceoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_invoiceeditform').click(function(){$('#sales_invoiceeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Invoice</h3>

<p>
<div id="sales_invoiceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_invoiceedit/submit" id="sales_invoiceeditform" class="editform">

<?=form_hidden("sales_invoice_id", $sales_invoice_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#salesinvoice__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'salesinvoice__date', 'value' => $salesinvoice__date, 'class' => 'date', 'id' => 'salesinvoice__date'));?></td></tr><tr class='basic'>
<td>Sales Invoice No *</td><td><?=form_input(array('name' => 'salesinvoice__orderid', 'value' => $salesinvoice__orderid, 'id' => 'salesinvoice__orderid'));?></td></tr><tr class='basic'>
<td>DO No</td><td><?=form_input(array('name' => 'salesinvoice__donum', 'value' => $salesinvoice__donum, 'id' => 'salesinvoice__donum'));?></td></tr><tr class='basic'>
<td>Delivery Order *</td><td><?=form_dropdown('salesinvoice__deliveryorder_id', $deliveryorder_opt, $salesinvoice__deliveryorder_id);?>&nbsp;<input id='salesinvoice__deliveryorder_id_lookup' type='button' value='Lookup'></input></td><div id='salesinvoice__deliveryorder_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesinvoice__deliveryorder_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/delivery_order_for_invoicelookup', function(data) { $('#salesinvoice__deliveryorder_id_dialog').html(data);$('#salesinvoice__deliveryorder_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesinvoice__deliveryorder_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesinvoice__deliveryorder_id]').val(lines[0]);if (typeof window.sales_invoice_selected_deliveryorder_id == 'function') { sales_invoice_selected_deliveryorder_id("<?=site_url();?>"); }}$('#salesinvoice__deliveryorder_id_dialog').dialog('close');});$('#salesinvoice__deliveryorder_id_lookup').button().click(function() {$('#salesinvoice__deliveryorder_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'>
<td>Total</td><td><?=form_input(array('name' => 'salesinvoice__total', 'value' => $salesinvoice__total, 'id' => 'salesinvoice__total'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#salesinvoice__top').change(function() { $('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.1_week').attr('disabled', 'disabled');$('.1_week').hide();$('.2_weeks').attr('disabled', 'disabled');$('.2_weeks').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#salesinvoice__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '1 Week') {$('.1_week').attr('disabled', '');$('.1_week').show();}if (s == '2 Weeks') {$('.2_weeks').attr('disabled', '');$('.2_weeks').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});$('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.1_week').attr('disabled', 'disabled');$('.1_week').hide();$('.2_weeks').attr('disabled', 'disabled');$('.2_weeks').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#salesinvoice__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '1 Week') {$('.1_week').attr('disabled', '');$('.1_week').show();}if (s == '2 Weeks') {$('.2_weeks').attr('disabled', '');$('.2_weeks').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});</script>
<td>Payment Term</td><td><?=form_dropdown('salesinvoice__top', array('Cash' => 'Cash', '1 Week' => '1 Week', '2 Weeks' => '2 Weeks', '30 Days' => '30 Days', '60 Days' => '60 Days', ), $salesinvoice__top, 'id="salesinvoice__top" class="basic"');?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_invoicelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


