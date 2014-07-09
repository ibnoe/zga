<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#blanket_identification_formoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#blanket_identification_formeditform').click(function(){$('#blanket_identification_formeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Blanket Identification Form</h3>

<p>
<div id="blanket_identification_formoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/blanket_identification_formedit/submit" id="blanket_identification_formeditform" class="editform">

<?=form_hidden("blanket_identification_form_id", $blanket_identification_form_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'bif__idstring', 'value' => $bif__idstring, 'id' => 'bif__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#bif__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'bif__date', 'value' => $bif__date, 'class' => 'date', 'id' => 'bif__date'));?></td></tr><tr class='basic'>
<td>Marketing Officer</td><td><?=form_dropdown('bif__marketingofficer_id', $marketingofficer_opt, $bif__marketingofficer_id);?>&nbsp;<input id='bif__marketingofficer_id_lookup' type='button' value='Lookup'></input></td><div id='bif__marketingofficer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#bif__marketingofficer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/marketing_officerlookup', function(data) { $('#bif__marketingofficer_id_dialog').html(data);$('#bif__marketingofficer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=bif__marketingofficer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=bif__marketingofficer_id]').val(lines[0]);if (typeof window.blanket_identification_form_selected_marketingofficer_id == 'function') { blanket_identification_form_selected_marketingofficer_id("<?=site_url();?>"); }}$('#bif__marketingofficer_id_dialog').dialog('close');});$('#bif__marketingofficer_id_lookup').button().click(function() {$('#bif__marketingofficer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('bif__customer_id', $customer_opt, $bif__customer_id);?>&nbsp;<input id='bif__customer_id_lookup' type='button' value='Lookup'></input></td><div id='bif__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#bif__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#bif__customer_id_dialog').html(data);$('#bif__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=bif__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=bif__customer_id]').val(lines[0]);if (typeof window.blanket_identification_form_selected_customer_id == 'function') { blanket_identification_form_selected_customer_id("<?=site_url();?>"); }}$('#bif__customer_id_dialog').dialog('close');});$('#bif__customer_id_lookup').button().click(function() {$('#bif__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Press Model</td><td><?=form_input(array('name' => 'bif__pressmodel', 'value' => $bif__pressmodel, 'id' => 'bif__pressmodel'));?></td></tr><tr class='basic'>
<td>AC</td><td><?=form_input(array('name' => 'bif__ac', 'value' => $bif__ac, 'id' => 'bif__ac'));?></td></tr><tr class='basic'>
<td>AR</td><td><?=form_input(array('name' => 'bif__ar', 'value' => $bif__ar, 'id' => 'bif__ar'));?></td></tr><tr class='basic'>
<td>Thickness</td><td><?=form_input(array('name' => 'bif__thickness', 'value' => $bif__thickness, 'id' => 'bif__thickness'));?></td></tr><tr class='basic'>
<td>Type Bar 1</td><td><?=form_input(array('name' => 'bif__typebar1', 'value' => $bif__typebar1, 'id' => 'bif__typebar1'));?></td></tr><tr class='basic'>
<td>Length Bar 1</td><td><?=form_input(array('name' => 'bif__lengthbar1', 'value' => $bif__lengthbar1, 'id' => 'bif__lengthbar1'));?></td></tr><tr class='basic'>
<td>Position Bar 1</td><td><?=form_input(array('name' => 'bif__positionbar1', 'value' => $bif__positionbar1, 'id' => 'bif__positionbar1'));?></td></tr><tr class='basic'>
<td>Type Bar 2</td><td><?=form_input(array('name' => 'bif__typebar2', 'value' => $bif__typebar2, 'id' => 'bif__typebar2'));?></td></tr><tr class='basic'>
<td>Length Bar 2</td><td><?=form_input(array('name' => 'bif__lengthbar2', 'value' => $bif__lengthbar2, 'id' => 'bif__lengthbar2'));?></td></tr><tr class='basic'>
<td>Position Bar 2</td><td><?=form_input(array('name' => 'bif__positionbar2', 'value' => $bif__positionbar2, 'id' => 'bif__positionbar2'));?></td></tr><tr class='basic'>
<td>Corner</td><td><?=form_input(array('name' => 'bif__corner', 'value' => $bif__corner, 'id' => 'bif__corner'));?></td></tr><tr class='basic'>
<td>Needs</td><td><?=form_input(array('name' => 'bif__needs', 'value' => $bif__needs, 'id' => 'bif__needs'));?></td></tr><tr class='basic'>
<td>Drawing</td><td><?=form_upload(array('name' => 'bif__drawingfile', 'id' => 'bif__drawingfile'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'bif__notes', 'value' => $bif__notes, 'id' => 'bif__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/blanket_identification_formlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


