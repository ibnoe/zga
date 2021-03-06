<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#roller_inspection_sheetoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/roller_inspection_sheetview/index/' },
		}; 
		
		$('#roller_inspection_sheetform').click(function(){$('#roller_inspection_sheetform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Roller Inspection Sheet</h3>

<p>
<div id="roller_inspection_sheetoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/roller_inspection_sheetadd/submit" id="roller_inspection_sheetform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'rollerinspectionsheet__idstring', 'value' => $rollerinspectionsheet__idstring, 'class' => 'basic', 'id' => 'rollerinspectionsheet__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".rollerinspectionsheet__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'rollerinspectionsheet__date', 'value' => $rollerinspectionsheet__date, 'class' => 'rollerinspectionsheet__datebasic'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<td><?=form_dropdown('rollerinspectionsheet__customer_id', array(), '', 'class="basic"');?>&nbsp;<input id='rollerinspectionsheet__customer_id_lookup' type='button' value='Lookup'></input></td><div id='rollerinspectionsheet__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rollerinspectionsheet__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#rollerinspectionsheet__customer_id_dialog').html(data);$('#rollerinspectionsheet__customer_id_dialog a').attr('disabled', 'disabled');$('#rollerinspectionsheet__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rollerinspectionsheet__customer_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=rollerinspectionsheet__customer_id]').val(lines[0]);if (typeof window.roller_inspection_sheet_selected_customer_id == 'function') { roller_inspection_sheet_selected_customer_id("<?=site_url();?>"); }}$('#rollerinspectionsheet__customer_id_dialog').dialog('close');});$('#rollerinspectionsheet__customer_id_lookup').button().click(function() {$('#rollerinspectionsheet__customer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Mesin</td>
<td><?=form_dropdown('rollerinspectionsheet__mesin_id', array(), '', 'class="basic"');?>&nbsp;<input id='rollerinspectionsheet__mesin_id_lookup' type='button' value='Lookup'></input></td><div id='rollerinspectionsheet__mesin_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rollerinspectionsheet__mesin_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/mesinlookup', function(data) { $('#rollerinspectionsheet__mesin_id_dialog').html(data);$('#rollerinspectionsheet__mesin_id_dialog a').attr('disabled', 'disabled');$('#rollerinspectionsheet__mesin_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rollerinspectionsheet__mesin_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=rollerinspectionsheet__mesin_id]').val(lines[0]);if (typeof window.roller_inspection_sheet_selected_mesin_id == 'function') { roller_inspection_sheet_selected_mesin_id("<?=site_url();?>"); }}$('#rollerinspectionsheet__mesin_id_dialog').dialog('close');});$('#rollerinspectionsheet__mesin_id_lookup').button().click(function() {$('#rollerinspectionsheet__mesin_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Roll *</td>
<td><?=form_dropdown('rollerinspectionsheet__roll_id', array(), '', 'class="basic"');?>&nbsp;<input id='rollerinspectionsheet__roll_id_lookup' type='button' value='Lookup'></input></td><div id='rollerinspectionsheet__roll_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rollerinspectionsheet__roll_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/rolllookup', function(data) { $('#rollerinspectionsheet__roll_id_dialog').html(data);$('#rollerinspectionsheet__roll_id_dialog a').attr('disabled', 'disabled');$('#rollerinspectionsheet__roll_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rollerinspectionsheet__roll_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=rollerinspectionsheet__roll_id]').val(lines[0]);if (typeof window.roller_inspection_sheet_selected_roll_id == 'function') { roller_inspection_sheet_selected_roll_id("<?=site_url();?>"); }}$('#rollerinspectionsheet__roll_id_dialog').dialog('close');});$('#rollerinspectionsheet__roll_id_lookup').button().click(function() {$('#rollerinspectionsheet__roll_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Order No</td>
<td><?=form_input(array('name' => 'rollerinspectionsheet__orderno', 'value' => $rollerinspectionsheet__orderno, 'class' => 'basic', 'id' => 'rollerinspectionsheet__orderno'));?></td></tr>
<tr class='basic'>
<td>Compound *</td>
<td><?=form_dropdown('rollerinspectionsheet__compound_id', array(), '', 'class="basic"');?>&nbsp;<input id='rollerinspectionsheet__compound_id_lookup' type='button' value='Lookup'></input></td><div id='rollerinspectionsheet__compound_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rollerinspectionsheet__compound_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/compoundlookup', function(data) { $('#rollerinspectionsheet__compound_id_dialog').html(data);$('#rollerinspectionsheet__compound_id_dialog a').attr('disabled', 'disabled');$('#rollerinspectionsheet__compound_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rollerinspectionsheet__compound_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=rollerinspectionsheet__compound_id]').val(lines[0]);if (typeof window.roller_inspection_sheet_selected_compound_id == 'function') { roller_inspection_sheet_selected_compound_id("<?=site_url();?>"); }}$('#rollerinspectionsheet__compound_id_dialog').dialog('close');});$('#rollerinspectionsheet__compound_id_lookup').button().click(function() {$('#rollerinspectionsheet__compound_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/roller_inspection_sheetlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
