<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#giro_in_clearance_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/giro_in_clearance_lineview/index/' },
		}; 
		
		$('#giro_in_clearance_lineform').click(function(){$('#giro_in_clearance_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Giro In Clearance Line</h3>

<p>
<div id="giro_in_clearance_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_in_clearance_lineadd/submit" id="giro_in_clearance_lineform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Giro In *</td>
<td><?=form_dropdown('giroinclearanceline__giroin_id', array(), '', 'class="basic"');?>&nbsp;<input id='giroinclearanceline__giroin_id_lookup' type='button' value='Lookup'></input></td><div id='giroinclearanceline__giroin_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#giroinclearanceline__giroin_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/giro_inlookup', function(data) { $('#giroinclearanceline__giroin_id_dialog').html(data);$('#giroinclearanceline__giroin_id_dialog a').attr('disabled', 'disabled');$('#giroinclearanceline__giroin_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=giroinclearanceline__giroin_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=giroinclearanceline__giroin_id]').val(lines[0]);if (typeof window.giro_in_clearance_line_selected_giroin_id == 'function') { giro_in_clearance_line_selected_giroin_id("<?=site_url();?>"); }}$('#giroinclearanceline__giroin_id_dialog').dialog('close');});$('#giroinclearanceline__giroin_id_lookup').button().click(function() {$('#giroinclearanceline__giroin_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_in_clearance_linelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
