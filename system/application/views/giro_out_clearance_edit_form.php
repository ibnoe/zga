<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#giro_out_clearanceoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#giro_out_clearanceeditform').click(function(){$('#giro_out_clearanceeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Giro Out Clearance</h3>

<p>
<div id="giro_out_clearanceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_out_clearanceedit/submit" id="giro_out_clearanceeditform" class="editform">

<?=form_hidden("giro_out_clearance_id", $giro_out_clearance_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#girooutclearance__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'girooutclearance__date', 'value' => $girooutclearance__date, 'class' => 'date', 'id' => 'girooutclearance__date'));?></td></tr><tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'girooutclearance__idstring', 'value' => $girooutclearance__idstring, 'id' => 'girooutclearance__idstring'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'girooutclearance__notes', 'value' => $girooutclearance__notes, 'id' => 'girooutclearance__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_out_clearancelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


