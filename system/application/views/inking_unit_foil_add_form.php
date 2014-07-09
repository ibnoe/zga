<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#inking_unit_foiloutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#inking_unit_foilform').click(function(){$('#inking_unit_foilform').ajaxForm(options);});
	
  });
  </script>

<h3>New inking_unit_foil</h3>

<p>
<div id="inking_unit_foiloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/inking_unit_foiladd/submit" id="inking_unit_foilform">

<table width="100%">

<tr class='basic'><td>Name *</td><td><?=form_input(array('name' => 'inkingunitfoil__name', 'value' => $inkingunitfoil__name, 'class' => 'basic', 'id' => 'inkingunitfoil__name'));?></td></tr>
<tr class='basic'><td>Category</td><td><?=form_input(array('name' => 'inkingunitfoil__category', 'value' => $inkingunitfoil__category, 'class' => 'basic', 'id' => 'inkingunitfoil__category'));?></td></tr>
<tr class='basic'><td>Color</td><td><?=form_input(array('name' => 'inkingunitfoil__color', 'value' => $inkingunitfoil__color, 'class' => 'basic', 'id' => 'inkingunitfoil__color'));?></td></tr>
<tr class='dimensions'><td>AC</td><td><?=form_input(array('name' => 'inkingunitfoil__ac', 'value' => $inkingunitfoil__ac, 'class' => 'dimensions', 'id' => 'inkingunitfoil__ac'));?></td></tr>
<tr class='dimensions'><td>AR</td><td><?=form_input(array('name' => 'inkingunitfoil__ar', 'value' => $inkingunitfoil__ar, 'class' => 'dimensions', 'id' => 'inkingunitfoil__ar'));?></td></tr>
<tr class='dimensions'><td>Thickness</td><td><?=form_input(array('name' => 'inkingunitfoil__thickness', 'value' => $inkingunitfoil__thickness, 'class' => 'dimensions', 'id' => 'inkingunitfoil__thickness'));?></td></tr>
<tr class='basic'><td>Minimum Quantity</td><td><?=form_input(array('name' => 'inkingunitfoil__minquantity', 'value' => $inkingunitfoil__minquantity, 'class' => 'basic', 'id' => 'inkingunitfoil__minquantity'));?></td></tr>
<tr class='basic'><td>Maximum Quantity</td><td><?=form_input(array('name' => 'inkingunitfoil__maxquantity', 'value' => $inkingunitfoil__maxquantity, 'class' => 'basic', 'id' => 'inkingunitfoil__maxquantity'));?></td></tr>
<tr class='basic'><td>Buffer 3 Months</td><td><?=form_input(array('name' => 'inkingunitfoil__buffer3months', 'value' => $inkingunitfoil__buffer3months, 'class' => 'basic', 'id' => 'inkingunitfoil__buffer3months'));?></td></tr>
<tr class='basic'><td>Buy Uom</td><td><?=form_dropdown('inkingunitfoil__buyuom_id', $uom_opt, $inkingunitfoil__buyuom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Sell Uom</td><td><?=form_dropdown('inkingunitfoil__selluom_id', $uom_opt, $inkingunitfoil__selluom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Is Purchasable?</td><td><?=form_input(array('name' => 'inkingunitfoil__purchaseable', 'value' => $inkingunitfoil__purchaseable, 'class' => 'basic', 'id' => 'inkingunitfoil__purchaseable'));?></td></tr>
<tr class='basic'><td>Is Sellable?</td><td><?=form_input(array('name' => 'inkingunitfoil__sellable', 'value' => $inkingunitfoil__sellable, 'class' => 'basic', 'id' => 'inkingunitfoil__sellable'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/inking_unit_foillist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
