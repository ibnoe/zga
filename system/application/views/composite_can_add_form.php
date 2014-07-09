<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#composite_canoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#composite_canform').click(function(){$('#composite_canform').ajaxForm(options);});
	
  });
  </script>

<h3>New composite_can</h3>

<p>
<div id="composite_canoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/composite_canadd/submit" id="composite_canform">

<table width="100%">

<tr class='basic'><td>Name *</td><td><?=form_input(array('name' => 'composite__name', 'value' => $composite__name, 'class' => 'basic', 'id' => 'composite__name'));?></td></tr>
<tr class='basic'><td>Diameter</td><td><?=form_input(array('name' => 'composite__diameter', 'value' => $composite__diameter, 'class' => 'basic', 'id' => 'composite__diameter'));?></td></tr>
<tr class='basic'><td>Length</td><td><?=form_input(array('name' => 'composite__length', 'value' => $composite__length, 'class' => 'basic', 'id' => 'composite__length'));?></td></tr>
<tr class='basic'><td>Minimum Quantity</td><td><?=form_input(array('name' => 'composite__minquantity', 'value' => $composite__minquantity, 'class' => 'basic', 'id' => 'composite__minquantity'));?></td></tr>
<tr class='basic'><td>Maximum Quantity</td><td><?=form_input(array('name' => 'composite__maxquantity', 'value' => $composite__maxquantity, 'class' => 'basic', 'id' => 'composite__maxquantity'));?></td></tr>
<tr class='basic'><td>Buffer 3 Months</td><td><?=form_input(array('name' => 'composite__buffer3months', 'value' => $composite__buffer3months, 'class' => 'basic', 'id' => 'composite__buffer3months'));?></td></tr>
<tr class='basic'><td>Buy Uom</td><td><?=form_dropdown('composite__buyuom_id', $uom_opt, $composite__buyuom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Sell Uom</td><td><?=form_dropdown('composite__selluom_id', $uom_opt, $composite__selluom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Is Purchasable?</td><td><?=form_input(array('name' => 'composite__purchaseable', 'value' => $composite__purchaseable, 'class' => 'basic', 'id' => 'composite__purchaseable'));?></td></tr>
<tr class='basic'><td>Is Sellable?</td><td><?=form_input(array('name' => 'composite__sellable', 'value' => $composite__sellable, 'class' => 'basic', 'id' => 'composite__sellable'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/composite_canlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
