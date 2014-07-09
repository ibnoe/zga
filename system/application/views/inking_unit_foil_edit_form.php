<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#inking_unit_foiloutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#inking_unit_foileditform').click(function(){$('#inking_unit_foileditform').ajaxForm(options);});
	});
</script>

<h3>Edit inking_unit_foil</h3>

<p>
<div id="inking_unit_foiloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/inking_unit_foiledit/submit" id="inking_unit_foileditform">

<?=form_hidden("inking_unit_foil_id", $inking_unit_foil_id);?>

<table width="100%">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'inkingunitfoil__name', 'value' => $inkingunitfoil__name, 'id' => 'inkingunitfoil__name'));?></td></tr><tr class='basic'>
<td>Category</td><td><?=form_input(array('name' => 'inkingunitfoil__category', 'value' => $inkingunitfoil__category, 'id' => 'inkingunitfoil__category'));?></td></tr><tr class='basic'>
<td>Color</td><td><?=form_input(array('name' => 'inkingunitfoil__color', 'value' => $inkingunitfoil__color, 'id' => 'inkingunitfoil__color'));?></td></tr><tr class='dimensions'>
<td>AC</td><td><?=form_input(array('name' => 'inkingunitfoil__ac', 'value' => $inkingunitfoil__ac, 'id' => 'inkingunitfoil__ac'));?></td></tr><tr class='dimensions'>
<td>AR</td><td><?=form_input(array('name' => 'inkingunitfoil__ar', 'value' => $inkingunitfoil__ar, 'id' => 'inkingunitfoil__ar'));?></td></tr><tr class='dimensions'>
<td>Thickness</td><td><?=form_input(array('name' => 'inkingunitfoil__thickness', 'value' => $inkingunitfoil__thickness, 'id' => 'inkingunitfoil__thickness'));?></td></tr><tr class='basic'>
<td>Minimum Quantity</td><td><?=form_input(array('name' => 'inkingunitfoil__minquantity', 'value' => $inkingunitfoil__minquantity, 'id' => 'inkingunitfoil__minquantity'));?></td></tr><tr class='basic'>
<td>Maximum Quantity</td><td><?=form_input(array('name' => 'inkingunitfoil__maxquantity', 'value' => $inkingunitfoil__maxquantity, 'id' => 'inkingunitfoil__maxquantity'));?></td></tr><tr class='basic'>
<td>Buffer 3 Months</td><td><?=form_input(array('name' => 'inkingunitfoil__buffer3months', 'value' => $inkingunitfoil__buffer3months, 'id' => 'inkingunitfoil__buffer3months'));?></td></tr><tr class='basic'>
<td>Buy Uom</td><td><?=form_dropdown('inkingunitfoil__buyuom_id', $uom_opt, $inkingunitfoil__buyuom_id);?></td></tr><tr class='basic'>
<td>Sell Uom</td><td><?=form_dropdown('inkingunitfoil__selluom_id', $uom_opt, $inkingunitfoil__selluom_id);?></td></tr><tr class='basic'>
<td>Is Purchasable?</td><td><?=form_input(array('name' => 'inkingunitfoil__purchaseable', 'value' => $inkingunitfoil__purchaseable, 'id' => 'inkingunitfoil__purchaseable'));?></td></tr><tr class='basic'>
<td>Is Sellable?</td><td><?=form_input(array('name' => 'inkingunitfoil__sellable', 'value' => $inkingunitfoil__sellable, 'id' => 'inkingunitfoil__sellable'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/inking_unit_foillist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>


