<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#receive_items_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/receive_items_lineview/index/' },
		}; 
		
		$('#receive_items_lineform').click(function(){$('#receive_items_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Receive Items Line</h3>

<p>
<div id="receive_items_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/receive_items_lineadd/submit" id="receive_items_lineform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('receiveditemline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='receiveditemline__item_id_lookup' type='button' value='Lookup'></input></td><div id='receiveditemline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#receiveditemline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#receiveditemline__item_id_dialog').html(data);$('#receiveditemline__item_id_dialog a').attr('disabled', 'disabled');$('#receiveditemline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=receiveditemline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=receiveditemline__item_id]').val(lines[0]);if (typeof window.receive_items_line_selected_item_id == 'function') { receive_items_line_selected_item_id("<?=site_url();?>"); }}$('#receiveditemline__item_id_dialog').dialog('close');});$('#receiveditemline__item_id_lookup').button().click(function() {$('#receiveditemline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'receiveditemline__quantitytoreceive', 'value' => $receiveditemline__quantitytoreceive, 'class' => 'basic', 'id' => 'receiveditemline__quantitytoreceive'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('receiveditemline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='receiveditemline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='receiveditemline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#receiveditemline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#receiveditemline__uom_id_dialog').html(data);$('#receiveditemline__uom_id_dialog a').attr('disabled', 'disabled');$('#receiveditemline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=receiveditemline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=receiveditemline__uom_id]').val(lines[0]);if (typeof window.receive_items_line_selected_uom_id == 'function') { receive_items_line_selected_uom_id("<?=site_url();?>"); }}$('#receiveditemline__uom_id_dialog').dialog('close');});$('#receiveditemline__uom_id_lookup').button().click(function() {$('#receiveditemline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<?=form_hidden('receiveditemline__purchaseorderline_id', $receiveditemline__purchaseorderline_id);?></tr>
<tr class='basic'>
<td>Serial No</td>
<td><?=form_input(array('name' => 'receiveditemline__serialno', 'value' => $receiveditemline__serialno, 'class' => 'basic', 'id' => 'receiveditemline__serialno'));?></td></tr>
<tr class='basic'>
<td>Expired Date *</td><script type="text/javascript">$(document).ready(function() {$(".receiveditemline__expireddatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'receiveditemline__expireddate', 'value' => $receiveditemline__expireddate, 'class' => 'receiveditemline__expireddatebasic'));?></td></tr>
<tr class='basic'>
<td>HS Code</td>
<td><?=form_input(array('name' => 'receiveditemline__hscode', 'value' => $receiveditemline__hscode, 'class' => 'basic', 'id' => 'receiveditemline__hscode'));?></td></tr>
<tr class='basic'>
<td>Packing List</td>
<td><?=form_input(array('name' => 'receiveditemline__packinglist', 'value' => $receiveditemline__packinglist, 'class' => 'basic', 'id' => 'receiveditemline__packinglist'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/receive_items_linelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
