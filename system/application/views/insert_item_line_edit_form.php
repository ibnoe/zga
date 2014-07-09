<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#insert_item_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#insert_item_lineeditform').click(function(){$('#insert_item_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Insert Item Line</h3>

<p>
<div id="insert_item_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/insert_item_lineedit/submit" id="insert_item_lineeditform" class="editform">

<?=form_hidden("insert_item_line_id", $insert_item_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'>
<td>Location *</td><td><?=form_dropdown('insertitemline__warehouse_id', $warehouse_opt, $insertitemline__warehouse_id);?>&nbsp;<input id='insertitemline__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='insertitemline__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#insertitemline__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#insertitemline__warehouse_id_dialog').html(data);$('#insertitemline__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=insertitemline__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=insertitemline__warehouse_id]').val(lines[0]);if (typeof window.insert_item_line_selected_warehouse_id == 'function') { insert_item_line_selected_warehouse_id("<?=site_url();?>"); }}$('#insertitemline__warehouse_id_dialog').dialog('close');});$('#insertitemline__warehouse_id_lookup').button().click(function() {$('#insertitemline__warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Item *</td><td><?=form_dropdown('insertitemline__item_id', $item_opt, $insertitemline__item_id);?>&nbsp;<input id='insertitemline__item_id_lookup' type='button' value='Lookup'></input></td><div id='insertitemline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#insertitemline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#insertitemline__item_id_dialog').html(data);$('#insertitemline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=insertitemline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=insertitemline__item_id]').val(lines[0]);if (typeof window.insert_item_line_selected_item_id == 'function') { insert_item_line_selected_item_id("<?=site_url();?>"); }}$('#insertitemline__item_id_dialog').dialog('close');});$('#insertitemline__item_id_lookup').button().click(function() {$('#insertitemline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'insertitemline__quantity', 'value' => $insertitemline__quantity, 'id' => 'insertitemline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('insertitemline__uom_id', $uom_opt, $insertitemline__uom_id);?>&nbsp;<input id='insertitemline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='insertitemline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#insertitemline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#insertitemline__uom_id_dialog').html(data);$('#insertitemline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=insertitemline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=insertitemline__uom_id]').val(lines[0]);if (typeof window.insert_item_line_selected_uom_id == 'function') { insert_item_line_selected_uom_id("<?=site_url();?>"); }}$('#insertitemline__uom_id_dialog').dialog('close');});$('#insertitemline__uom_id_lookup').button().click(function() {$('#insertitemline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/insert_item_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


