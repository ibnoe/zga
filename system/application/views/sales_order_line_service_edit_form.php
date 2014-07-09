<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_order_line_serviceoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_order_line_serviceeditform').click(function(){$('#sales_order_line_serviceeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Order Line Service</h3>

<p>
<div id="sales_order_line_serviceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_order_line_serviceedit/submit" id="sales_order_line_serviceeditform" class="editform">

<?=form_hidden("sales_order_line_service_id", $sales_order_line_service_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Order ID</td><td><?=form_input(array('name' => 'salesorderline__orderid', 'value' => $salesorderline__orderid, 'id' => 'salesorderline__orderid'));?></td></tr><tr class='basic'>
<td>Date</td><td><?=form_input(array('name' => 'salesorderline__date', 'value' => $salesorderline__date, 'id' => 'salesorderline__date'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'salesorderline__notes', 'value' => $salesorderline__notes, 'id' => 'salesorderline__notes'));?></td></tr><tr class='basic'>
<td>Customer</td><td><?=form_input(array('name' => 'salesorderline__customer_id', 'value' => $salesorderline__customer_id, 'id' => 'salesorderline__customer_id'));?></td></tr><tr class='basic'>
<td>Currency</td><td><?=form_input(array('name' => 'salesorderline__currency_id', 'value' => $salesorderline__currency_id, 'id' => 'salesorderline__currency_id'));?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=form_input(array('name' => 'salesorderline__currencyrate', 'value' => $salesorderline__currencyrate, 'id' => 'salesorderline__currencyrate'));?></td></tr><tr class='basic'>
<td>Ship To Location</td><td><?=form_input(array('name' => 'salesorderline__warehouse_id', 'value' => $salesorderline__warehouse_id, 'id' => 'salesorderline__warehouse_id'));?></td></tr><tr class='basic'>
<td>Status</td><td><?=form_input(array('name' => 'salesorderline__status', 'value' => $salesorderline__status, 'id' => 'salesorderline__status'));?></td></tr><tr class='basic'>
<td>RCN</td><td><?=form_dropdown('salesorderline__rcn_id', $rcn_opt, $salesorderline__rcn_id);?>&nbsp;<input id='salesorderline__rcn_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderline__rcn_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderline__rcn_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/rcnlist', function(data) { $('#salesorderline__rcn_id_dialog').html(data);$('#salesorderline__rcn_id_dialog table tr').click(function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=salesorderline__rcn_id]').find('option').remove().end().append('<option value=' + lines[0] + '>' + lines[2] + '</option>').val('0');$('#salesorderline__rcn_id').val(lines[0]);$('#salesorderline__rcn_id_dialog').dialog('close');});$('#salesorderline__rcn_id_lookup').button().click(function() {$('#salesorderline__rcn_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'salesorderline__quantity', 'value' => $salesorderline__quantity, 'id' => 'salesorderline__quantity'));?></td></tr><tr class='basic'>
<td>Price *</td><td><?=form_input(array('name' => 'salesorderline__price', 'value' => $salesorderline__price, 'id' => 'salesorderline__price'));?></td></tr><tr class='basic'>
<td>Disc %</td><td><?=form_input(array('name' => 'salesorderline__pdisc', 'value' => $salesorderline__pdisc, 'id' => 'salesorderline__pdisc'));?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=form_input(array('name' => 'salesorderline__subtotal', 'value' => $salesorderline__subtotal, 'id' => 'salesorderline__subtotal'));?></td></tr><tr class='basic'>
<td>Module Name</td><td><?=form_input(array('name' => 'salesorderline__modulename', 'value' => $salesorderline__modulename, 'id' => 'salesorderline__modulename'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_order_line_servicelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


