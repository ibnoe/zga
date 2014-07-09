<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#other_itemoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#other_itemform').click(function(){$('#other_itemform').ajaxForm(options);});
	
  });
  </script>

<h3>New other_item</h3>

<p>
<div id="other_itemoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/other_itemadd/submit" id="other_itemform">

<table width="100%">

<tr class='basic'><td>Name *</td><td><?=form_input(array('name' => 'item__name', 'value' => $item__name, 'class' => 'basic', 'id' => 'item__name'));?></td></tr>
<tr class='basic'><td>Item Type</td><td><?=form_input(array('name' => 'item__type', 'value' => $item__type, 'class' => 'basic', 'id' => 'item__type'));?></td></tr>
<tr class='basic'><td>Buy Uom</td><td><?=form_dropdown('item__buyuom_id', $uom_opt, $item__buyuom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Sell Uom</td><td><?=form_dropdown('item__selluom_id', $uom_opt, $item__selluom_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Is Purchasable?</td><td><?=form_input(array('name' => 'item__purchaseable', 'value' => $item__purchaseable, 'class' => 'basic', 'id' => 'item__purchaseable'));?></td></tr>
<tr class='basic'><td>Is Sellable?</td><td><?=form_input(array('name' => 'item__sellable', 'value' => $item__sellable, 'class' => 'basic', 'id' => 'item__sellable'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/other_itemlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
