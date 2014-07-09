<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#chemical_manufacturing_orderoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#chemical_manufacturing_ordereditform').click(function(){$('#chemical_manufacturing_ordereditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Chemical Manufacturing Order</h3>

<p>
<div id="chemical_manufacturing_orderoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/chemical_manufacturing_orderedit/submit" id="chemical_manufacturing_ordereditform" class="editform">

<?=form_hidden("chemical_manufacturing_order_id", $chemical_manufacturing_order_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'manufacturingorder__idstring', 'value' => $manufacturingorder__idstring, 'id' => 'manufacturingorder__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#manufacturingorder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'manufacturingorder__date', 'value' => $manufacturingorder__date, 'class' => 'date', 'id' => 'manufacturingorder__date'));?></td></tr><tr class='basic'>
<td>Penambahan Stock Chemical *</td><td><?=form_dropdown('manufacturingorder__penambahanstockchemical_id', $penambahanstockchemical_opt, $manufacturingorder__penambahanstockchemical_id);?>&nbsp;<input id='manufacturingorder__penambahanstockchemical_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingorder__penambahanstockchemical_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingorder__penambahanstockchemical_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/penambahan_stock_chemicallookup', function(data) { $('#manufacturingorder__penambahanstockchemical_id_dialog').html(data);$('#manufacturingorder__penambahanstockchemical_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingorder__penambahanstockchemical_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=manufacturingorder__penambahanstockchemical_id]').val(lines[0]);if (typeof window.chemical_manufacturing_order_selected_penambahanstockchemical_id == 'function') { chemical_manufacturing_order_selected_penambahanstockchemical_id("<?=site_url();?>"); }}$('#manufacturingorder__penambahanstockchemical_id_dialog').dialog('close');});$('#manufacturingorder__penambahanstockchemical_id_lookup').button().click(function() {$('#manufacturingorder__penambahanstockchemical_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Item *</td><td><?=form_dropdown('manufacturingorder__item_id', $item_opt, $manufacturingorder__item_id);?>&nbsp;<input id='manufacturingorder__item_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingorder__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingorder__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/manufactured_itemlookup', function(data) { $('#manufacturingorder__item_id_dialog').html(data);$('#manufacturingorder__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingorder__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=manufacturingorder__item_id]').val(lines[0]);if (typeof window.chemical_manufacturing_order_selected_item_id == 'function') { chemical_manufacturing_order_selected_item_id("<?=site_url();?>"); }}$('#manufacturingorder__item_id_dialog').dialog('close');});$('#manufacturingorder__item_id_lookup').button().click(function() {$('#manufacturingorder__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Raw Material Location *</td><td><?=form_dropdown('manufacturingorder__from_warehouse_id', $warehouse_opt, $manufacturingorder__from_warehouse_id);?>&nbsp;<input id='manufacturingorder__from_warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingorder__from_warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingorder__from_warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/from_warehouselookup', function(data) { $('#manufacturingorder__from_warehouse_id_dialog').html(data);$('#manufacturingorder__from_warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingorder__from_warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=manufacturingorder__from_warehouse_id]').val(lines[0]);if (typeof window.chemical_manufacturing_order_selected_from_warehouse_id == 'function') { chemical_manufacturing_order_selected_from_warehouse_id("<?=site_url();?>"); }}$('#manufacturingorder__from_warehouse_id_dialog').dialog('close');});$('#manufacturingorder__from_warehouse_id_lookup').button().click(function() {$('#manufacturingorder__from_warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Finish Goods Location *</td><td><?=form_dropdown('manufacturingorder__to_warehouse_id', $warehouse_opt, $manufacturingorder__to_warehouse_id);?>&nbsp;<input id='manufacturingorder__to_warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingorder__to_warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingorder__to_warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/to_warehouselookup', function(data) { $('#manufacturingorder__to_warehouse_id_dialog').html(data);$('#manufacturingorder__to_warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingorder__to_warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=manufacturingorder__to_warehouse_id]').val(lines[0]);if (typeof window.chemical_manufacturing_order_selected_to_warehouse_id == 'function') { chemical_manufacturing_order_selected_to_warehouse_id("<?=site_url();?>"); }}$('#manufacturingorder__to_warehouse_id_dialog').dialog('close');});$('#manufacturingorder__to_warehouse_id_lookup').button().click(function() {$('#manufacturingorder__to_warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Bill Of Material *</td><td><?=form_dropdown('manufacturingorder__bom_id', $bom_opt, $manufacturingorder__bom_id);?>&nbsp;<input id='manufacturingorder__bom_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingorder__bom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingorder__bom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/bill_of_materiallookup', function(data) { $('#manufacturingorder__bom_id_dialog').html(data);$('#manufacturingorder__bom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingorder__bom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=manufacturingorder__bom_id]').val(lines[0]);if (typeof window.chemical_manufacturing_order_selected_bom_id == 'function') { chemical_manufacturing_order_selected_bom_id("<?=site_url();?>"); }}$('#manufacturingorder__bom_id_dialog').dialog('close');});$('#manufacturingorder__bom_id_lookup').button().click(function() {$('#manufacturingorder__bom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'manufacturingorder__quantity', 'value' => $manufacturingorder__quantity, 'id' => 'manufacturingorder__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('manufacturingorder__uom_id', $uom_opt, $manufacturingorder__uom_id);?>&nbsp;<input id='manufacturingorder__uom_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingorder__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingorder__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#manufacturingorder__uom_id_dialog').html(data);$('#manufacturingorder__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingorder__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=manufacturingorder__uom_id]').val(lines[0]);if (typeof window.chemical_manufacturing_order_selected_uom_id == 'function') { chemical_manufacturing_order_selected_uom_id("<?=site_url();?>"); }}$('#manufacturingorder__uom_id_dialog').dialog('close');});$('#manufacturingorder__uom_id_lookup').button().click(function() {$('#manufacturingorder__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/chemical_manufacturing_orderlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


