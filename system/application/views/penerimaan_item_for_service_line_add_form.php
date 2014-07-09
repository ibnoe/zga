<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#penerimaan_item_for_service_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#penerimaan_item_for_service_lineform').click(function(){$('#penerimaan_item_for_service_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Penerimaan Item For Service Line</h3>

<p>
<div id="penerimaan_item_for_service_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/penerimaan_item_for_service_lineadd/submit" id="penerimaan_item_for_service_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('insertitem_id', $insertitem_id);?>
<tr class='basic'>
<?=form_hidden('insertitemline__idstring', $insertitemline__idstring);?></tr>
<tr class='basic'>
<?=form_hidden('insertitemline__date', $insertitemline__date);?></tr>
<tr class='basic'>
<?=form_hidden('insertitemline__notes', $insertitemline__notes);?></tr>
<tr class='basic'>
<td>Location *</td>
<td><?=form_dropdown('insertitemline__warehouse_id', array(), '', 'class="basic"');?>&nbsp;<input id='insertitemline__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='insertitemline__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#insertitemline__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#insertitemline__warehouse_id_dialog').html(data);$('#insertitemline__warehouse_id_dialog a').attr('disabled', 'disabled');$('#insertitemline__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=insertitemline__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=insertitemline__warehouse_id]').val(lines[0]);if (typeof window.penerimaan_item_for_service_line_selected_warehouse_id == 'function') { penerimaan_item_for_service_line_selected_warehouse_id("<?=site_url();?>"); }}$('#insertitemline__warehouse_id_dialog').dialog('close');});$('#insertitemline__warehouse_id_lookup').button().click(function() {$('#insertitemline__warehouse_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('insertitemline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='insertitemline__item_id_lookup' type='button' value='Lookup'></input></td><div id='insertitemline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#insertitemline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#insertitemline__item_id_dialog').html(data);$('#insertitemline__item_id_dialog a').attr('disabled', 'disabled');$('#insertitemline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=insertitemline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=insertitemline__item_id]').val(lines[0]);if (typeof window.penerimaan_item_for_service_line_selected_item_id == 'function') { penerimaan_item_for_service_line_selected_item_id("<?=site_url();?>"); }}$('#insertitemline__item_id_dialog').dialog('close');});$('#insertitemline__item_id_lookup').button().click(function() {$('#insertitemline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'insertitemline__quantity', 'value' => $insertitemline__quantity, 'class' => 'basic', 'id' => 'insertitemline__quantity'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('insertitemline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='insertitemline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='insertitemline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#insertitemline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#insertitemline__uom_id_dialog').html(data);$('#insertitemline__uom_id_dialog a').attr('disabled', 'disabled');$('#insertitemline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=insertitemline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=insertitemline__uom_id]').val(lines[0]);if (typeof window.penerimaan_item_for_service_line_selected_uom_id == 'function') { penerimaan_item_for_service_line_selected_uom_id("<?=site_url();?>"); }}$('#insertitemline__uom_id_dialog').dialog('close');});$('#insertitemline__uom_id_lookup').button().click(function() {$('#insertitemline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Value</td>
<td><?=form_input(array('name' => 'insertitemline__price', 'value' => $insertitemline__price, 'class' => 'basic', 'id' => 'insertitemline__price'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=$_SERVER['HTTP_REFERER'];?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
