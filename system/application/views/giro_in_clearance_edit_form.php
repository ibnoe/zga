<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#giro_in_clearanceoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#giro_in_clearanceeditform').click(function(){$('#giro_in_clearanceeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Giro In Clearance</h3>

<p>
<div id="giro_in_clearanceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_in_clearanceedit/submit" id="giro_in_clearanceeditform" class="editform">

<?=form_hidden("giro_in_clearance_id", $giro_in_clearance_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#giroinclearance__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'giroinclearance__date', 'value' => $giroinclearance__date, 'class' => 'date', 'id' => 'giroinclearance__date'));?></td></tr><tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'giroinclearance__idstring', 'value' => $giroinclearance__idstring, 'id' => 'giroinclearance__idstring'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'giroinclearance__notes', 'value' => $giroinclearance__notes, 'id' => 'giroinclearance__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_in_clearancelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


