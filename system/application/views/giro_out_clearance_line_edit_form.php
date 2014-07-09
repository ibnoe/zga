<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#giro_out_clearance_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#giro_out_clearance_lineeditform').click(function(){$('#giro_out_clearance_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Giro Out Clearance Line</h3>

<p>
<div id="giro_out_clearance_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_out_clearance_lineedit/submit" id="giro_out_clearance_lineeditform" class="editform">

<?=form_hidden("giro_out_clearance_line_id", $giro_out_clearance_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Giro Out *</td><td><?=form_dropdown('girooutclearanceline__giroout_id', $giroout_opt, $girooutclearanceline__giroout_id);?>&nbsp;<input id='girooutclearanceline__giroout_id_lookup' type='button' value='Lookup'></input></td><div id='girooutclearanceline__giroout_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#girooutclearanceline__giroout_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/giro_outlookup', function(data) { $('#girooutclearanceline__giroout_id_dialog').html(data);$('#girooutclearanceline__giroout_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=girooutclearanceline__giroout_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=girooutclearanceline__giroout_id]').val(lines[0]);if (typeof window.giro_out_clearance_line_selected_giroout_id == 'function') { giro_out_clearance_line_selected_giroout_id("<?=site_url();?>"); }}$('#girooutclearanceline__giroout_id_dialog').dialog('close');});$('#girooutclearanceline__giroout_id_lookup').button().click(function() {$('#girooutclearanceline__giroout_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_out_clearance_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


