<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#accessoriesoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#accessorieseditform').click(function(){$('#accessorieseditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Accessories</h3>

<p>
<div id="accessoriesoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/accessoriesedit/submit" id="accessorieseditform" class="editform">

<?=form_hidden("accessories_id", $accessories_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Item ID *</td><td><?=form_input(array('name' => 'item__idstring', 'value' => $item__idstring, 'id' => 'item__idstring'));?></td></tr><tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'item__name', 'value' => $item__name, 'id' => 'item__name'));?></td></tr><tr class='basic'>
<td>Category</td><td><?=form_input(array('name' => 'item__subcategory', 'value' => $item__subcategory, 'id' => 'item__subcategory'));?></td></tr><tr class='basic'>
<td>Brand</td><td><?=form_input(array('name' => 'item__brand', 'value' => $item__brand, 'id' => 'item__brand'));?></td></tr><tr class='basic'>
<td>Minimum Quantity</td><td><?=form_input(array('name' => 'item__minquantity', 'value' => $item__minquantity, 'id' => 'item__minquantity'));?></td></tr><tr class='basic'>
<td>Maximum Quantity</td><td><?=form_input(array('name' => 'item__maxquantity', 'value' => $item__maxquantity, 'id' => 'item__maxquantity'));?></td></tr><tr class='basic'>
<td>Buffer 3 Months</td><td><?=form_input(array('name' => 'item__buffer3months', 'value' => $item__buffer3months, 'id' => 'item__buffer3months'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'>
<td>Is Purchasable?</td><td><input type='checkbox' name='item__purchaseable' value='1' <?php if ($item__purchaseable > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'>
<td>Is Sellable?</td><td><input type='checkbox' name='item__sellable' value='1' <?php if ($item__sellable > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'>
<td>Is Manufactured?</td><td><input type='checkbox' name='item__manufactured' value='1' <?php if ($item__manufactured > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'>
<td>Account Persediaan *</td><td><?=form_dropdown('item__persediaan_coa_id', $coa_opt, $item__persediaan_coa_id);?>&nbsp;<input id='item__persediaan_coa_id_lookup' type='button' value='Lookup'></input></td><div id='item__persediaan_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__persediaan_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/inventory_accountslookup', function(data) { $('#item__persediaan_coa_id_dialog').html(data);$('#item__persediaan_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__persediaan_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=item__persediaan_coa_id]').val(lines[0]);if (typeof window.accessories_selected_persediaan_coa_id == 'function') { accessories_selected_persediaan_coa_id("<?=site_url();?>"); }}$('#item__persediaan_coa_id_dialog').dialog('close');});$('#item__persediaan_coa_id_lookup').button().click(function() {$('#item__persediaan_coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Account HPP *</td><td><?=form_dropdown('item__hpp_coa_id', $coa_opt, $item__hpp_coa_id);?>&nbsp;<input id='item__hpp_coa_id_lookup' type='button' value='Lookup'></input></td><div id='item__hpp_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__hpp_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#item__hpp_coa_id_dialog').html(data);$('#item__hpp_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__hpp_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=item__hpp_coa_id]').val(lines[0]);if (typeof window.accessories_selected_hpp_coa_id == 'function') { accessories_selected_hpp_coa_id("<?=site_url();?>"); }}$('#item__hpp_coa_id_dialog').dialog('close');});$('#item__hpp_coa_id_lookup').button().click(function() {$('#item__hpp_coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/accessorieslist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


