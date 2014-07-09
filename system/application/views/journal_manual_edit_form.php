<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#journal_manualoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#journal_manualeditform').click(function(){$('#journal_manualeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Journal Manual</h3>

<p>
<div id="journal_manualoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/journal_manualedit/submit" id="journal_manualeditform" class="editform">

<?=form_hidden("journal_manual_id", $journal_manual_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Reference *</td><td><?=form_input(array('name' => 'journalmanual__reference', 'value' => $journalmanual__reference, 'id' => 'journalmanual__reference'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#journalmanual__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'journalmanual__date', 'value' => $journalmanual__date, 'class' => 'date', 'id' => 'journalmanual__date'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'journalmanual__notes', 'value' => $journalmanual__notes, 'id' => 'journalmanual__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/journal_manuallist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


