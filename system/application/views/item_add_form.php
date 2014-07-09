<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#itemoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/itemview/index/' },
		}; 
		
		$('#itemform').click(function(){$('#itemform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Item</h3>

<p>
<div id="itemoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/itemadd/submit" id="itemform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Item ID *</td>
<td><?=form_input(array('name' => 'item__idstring', 'value' => $item__idstring, 'class' => 'basic', 'id' => 'item__idstring'));?></td></tr>
<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'item__name', 'value' => $item__name, 'class' => 'basic', 'id' => 'item__name'));?></td></tr>
<tr class='basic'>
<td>Category *</td>
<td><?=form_dropdown('item__itemcategory_id', array(), '', 'class="basic"');?>&nbsp;<input id='item__itemcategory_id_lookup' type='button' value='Lookup'></input></td><div id='item__itemcategory_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__itemcategory_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/item_categorylookup', function(data) { $('#item__itemcategory_id_dialog').html(data);$('#item__itemcategory_id_dialog a').attr('disabled', 'disabled');$('#item__itemcategory_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__itemcategory_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=item__itemcategory_id]').val(lines[0]);if (typeof window.item_selected_itemcategory_id == 'function') { item_selected_itemcategory_id("<?=site_url();?>"); }}$('#item__itemcategory_id_dialog').dialog('close');});$('#item__itemcategory_id_lookup').button().click(function() {$('#item__itemcategory_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Account Persediaan *</td>
<td><?=form_dropdown('item__persediaan_coa_id', array(), '', 'class="basic"');?>&nbsp;<input id='item__persediaan_coa_id_lookup' type='button' value='Lookup'></input></td><div id='item__persediaan_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__persediaan_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/inventory_accountslookup', function(data) { $('#item__persediaan_coa_id_dialog').html(data);$('#item__persediaan_coa_id_dialog a').attr('disabled', 'disabled');$('#item__persediaan_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__persediaan_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=item__persediaan_coa_id]').val(lines[0]);if (typeof window.item_selected_persediaan_coa_id == 'function') { item_selected_persediaan_coa_id("<?=site_url();?>"); }}$('#item__persediaan_coa_id_dialog').dialog('close');});$('#item__persediaan_coa_id_lookup').button().click(function() {$('#item__persediaan_coa_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Account HPP *</td>
<td><?=form_dropdown('item__hpp_coa_id', array(), '', 'class="basic"');?>&nbsp;<input id='item__hpp_coa_id_lookup' type='button' value='Lookup'></input></td><div id='item__hpp_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__hpp_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#item__hpp_coa_id_dialog').html(data);$('#item__hpp_coa_id_dialog a').attr('disabled', 'disabled');$('#item__hpp_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__hpp_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=item__hpp_coa_id]').val(lines[0]);if (typeof window.item_selected_hpp_coa_id == 'function') { item_selected_hpp_coa_id("<?=site_url();?>"); }}$('#item__hpp_coa_id_dialog').dialog('close');});$('#item__hpp_coa_id_lookup').button().click(function() {$('#item__hpp_coa_id_dialog').dialog('open');});});});</script></tr>
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
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/itemlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
