<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#stock_adjustment_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#stock_adjustment_lineeditform').click(function(){$('#stock_adjustment_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Stock Adjustment Line</h3>

<p>
<div id="stock_adjustment_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/stock_adjustment_lineedit/submit" id="stock_adjustment_lineeditform" class="editform">

<?=form_hidden("stock_adjustment_line_id", $stock_adjustment_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'>
<td>Account *</td><td><?=form_dropdown('stockadjustmentline__coa_id', $coa_opt, $stockadjustmentline__coa_id);?>&nbsp;<input id='stockadjustmentline__coa_id_lookup' type='button' value='Lookup'></input></td><div id='stockadjustmentline__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#stockadjustmentline__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#stockadjustmentline__coa_id_dialog').html(data);$('#stockadjustmentline__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=stockadjustmentline__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=stockadjustmentline__coa_id]').val(lines[0]);if (typeof window.stock_adjustment_line_selected_coa_id == 'function') { stock_adjustment_line_selected_coa_id("<?=site_url();?>"); }}$('#stockadjustmentline__coa_id_dialog').dialog('close');});$('#stockadjustmentline__coa_id_lookup').button().click(function() {$('#stockadjustmentline__coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Item *</td><td><?=form_dropdown('stockadjustmentline__item_id', $item_opt, $stockadjustmentline__item_id);?>&nbsp;<input id='stockadjustmentline__item_id_lookup' type='button' value='Lookup'></input></td><div id='stockadjustmentline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#stockadjustmentline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/item_in_stocklookup', function(data) { $('#stockadjustmentline__item_id_dialog').html(data);$('#stockadjustmentline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=stockadjustmentline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=stockadjustmentline__item_id]').val(lines[0]);if (typeof window.stock_adjustment_line_selected_item_id == 'function') { stock_adjustment_line_selected_item_id("<?=site_url();?>"); }}$('#stockadjustmentline__item_id_dialog').dialog('close');});$('#stockadjustmentline__item_id_lookup').button().click(function() {$('#stockadjustmentline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'stockadjustmentline__quantity', 'value' => $stockadjustmentline__quantity, 'id' => 'stockadjustmentline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('stockadjustmentline__uom_id', $uom_opt, $stockadjustmentline__uom_id);?>&nbsp;<input id='stockadjustmentline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='stockadjustmentline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#stockadjustmentline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#stockadjustmentline__uom_id_dialog').html(data);$('#stockadjustmentline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=stockadjustmentline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=stockadjustmentline__uom_id]').val(lines[0]);if (typeof window.stock_adjustment_line_selected_uom_id == 'function') { stock_adjustment_line_selected_uom_id("<?=site_url();?>"); }}$('#stockadjustmentline__uom_id_dialog').dialog('close');});$('#stockadjustmentline__uom_id_lookup').button().click(function() {$('#stockadjustmentline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/stock_adjustment_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


