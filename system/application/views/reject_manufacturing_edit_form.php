<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#reject_manufacturingoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#reject_manufacturingeditform').click(function(){$('#reject_manufacturingeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Reject Manufacturing</h3>

<p>
<div id="reject_manufacturingoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/reject_manufacturingedit/submit" id="reject_manufacturingeditform" class="editform">

<?=form_hidden("reject_manufacturing_id", $reject_manufacturing_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'rejectmanufacturing__idstring', 'value' => $rejectmanufacturing__idstring, 'id' => 'rejectmanufacturing__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#rejectmanufacturing__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'rejectmanufacturing__date', 'value' => $rejectmanufacturing__date, 'class' => 'date', 'id' => 'rejectmanufacturing__date'));?></td></tr><tr class='basic'>
<td>Manufacturing Reject Reason *</td><td><?=form_dropdown('rejectmanufacturing__manufacturingrejectreason_id', $manufacturingrejectreason_opt, $rejectmanufacturing__manufacturingrejectreason_id);?>&nbsp;<input id='rejectmanufacturing__manufacturingrejectreason_id_lookup' type='button' value='Lookup'></input></td><div id='rejectmanufacturing__manufacturingrejectreason_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rejectmanufacturing__manufacturingrejectreason_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/manufacturing_reject_reasonlookup', function(data) { $('#rejectmanufacturing__manufacturingrejectreason_id_dialog').html(data);$('#rejectmanufacturing__manufacturingrejectreason_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rejectmanufacturing__manufacturingrejectreason_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=rejectmanufacturing__manufacturingrejectreason_id]').val(lines[0]);if (typeof window.reject_manufacturing_selected_manufacturingrejectreason_id == 'function') { reject_manufacturing_selected_manufacturingrejectreason_id("<?=site_url();?>"); }}$('#rejectmanufacturing__manufacturingrejectreason_id_dialog').dialog('close');});$('#rejectmanufacturing__manufacturingrejectreason_id_lookup').button().click(function() {$('#rejectmanufacturing__manufacturingrejectreason_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'rejectmanufacturing__notes', 'value' => $rejectmanufacturing__notes, 'id' => 'rejectmanufacturing__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/reject_manufacturinglist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


