<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#move_order_between_warehouseoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#move_order_between_warehouseeditform').click(function(){$('#move_order_between_warehouseeditform').ajaxForm(options);});
	});
</script>

<h3>Edit move_order_between_warehouse</h3>

<p>
<div id="move_order_between_warehouseoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/move_order_between_warehouseedit/submit" id="move_order_between_warehouseeditform">

<?=form_hidden("move_order_between_warehouse_id", $move_order_between_warehouse_id);?>

<table width="100%">
<tr class='basic'>
<td>Order ID *</td><td><?=form_input(array('name' => 'porder__orderid', 'value' => $porder__orderid, 'id' => 'porder__orderid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#porder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date</td><td><?=form_input(array('name' => 'porder__date', 'value' => $porder__date, 'class' => 'date', 'id' => 'porder__date'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'porder__notes', 'value' => $porder__notes, 'id' => 'porder__notes'));?></td></tr><tr class='basic'>
<td>From Location</td><td><?=form_dropdown('porder__from_id', $contact_opt, $porder__from_id);?></td></tr><tr class='basic'>
<td>To Location</td><td><?=form_dropdown('porder__to_id', $contact_opt, $porder__to_id);?></td></tr><tr class='basic'>
<td>Order ID *</td><td><?=form_input(array('name' => 'porder__orderid', 'value' => $porder__orderid, 'id' => 'porder__orderid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#porder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date</td><td><?=form_input(array('name' => 'porder__date', 'value' => $porder__date, 'class' => 'date', 'id' => 'porder__date'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'porder__notes', 'value' => $porder__notes, 'id' => 'porder__notes'));?></td></tr><tr class='basic'>
<td>From Location</td><td><?=form_dropdown('porder__from_id', $contact_opt, $porder__from_id);?></td></tr><tr class='basic'>
<td>To Location</td><td><?=form_dropdown('porder__to_id', $contact_opt, $porder__to_id);?></td></tr><tr class='basic'>
<td>Details</td><td><?=form_input(array('name' => 'porder__', 'value' => $porder__, 'id' => 'porder__'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/move_order_between_warehouselist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>


