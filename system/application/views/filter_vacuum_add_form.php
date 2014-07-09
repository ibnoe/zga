<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#filter_vacuumoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#filter_vacuumform').click(function(){$('#filter_vacuumform').ajaxForm(options);});
	
  });
  </script>

<h3>New filter_vacuum</h3>

<p>
<div id="filter_vacuumoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/filter_vacuumadd/submit" id="filter_vacuumform">

<table width="100%">

<tr class='basic'><td>Name *</td><td><?=form_input(array('name' => 'filtervacuum__name', 'value' => $filtervacuum__name, 'class' => 'basic', 'id' => 'filtervacuum__name'));?></td></tr>
<tr class='basic'><td>Category</td><td><?=form_input(array('name' => 'filtervacuum__subcategory', 'value' => $filtervacuum__subcategory, 'class' => 'basic', 'id' => 'filtervacuum__subcategory'));?></td></tr>
<tr class='basic'><td>Minimum Quantity</td><td><?=form_input(array('name' => 'filtervacuum__minquantity', 'value' => $filtervacuum__minquantity, 'class' => 'basic', 'id' => 'filtervacuum__minquantity'));?></td></tr>
<tr class='basic'><td>Maximum Quantity</td><td><?=form_input(array('name' => 'filtervacuum__maxquantity', 'value' => $filtervacuum__maxquantity, 'class' => 'basic', 'id' => 'filtervacuum__maxquantity'));?></td></tr>
<tr class='basic'><td>Buffer 3 Months</td><td><?=form_input(array('name' => 'filtervacuum__buffer3months', 'value' => $filtervacuum__buffer3months, 'class' => 'basic', 'id' => 'filtervacuum__buffer3months'));?></td></tr>
<tr class='basic'><td>Buy Uom</td><td><?=form_dropdown('filtervacuum__buyuom_id', $uom_opt, $filtervacuum__buyuom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Sell Uom</td><td><?=form_dropdown('filtervacuum__selluom_id', $uom_opt, $filtervacuum__selluom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Is Purchasable?</td><td><?=form_input(array('name' => 'filtervacuum__purchaseable', 'value' => $filtervacuum__purchaseable, 'class' => 'basic', 'id' => 'filtervacuum__purchaseable'));?></td></tr>
<tr class='basic'><td>Is Sellable?</td><td><?=form_input(array('name' => 'filtervacuum__sellable', 'value' => $filtervacuum__sellable, 'class' => 'basic', 'id' => 'filtervacuum__sellable'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/filter_vacuumlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
