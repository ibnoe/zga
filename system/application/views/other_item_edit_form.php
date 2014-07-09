<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#other_itemoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#other_itemeditform').click(function(){$('#other_itemeditform').ajaxForm(options);});
	});
</script>

<h3>Edit other_item</h3>

<p>
<div id="other_itemoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/other_itemedit/submit" id="other_itemeditform">

<?=form_hidden("other_item_id", $other_item_id);?>

<table width="100%">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'item__name', 'value' => $item__name, 'id' => 'item__name'));?></td></tr><tr class='basic'>
<td>Item Type</td><td><?=form_input(array('name' => 'item__type', 'value' => $item__type, 'id' => 'item__type'));?></td></tr><tr class='basic'>
<td>Buy Uom</td><td><?=form_dropdown('item__buyuom_id', $uom_opt, $item__buyuom_id);?></td></tr><tr class='basic'>
<td>Sell Uom</td><td><?=form_dropdown('item__selluom_id', $uom_opt, $item__selluom_id);?></td></tr><tr class='basic'>
<td>Is Purchasable?</td><td><?=form_input(array('name' => 'item__purchaseable', 'value' => $item__purchaseable, 'id' => 'item__purchaseable'));?></td></tr><tr class='basic'>
<td>Is Sellable?</td><td><?=form_input(array('name' => 'item__sellable', 'value' => $item__sellable, 'id' => 'item__sellable'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/other_itemlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>


