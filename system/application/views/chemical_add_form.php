<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#chemicaloutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/chemicalview/index/' },
		}; 
		
		$('#chemicalform').click(function(){$('#chemicalform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Chemical</h3>

<p>
<div id="chemicaloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/chemicaladd/submit" id="chemicalform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Item ID *</td>
<td><?=form_input(array('name' => 'item__idstring', 'value' => $item__idstring, 'class' => 'basic', 'id' => 'item__idstring'));?></td></tr>
<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'item__name', 'value' => $item__name, 'class' => 'basic', 'id' => 'item__name'));?></td></tr>
<tr class='basic'>
<td>Product Code</td>
<td><?=form_input(array('name' => 'item__chemicalcode', 'value' => $item__chemicalcode, 'class' => 'basic', 'id' => 'item__chemicalcode'));?></td></tr>
<tr class='basic'>
<td>Product Classification</td>
<td><?=form_input(array('name' => 'item__chemicaltype', 'value' => $item__chemicaltype, 'class' => 'basic', 'id' => 'item__chemicaltype'));?></td></tr>
<tr class='basic'>
<td>Packing Size</td>
<td><?=form_input(array('name' => 'item__packingsize', 'value' => $item__packingsize, 'class' => 'basic', 'id' => 'item__packingsize'));?></td></tr>
<tr class='basic'>
<?=form_hidden('item__intitemtype', $item__intitemtype);?></tr>
<tr class='basic'>
<?=form_hidden('item__itemcategory_id', $item__itemcategory_id);?></tr>
<tr class='basic'>
<td>Is Purchasable?</td>
<td><input type='checkbox' name='item__purchaseable' value='1'></input></td></tr>
<tr class='basic'>
<td>Is Sellable?</td>
<td><input type='checkbox' name='item__sellable' value='1'></input></td></tr>
<tr class='basic'>
<td>Is Manufactured?</td>
<td><input type='checkbox' name='item__manufactured' value='1'></input></td></tr>
<tr class='basic'>
<td>Account Persediaan *</td>
<td><?=form_dropdown('item__persediaan_coa_id', array(), '', 'class="basic"');?>&nbsp;<input id='item__persediaan_coa_id_lookup' type='button' value='Lookup'></input></td><div id='item__persediaan_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__persediaan_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/inventory_accountslookup', function(data) { $('#item__persediaan_coa_id_dialog').html(data);$('#item__persediaan_coa_id_dialog a').attr('disabled', 'disabled');$('#item__persediaan_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__persediaan_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=item__persediaan_coa_id]').val(lines[0]);if (typeof window.chemical_selected_persediaan_coa_id == 'function') { chemical_selected_persediaan_coa_id("<?=site_url();?>"); }}$('#item__persediaan_coa_id_dialog').dialog('close');});$('#item__persediaan_coa_id_lookup').button().click(function() {$('#item__persediaan_coa_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Account HPP *</td>
<td><?=form_dropdown('item__hpp_coa_id', array(), '', 'class="basic"');?>&nbsp;<input id='item__hpp_coa_id_lookup' type='button' value='Lookup'></input></td><div id='item__hpp_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__hpp_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#item__hpp_coa_id_dialog').html(data);$('#item__hpp_coa_id_dialog a').attr('disabled', 'disabled');$('#item__hpp_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__hpp_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=item__hpp_coa_id]').val(lines[0]);if (typeof window.chemical_selected_hpp_coa_id == 'function') { chemical_selected_hpp_coa_id("<?=site_url();?>"); }}$('#item__hpp_coa_id_dialog').dialog('close');});$('#item__hpp_coa_id_lookup').button().click(function() {$('#item__hpp_coa_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/chemicallist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
