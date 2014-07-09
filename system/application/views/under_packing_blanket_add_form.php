<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#under_packing_blanketoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#under_packing_blanketform').click(function(){$('#under_packing_blanketform').ajaxForm(options);});
	
  });
  </script>

<h3>New under_packing_blanket</h3>

<p>
<div id="under_packing_blanketoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/under_packing_blanketadd/submit" id="under_packing_blanketform">

<table width="100%">

<tr class='basic'><td>Name *</td><td><?=form_input(array('name' => 'underpackingblanket__name', 'value' => $underpackingblanket__name, 'class' => 'basic', 'id' => 'underpackingblanket__name'));?></td></tr>
<tr class='basic'><td>Category</td><td><?=form_input(array('name' => 'underpackingblanket__category', 'value' => $underpackingblanket__category, 'class' => 'basic', 'id' => 'underpackingblanket__category'));?></td></tr>
<tr class='basic'><td>Color</td><td><?=form_input(array('name' => 'underpackingblanket__color', 'value' => $underpackingblanket__color, 'class' => 'basic', 'id' => 'underpackingblanket__color'));?></td></tr>
<tr class='dimensions'><td>AC</td><td><?=form_input(array('name' => 'underpackingblanket__ac', 'value' => $underpackingblanket__ac, 'class' => 'dimensions', 'id' => 'underpackingblanket__ac'));?></td></tr>
<tr class='dimensions'><td>AR</td><td><?=form_input(array('name' => 'underpackingblanket__ar', 'value' => $underpackingblanket__ar, 'class' => 'dimensions', 'id' => 'underpackingblanket__ar'));?></td></tr>
<tr class='dimensions'><td>Thickness</td><td><?=form_input(array('name' => 'underpackingblanket__thickness', 'value' => $underpackingblanket__thickness, 'class' => 'dimensions', 'id' => 'underpackingblanket__thickness'));?></td></tr>
<tr class='basic'><td>Minimum Quantity</td><td><?=form_input(array('name' => 'underpackingblanket__minquantity', 'value' => $underpackingblanket__minquantity, 'class' => 'basic', 'id' => 'underpackingblanket__minquantity'));?></td></tr>
<tr class='basic'><td>Maximum Quantity</td><td><?=form_input(array('name' => 'underpackingblanket__maxquantity', 'value' => $underpackingblanket__maxquantity, 'class' => 'basic', 'id' => 'underpackingblanket__maxquantity'));?></td></tr>
<tr class='basic'><td>Buffer 3 Months</td><td><?=form_input(array('name' => 'underpackingblanket__buffer3months', 'value' => $underpackingblanket__buffer3months, 'class' => 'basic', 'id' => 'underpackingblanket__buffer3months'));?></td></tr>
<tr class='basic'><td>Buy Uom</td><td><?=form_dropdown('underpackingblanket__buyuom_id', $uom_opt, $underpackingblanket__buyuom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Sell Uom</td><td><?=form_dropdown('underpackingblanket__selluom_id', $uom_opt, $underpackingblanket__selluom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Is Purchasable?</td><td><?=form_input(array('name' => 'underpackingblanket__purchaseable', 'value' => $underpackingblanket__purchaseable, 'class' => 'basic', 'id' => 'underpackingblanket__purchaseable'));?></td></tr>
<tr class='basic'><td>Is Sellable?</td><td><?=form_input(array('name' => 'underpackingblanket__sellable', 'value' => $underpackingblanket__sellable, 'class' => 'basic', 'id' => 'underpackingblanket__sellable'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/under_packing_blanketlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
