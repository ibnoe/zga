<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#manufacturing_rejectoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#manufacturing_rejecteditform').click(function(){$('#manufacturing_rejecteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Manufacturing Reject</h3>

<p>
<div id="manufacturing_rejectoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/manufacturing_rejectedit/submit" id="manufacturing_rejecteditform" class="editform">

<?=form_hidden("manufacturing_reject_id", $manufacturing_reject_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'manufacturingreject__idstring', 'value' => $manufacturingreject__idstring, 'id' => 'manufacturingreject__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#manufacturingreject__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'manufacturingreject__date', 'value' => $manufacturingreject__date, 'class' => 'date', 'id' => 'manufacturingreject__date'));?></td></tr><tr class='basic'>
<td>Item *</td><td><?=form_dropdown('manufacturingreject__item_id', $item_opt, $manufacturingreject__item_id);?>&nbsp;<input id='manufacturingreject__item_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingreject__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingreject__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/manufactured_item_in_stocklookup', function(data) { $('#manufacturingreject__item_id_dialog').html(data);$('#manufacturingreject__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingreject__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=manufacturingreject__item_id]').val(lines[0]);if (typeof window.manufacturing_reject_selected_item_id == 'function') { manufacturing_reject_selected_item_id("<?=site_url();?>"); }}$('#manufacturingreject__item_id_dialog').dialog('close');});$('#manufacturingreject__item_id_lookup').button().click(function() {$('#manufacturingreject__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Goods Location *</td><td><?=form_dropdown('manufacturingreject__warehouse_id', $warehouse_opt, $manufacturingreject__warehouse_id);?>&nbsp;<input id='manufacturingreject__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingreject__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingreject__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#manufacturingreject__warehouse_id_dialog').html(data);$('#manufacturingreject__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingreject__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=manufacturingreject__warehouse_id]').val(lines[0]);if (typeof window.manufacturing_reject_selected_warehouse_id == 'function') { manufacturing_reject_selected_warehouse_id("<?=site_url();?>"); }}$('#manufacturingreject__warehouse_id_dialog').dialog('close');});$('#manufacturingreject__warehouse_id_lookup').button().click(function() {$('#manufacturingreject__warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'manufacturingreject__quantity', 'value' => $manufacturingreject__quantity, 'id' => 'manufacturingreject__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('manufacturingreject__uom_id', $uom_opt, $manufacturingreject__uom_id);?>&nbsp;<input id='manufacturingreject__uom_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingreject__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingreject__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#manufacturingreject__uom_id_dialog').html(data);$('#manufacturingreject__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingreject__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=manufacturingreject__uom_id]').val(lines[0]);if (typeof window.manufacturing_reject_selected_uom_id == 'function') { manufacturing_reject_selected_uom_id("<?=site_url();?>"); }}$('#manufacturingreject__uom_id_dialog').dialog('close');});$('#manufacturingreject__uom_id_lookup').button().click(function() {$('#manufacturingreject__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_rejectlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


