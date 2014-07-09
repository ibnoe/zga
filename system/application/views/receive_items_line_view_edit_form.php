<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#receive_items_line_viewoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#receive_items_line_vieweditform').click(function(){$('#receive_items_line_vieweditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Receive Items Line View</h3>

<p>
<div id="receive_items_line_viewoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/receive_items_line_viewedit/submit" id="receive_items_line_vieweditform" class="editform">

<?=form_hidden("receive_items_line_view_id", $receive_items_line_view_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Item *</td><td><?=form_dropdown('receiveditemline__item_id', $item_opt, $receiveditemline__item_id);?>&nbsp;<input id='receiveditemline__item_id_lookup' type='button' value='Lookup'></input></td><div id='receiveditemline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#receiveditemline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#receiveditemline__item_id_dialog').html(data);$('#receiveditemline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=receiveditemline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=receiveditemline__item_id]').val(lines[0]);if (typeof window.receive_items_line_view_selected_item_id == 'function') { receive_items_line_view_selected_item_id("<?=site_url();?>"); }}$('#receiveditemline__item_id_dialog').dialog('close');});$('#receiveditemline__item_id_lookup').button().click(function() {$('#receiveditemline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'receiveditemline__quantitytoreceive', 'value' => $receiveditemline__quantitytoreceive, 'id' => 'receiveditemline__quantitytoreceive'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('receiveditemline__uom_id', $uom_opt, $receiveditemline__uom_id);?>&nbsp;<input id='receiveditemline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='receiveditemline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#receiveditemline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#receiveditemline__uom_id_dialog').html(data);$('#receiveditemline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=receiveditemline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=receiveditemline__uom_id]').val(lines[0]);if (typeof window.receive_items_line_view_selected_uom_id == 'function') { receive_items_line_view_selected_uom_id("<?=site_url();?>"); }}$('#receiveditemline__uom_id_dialog').dialog('close');});$('#receiveditemline__uom_id_lookup').button().click(function() {$('#receiveditemline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'>
<td>Serial No</td><td><?=form_input(array('name' => 'receiveditemline__serialno', 'value' => $receiveditemline__serialno, 'id' => 'receiveditemline__serialno'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#receiveditemline__expireddate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Expired Date *</td><td><?=form_input(array('name' => 'receiveditemline__expireddate', 'value' => $receiveditemline__expireddate, 'class' => 'date', 'id' => 'receiveditemline__expireddate'));?></td></tr><tr class='basic'>
<td>HS Code</td><td><?=form_input(array('name' => 'receiveditemline__hscode', 'value' => $receiveditemline__hscode, 'id' => 'receiveditemline__hscode'));?></td></tr><tr class='basic'>
<td>Packing List</td><td><?=form_input(array('name' => 'receiveditemline__packinglist', 'value' => $receiveditemline__packinglist, 'id' => 'receiveditemline__packinglist'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/receive_items_line_viewlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


