<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#reject_manufacturing_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/reject_manufacturing_lineview/index/' },
		}; 
		
		$('#reject_manufacturing_lineform').click(function(){$('#reject_manufacturing_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Reject Manufacturing Line</h3>

<p>
<div id="reject_manufacturing_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/reject_manufacturing_lineadd/submit" id="reject_manufacturing_lineform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('rejectmanufacturingline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='rejectmanufacturingline__item_id_lookup' type='button' value='Lookup'></input></td><div id='rejectmanufacturingline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rejectmanufacturingline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#rejectmanufacturingline__item_id_dialog').html(data);$('#rejectmanufacturingline__item_id_dialog a').attr('disabled', 'disabled');$('#rejectmanufacturingline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rejectmanufacturingline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=rejectmanufacturingline__item_id]').val(lines[0]);if (typeof window.reject_manufacturing_line_selected_item_id == 'function') { reject_manufacturing_line_selected_item_id("<?=site_url();?>"); }}$('#rejectmanufacturingline__item_id_dialog').dialog('close');});$('#rejectmanufacturingline__item_id_lookup').button().click(function() {$('#rejectmanufacturingline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'rejectmanufacturingline__quantitytoprocess', 'value' => $rejectmanufacturingline__quantitytoprocess, 'class' => 'basic', 'id' => 'rejectmanufacturingline__quantitytoprocess'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('rejectmanufacturingline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='rejectmanufacturingline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='rejectmanufacturingline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rejectmanufacturingline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#rejectmanufacturingline__uom_id_dialog').html(data);$('#rejectmanufacturingline__uom_id_dialog a').attr('disabled', 'disabled');$('#rejectmanufacturingline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rejectmanufacturingline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=rejectmanufacturingline__uom_id]').val(lines[0]);if (typeof window.reject_manufacturing_line_selected_uom_id == 'function') { reject_manufacturing_line_selected_uom_id("<?=site_url();?>"); }}$('#rejectmanufacturingline__uom_id_dialog').dialog('close');});$('#rejectmanufacturingline__uom_id_lookup').button().click(function() {$('#rejectmanufacturingline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<?=form_hidden('rejectmanufacturingline__manufacturingorderdoneline_id', $rejectmanufacturingline__manufacturingorderdoneline_id);?></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/reject_manufacturing_linelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
