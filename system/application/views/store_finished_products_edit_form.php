<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#store_finished_productsoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#store_finished_productseditform').click(function(){$('#store_finished_productseditform').ajaxForm(options);});
	});
</script>

<h3>Edit store_finished_products</h3>

<p>
<div id="store_finished_productsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/store_finished_productsedit/submit" id="store_finished_productseditform">

<?=form_hidden("store_finished_products_id", $store_finished_products_id);?>

<table width="100%">
<tr class='basic'>
<td>Order ID *</td><td><?=form_input(array('name' => 'morder__orderid', 'value' => $morder__orderid, 'id' => 'morder__orderid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#morder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date</td><td><?=form_input(array('name' => 'morder__date', 'value' => $morder__date, 'class' => 'date', 'id' => 'morder__date'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'morder__notes', 'value' => $morder__notes, 'id' => 'morder__notes'));?></td></tr><tr class='basic'>
<td>From Location</td><td><?=form_dropdown('morder__from_id', $contact_opt, $morder__from_id);?></td></tr><tr class='basic'>
<td>To Location</td><td><?=form_dropdown('morder__to_id', $contact_opt, $morder__to_id);?></td></tr><tr class='basic'>
<td>Order ID *</td><td><?=form_input(array('name' => 'morder__orderid', 'value' => $morder__orderid, 'id' => 'morder__orderid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#morder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date</td><td><?=form_input(array('name' => 'morder__date', 'value' => $morder__date, 'class' => 'date', 'id' => 'morder__date'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'morder__notes', 'value' => $morder__notes, 'id' => 'morder__notes'));?></td></tr><tr class='basic'>
<td>From Location</td><td><?=form_dropdown('morder__from_id', $contact_opt, $morder__from_id);?></td></tr><tr class='basic'>
<td>To Location</td><td><?=form_dropdown('morder__to_id', $contact_opt, $morder__to_id);?></td></tr><tr class='basic'>
<td>Details</td><td><?=form_input(array('name' => 'morder__', 'value' => $morder__, 'id' => 'morder__'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/store_finished_productslist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>


