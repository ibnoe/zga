<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#under_packing_blanketoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#under_packing_blanketeditform').click(function(){$('#under_packing_blanketeditform').ajaxForm(options);});
	});
</script>

<h3>Edit under_packing_blanket</h3>

<p>
<div id="under_packing_blanketoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/under_packing_blanketedit/submit" id="under_packing_blanketeditform">

<?=form_hidden("under_packing_blanket_id", $under_packing_blanket_id);?>

<table width="100%">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'underpackingblanket__name', 'value' => $underpackingblanket__name, 'id' => 'underpackingblanket__name'));?></td></tr><tr class='basic'>
<td>Category</td><td><?=form_input(array('name' => 'underpackingblanket__category', 'value' => $underpackingblanket__category, 'id' => 'underpackingblanket__category'));?></td></tr><tr class='basic'>
<td>Color</td><td><?=form_input(array('name' => 'underpackingblanket__color', 'value' => $underpackingblanket__color, 'id' => 'underpackingblanket__color'));?></td></tr><tr class='dimensions'>
<td>AC</td><td><?=form_input(array('name' => 'underpackingblanket__ac', 'value' => $underpackingblanket__ac, 'id' => 'underpackingblanket__ac'));?></td></tr><tr class='dimensions'>
<td>AR</td><td><?=form_input(array('name' => 'underpackingblanket__ar', 'value' => $underpackingblanket__ar, 'id' => 'underpackingblanket__ar'));?></td></tr><tr class='dimensions'>
<td>Thickness</td><td><?=form_input(array('name' => 'underpackingblanket__thickness', 'value' => $underpackingblanket__thickness, 'id' => 'underpackingblanket__thickness'));?></td></tr><tr class='basic'>
<td>Minimum Quantity</td><td><?=form_input(array('name' => 'underpackingblanket__minquantity', 'value' => $underpackingblanket__minquantity, 'id' => 'underpackingblanket__minquantity'));?></td></tr><tr class='basic'>
<td>Maximum Quantity</td><td><?=form_input(array('name' => 'underpackingblanket__maxquantity', 'value' => $underpackingblanket__maxquantity, 'id' => 'underpackingblanket__maxquantity'));?></td></tr><tr class='basic'>
<td>Buffer 3 Months</td><td><?=form_input(array('name' => 'underpackingblanket__buffer3months', 'value' => $underpackingblanket__buffer3months, 'id' => 'underpackingblanket__buffer3months'));?></td></tr><tr class='basic'>
<td>Buy Uom</td><td><?=form_dropdown('underpackingblanket__buyuom_id', $uom_opt, $underpackingblanket__buyuom_id);?></td></tr><tr class='basic'>
<td>Sell Uom</td><td><?=form_dropdown('underpackingblanket__selluom_id', $uom_opt, $underpackingblanket__selluom_id);?></td></tr><tr class='basic'>
<td>Is Purchasable?</td><td><?=form_input(array('name' => 'underpackingblanket__purchaseable', 'value' => $underpackingblanket__purchaseable, 'id' => 'underpackingblanket__purchaseable'));?></td></tr><tr class='basic'>
<td>Is Sellable?</td><td><?=form_input(array('name' => 'underpackingblanket__sellable', 'value' => $underpackingblanket__sellable, 'id' => 'underpackingblanket__sellable'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/under_packing_blanketlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>


