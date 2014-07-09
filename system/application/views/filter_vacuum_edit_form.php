<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#filter_vacuumoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#filter_vacuumeditform').click(function(){$('#filter_vacuumeditform').ajaxForm(options);});
	});
</script>

<h3>Edit filter_vacuum</h3>

<p>
<div id="filter_vacuumoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/filter_vacuumedit/submit" id="filter_vacuumeditform">

<?=form_hidden("filter_vacuum_id", $filter_vacuum_id);?>

<table width="100%">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'filtervacuum__name', 'value' => $filtervacuum__name, 'id' => 'filtervacuum__name'));?></td></tr><tr class='basic'>
<td>Category</td><td><?=form_input(array('name' => 'filtervacuum__subcategory', 'value' => $filtervacuum__subcategory, 'id' => 'filtervacuum__subcategory'));?></td></tr><tr class='basic'>
<td>Minimum Quantity</td><td><?=form_input(array('name' => 'filtervacuum__minquantity', 'value' => $filtervacuum__minquantity, 'id' => 'filtervacuum__minquantity'));?></td></tr><tr class='basic'>
<td>Maximum Quantity</td><td><?=form_input(array('name' => 'filtervacuum__maxquantity', 'value' => $filtervacuum__maxquantity, 'id' => 'filtervacuum__maxquantity'));?></td></tr><tr class='basic'>
<td>Buffer 3 Months</td><td><?=form_input(array('name' => 'filtervacuum__buffer3months', 'value' => $filtervacuum__buffer3months, 'id' => 'filtervacuum__buffer3months'));?></td></tr><tr class='basic'>
<td>Buy Uom</td><td><?=form_dropdown('filtervacuum__buyuom_id', $uom_opt, $filtervacuum__buyuom_id);?></td></tr><tr class='basic'>
<td>Sell Uom</td><td><?=form_dropdown('filtervacuum__selluom_id', $uom_opt, $filtervacuum__selluom_id);?></td></tr><tr class='basic'>
<td>Is Purchasable?</td><td><?=form_input(array('name' => 'filtervacuum__purchaseable', 'value' => $filtervacuum__purchaseable, 'id' => 'filtervacuum__purchaseable'));?></td></tr><tr class='basic'>
<td>Is Sellable?</td><td><?=form_input(array('name' => 'filtervacuum__sellable', 'value' => $filtervacuum__sellable, 'id' => 'filtervacuum__sellable'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/filter_vacuumlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>


