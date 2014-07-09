<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#item_in_stockoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/item_in_stockview/index/' },
		}; 
		
		$('#item_in_stockform').click(function(){$('#item_in_stockform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Item In Stock</h3>

<p>
<div id="item_in_stockoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/item_in_stockadd/submit" id="item_in_stockform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Item ID *</td>
<td><?=form_input(array('name' => 'item__idstring', 'value' => $item__idstring, 'class' => 'basic', 'id' => 'item__idstring'));?></td></tr>
<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'item__name', 'value' => $item__name, 'class' => 'basic', 'id' => 'item__name'));?></td></tr>
<tr class='basic'>
<td>Minimum Quantity</td>
<td><?=form_input(array('name' => 'item__minquantity', 'value' => $item__minquantity, 'class' => 'basic', 'id' => 'item__minquantity'));?></td></tr>
<tr class='basic'>
<td>Maximum Quantity</td>
<td><?=form_input(array('name' => 'item__maxquantity', 'value' => $item__maxquantity, 'class' => 'basic', 'id' => 'item__maxquantity'));?></td></tr>
<tr class='brandnew'>
<td>Buffer 3 Months</td>
<td><?=form_input(array('name' => 'item__buffer3months', 'value' => $item__buffer3months, 'class' => 'brandnew', 'id' => 'item__buffer3months'));?></td></tr>
<tr class='basic'>
<td>Is Purchasable?</td>
<td><input type='checkbox' name='item__purchaseable' value='1'></input></td></tr>
<tr class='basic'>
<td>Is Sellable?</td>
<td><input type='checkbox' name='item__sellable' value='1'></input></td></tr>
<tr class='basic'>
<td>Is Manufactured?</td>
<td><input type='checkbox' name='item__manufactured' value='1'></input></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/item_in_stocklist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
