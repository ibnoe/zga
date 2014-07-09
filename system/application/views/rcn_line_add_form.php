<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#rcn_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#rcn_lineform').click(function(){$('#rcn_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New RCN Line</h3>

<p>
<div id="rcn_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/rcn_lineadd/submit" id="rcn_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('rcn_id', $rcn_id);?>
<tr class='basic'>
<td>No Identification</td>
<td><?=form_input(array('name' => 'rcnline__noiden', 'value' => $rcnline__noiden, 'class' => 'basic', 'id' => 'rcnline__noiden'));?></td></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'rcnline__quantity', 'value' => $rcnline__quantity, 'class' => 'basic', 'id' => 'rcnline__quantity'));?></td></tr>
<tr class='basic'>
<td>Pos</td>
<td><?=form_input(array('name' => 'rcnline__pos', 'value' => $rcnline__pos, 'class' => 'basic', 'id' => 'rcnline__pos'));?></td></tr>
<tr class='basic'>
<td>Rubber Diameter (RD)</td>
<td><?=form_input(array('name' => 'rcnline__rd', 'value' => $rcnline__rd, 'class' => 'basic', 'id' => 'rcnline__rd'));?></td></tr>
<tr class='basic'>
<td>Core Diameter (CD)</td>
<td><?=form_input(array('name' => 'rcnline__cd', 'value' => $rcnline__cd, 'class' => 'basic', 'id' => 'rcnline__cd'));?></td></tr>
<tr class='basic'>
<td>Rubber Length (RL)</td>
<td><?=form_input(array('name' => 'rcnline__rl', 'value' => $rcnline__rl, 'class' => 'basic', 'id' => 'rcnline__rl'));?></td></tr>
<tr class='basic'>
<td>Working Length (WL)</td>
<td><?=form_input(array('name' => 'rcnline__wl', 'value' => $rcnline__wl, 'class' => 'basic', 'id' => 'rcnline__wl'));?></td></tr>
<tr class='basic'>
<td>Total Length (TL)</td>
<td><?=form_input(array('name' => 'rcnline__tl', 'value' => $rcnline__tl, 'class' => 'basic', 'id' => 'rcnline__tl'));?></td></tr>
<tr class='basic'>
<td>Compound *</td>
<td><?=form_dropdown('rcnline__compound_id', array(), '', 'class="basic"');?>&nbsp;<input id='rcnline__compound_id_lookup' type='button' value='Lookup'></input></td><div id='rcnline__compound_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rcnline__compound_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/compoundlookup', function(data) { $('#rcnline__compound_id_dialog').html(data);$('#rcnline__compound_id_dialog a').attr('disabled', 'disabled');$('#rcnline__compound_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rcnline__compound_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=rcnline__compound_id]').val(lines[0]);if (typeof window.rcn_line_selected_compound_id == 'function') { rcn_line_selected_compound_id("<?=site_url();?>"); }}$('#rcnline__compound_id_dialog').dialog('close');});$('#rcnline__compound_id_lookup').button().click(function() {$('#rcnline__compound_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Acc Fitted</td>
<td><input type='checkbox' name='rcnline__accfitted' value='1'></input></td></tr>
<tr class='basic'>
<td>Press Type</td>
<td><?=form_dropdown('rcnline__mesin_id', array(), '', 'class="basic"');?>&nbsp;<input id='rcnline__mesin_id_lookup' type='button' value='Lookup'></input></td><div id='rcnline__mesin_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rcnline__mesin_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/mesinlookup', function(data) { $('#rcnline__mesin_id_dialog').html(data);$('#rcnline__mesin_id_dialog a').attr('disabled', 'disabled');$('#rcnline__mesin_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rcnline__mesin_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=rcnline__mesin_id]').val(lines[0]);if (typeof window.rcn_line_selected_mesin_id == 'function') { rcn_line_selected_mesin_id("<?=site_url();?>"); }}$('#rcnline__mesin_id_dialog').dialog('close');});$('#rcnline__mesin_id_lookup').button().click(function() {$('#rcnline__mesin_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Roller Type *</td>
<td><?=form_dropdown('rcnline__core_id', array(), '', 'class="basic"');?>&nbsp;<input id='rcnline__core_id_lookup' type='button' value='Lookup'></input></td><div id='rcnline__core_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rcnline__core_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/corelookup', function(data) { $('#rcnline__core_id_dialog').html(data);$('#rcnline__core_id_dialog a').attr('disabled', 'disabled');$('#rcnline__core_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rcnline__core_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=rcnline__core_id]').val(lines[0]);if (typeof window.rcn_line_selected_core_id == 'function') { rcn_line_selected_core_id("<?=site_url();?>"); }}$('#rcnline__core_id_dialog').dialog('close');});$('#rcnline__core_id_lookup').button().click(function() {$('#rcnline__core_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Item No</td>
<td><?=form_input(array('name' => 'rcnline__itemno', 'value' => $rcnline__itemno, 'class' => 'basic', 'id' => 'rcnline__itemno'));?></td></tr>
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
