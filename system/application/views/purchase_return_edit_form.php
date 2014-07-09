<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_returnoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_returneditform').click(function(){$('#purchase_returneditform').ajaxForm(options);});
	});
</script>

<h3>Edit purchase_return</h3>

<p>
<div id="purchase_returnoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_returnedit/submit" id="purchase_returneditform">

<?=form_hidden("purchase_return_id", $purchase_return_id);?>

<table width="100%">
<tr class='basic'>
<td>Order ID *</td><td><?=form_input(array('name' => 'preturn__orderid', 'value' => $preturn__orderid, 'id' => 'preturn__orderid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#preturn__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date</td><td><?=form_input(array('name' => 'preturn__date', 'value' => $preturn__date, 'class' => 'date', 'id' => 'preturn__date'));?></td></tr><tr class='basic'>
<td>Purchase Order</td><td><?=form_dropdown('preturn__porder_id', $porder_opt, $preturn__porder_id);?></td></tr><tr class='basic'>
<td>Return To Location *</td><td><?=form_dropdown('preturn__to_id', $contact_opt, $preturn__to_id);?></td></tr><tr class='basic'>
<td>Order ID *</td><td><?=form_input(array('name' => 'preturn__orderid', 'value' => $preturn__orderid, 'id' => 'preturn__orderid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#preturn__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date</td><td><?=form_input(array('name' => 'preturn__date', 'value' => $preturn__date, 'class' => 'date', 'id' => 'preturn__date'));?></td></tr><tr class='basic'>
<td>Purchase Order</td><td><?=form_dropdown('preturn__porder_id', $porder_opt, $preturn__porder_id);?></td></tr><tr class='basic'>
<td>Return To Location *</td><td><?=form_dropdown('preturn__to_id', $contact_opt, $preturn__to_id);?></td></tr><tr class='basic'>
<td>Details</td><td><?=form_input(array('name' => 'preturn__', 'value' => $preturn__, 'id' => 'preturn__'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_returnlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>


