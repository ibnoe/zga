<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#blanketoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#blanketeditform').click(function(){$('#blanketeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Blanket</h3>

<p>
<div id="blanketoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/blanketedit/submit" id="blanketeditform" class="editform">

<?=form_hidden("blanket_id", $blanket_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Item ID *</td><td><?=form_input(array('name' => 'item__idstring', 'value' => $item__idstring, 'id' => 'item__idstring'));?></td></tr><tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'item__name', 'value' => $item__name, 'id' => 'item__name'));?></td></tr><tr class='basic'>
<td>Pallete No</td><td><?=form_input(array('name' => 'item__palleteno', 'value' => $item__palleteno, 'id' => 'item__palleteno'));?></td></tr><tr class='basic'>
<td>Code Baru</td><td><?=form_input(array('name' => 'item__codebaru', 'value' => $item__codebaru, 'id' => 'item__codebaru'));?></td></tr><tr class='basic'>
<td>Press & Type</td><td><?=form_input(array('name' => 'item__pressntype', 'value' => $item__pressntype, 'id' => 'item__pressntype'));?></td></tr><tr class='dimensions'>
<td>AC</td><td><?=form_input(array('name' => 'item__ac', 'value' => $item__ac, 'id' => 'item__ac'));?></td></tr><tr class='dimensions'>
<td>AR</td><td><?=form_input(array('name' => 'item__ar', 'value' => $item__ar, 'id' => 'item__ar'));?></td></tr><tr class='dimensions'>
<td>Thickness</td><td><?=form_input(array('name' => 'item__thickness', 'value' => $item__thickness, 'id' => 'item__thickness'));?></td></tr><tr class='basic'>
<td>Bar Type</td><td><?=form_input(array('name' => 'item__bartype', 'value' => $item__bartype, 'id' => 'item__bartype'));?></td></tr><tr class='basic'>
<td>Moving Speed</td><td><?=form_input(array('name' => 'item__movingspeed', 'value' => $item__movingspeed, 'id' => 'item__movingspeed'));?></td></tr><tr class='basic'>
<td>Minimum Stock</td><td><?=form_input(array('name' => 'item__minquantity', 'value' => $item__minquantity, 'id' => 'item__minquantity'));?></td></tr><tr class='basic'>
<td>Maximum Stock</td><td><?=form_input(array('name' => 'item__maxquantity', 'value' => $item__maxquantity, 'id' => 'item__maxquantity'));?></td></tr><tr class='basic'>
<td>Converting Place</td><td><?=form_input(array('name' => 'item__barorigin', 'value' => $item__barorigin, 'id' => 'item__barorigin'));?></td></tr><tr class='basic'>
<td>Bar/Non Bar</td><td><input type='checkbox' name='item__barnonbar' value='1' <?php if ($item__barnonbar > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'>
<td>Buffer 3 Months</td><td><?=form_input(array('name' => 'item__buffer3months', 'value' => $item__buffer3months, 'id' => 'item__buffer3months'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'>
<td>Is Purchasable?</td><td><input type='checkbox' name='item__purchaseable' value='1' <?php if ($item__purchaseable > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'>
<td>Is Sellable?</td><td><input type='checkbox' name='item__sellable' value='1' <?php if ($item__sellable > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'>
<td>Is Manufactured?</td><td><input type='checkbox' name='item__manufactured' value='1' <?php if ($item__manufactured > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'>
<td>Account Persediaan *</td><td><?=form_dropdown('item__persediaan_coa_id', $coa_opt, $item__persediaan_coa_id);?>&nbsp;<input id='item__persediaan_coa_id_lookup' type='button' value='Lookup'></input></td><div id='item__persediaan_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__persediaan_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/inventory_accountslookup', function(data) { $('#item__persediaan_coa_id_dialog').html(data);$('#item__persediaan_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__persediaan_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=item__persediaan_coa_id]').val(lines[0]);if (typeof window.blanket_selected_persediaan_coa_id == 'function') { blanket_selected_persediaan_coa_id("<?=site_url();?>"); }}$('#item__persediaan_coa_id_dialog').dialog('close');});$('#item__persediaan_coa_id_lookup').button().click(function() {$('#item__persediaan_coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Account HPP *</td><td><?=form_dropdown('item__hpp_coa_id', $coa_opt, $item__hpp_coa_id);?>&nbsp;<input id='item__hpp_coa_id_lookup' type='button' value='Lookup'></input></td><div id='item__hpp_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__hpp_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#item__hpp_coa_id_dialog').html(data);$('#item__hpp_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__hpp_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=item__hpp_coa_id]').val(lines[0]);if (typeof window.blanket_selected_hpp_coa_id == 'function') { blanket_selected_hpp_coa_id("<?=site_url();?>"); }}$('#item__hpp_coa_id_dialog').dialog('close');});$('#item__hpp_coa_id_lookup').button().click(function() {$('#item__hpp_coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/blanketlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


