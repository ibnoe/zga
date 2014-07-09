<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#roll_process_updateoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#roll_process_updateeditform').click(function(){$('#roll_process_updateeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Roll Process Update</h3>

<p>
<div id="roll_process_updateoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/roll_process_updateedit/submit" id="roll_process_updateeditform" class="editform">

<?=form_hidden("roll_process_update_id", $roll_process_update_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>No *</td><td><?=form_input(array('name' => 'rollprocessupdate__idstring', 'value' => $rollprocessupdate__idstring, 'id' => 'rollprocessupdate__idstring'));?></td></tr><tr class='basic'>
<td>No Order And Customer *</td><td><?=form_input(array('name' => 'rollprocessupdate__noorderandcustomer', 'value' => $rollprocessupdate__noorderandcustomer, 'id' => 'rollprocessupdate__noorderandcustomer'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#rollprocessupdate__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Incoming Date *</td><td><?=form_input(array('name' => 'rollprocessupdate__date', 'value' => $rollprocessupdate__date, 'class' => 'date', 'id' => 'rollprocessupdate__date'));?></td></tr><tr class='basic'>
<td>Incoming Quantity</td><td><?=form_input(array('name' => 'rollprocessupdate__qty1', 'value' => $rollprocessupdate__qty1, 'id' => 'rollprocessupdate__qty1'));?></td></tr><tr class='basic'>
<td>Machine Type Roll</td><td><?=form_input(array('name' => 'rollprocessupdate__machinetyperoll', 'value' => $rollprocessupdate__machinetyperoll, 'id' => 'rollprocessupdate__machinetyperoll'));?></td></tr><tr class='basic'>
<td>Compound</td><td><?=form_input(array('name' => 'rollprocessupdate__compound', 'value' => $rollprocessupdate__compound, 'id' => 'rollprocessupdate__compound'));?></td></tr><tr class='basic'>
<td>RD</td><td><?=form_input(array('name' => 'rollprocessupdate__rd', 'value' => $rollprocessupdate__rd, 'id' => 'rollprocessupdate__rd'));?></td></tr><tr class='basic'>
<td>WL</td><td><?=form_input(array('name' => 'rollprocessupdate__wl', 'value' => $rollprocessupdate__wl, 'id' => 'rollprocessupdate__wl'));?></td></tr><tr class='basic'>
<td>TL</td><td><?=form_input(array('name' => 'rollprocessupdate__tl', 'value' => $rollprocessupdate__tl, 'id' => 'rollprocessupdate__tl'));?></td></tr><tr class='basic'>
<td>Qty</td><td><?=form_input(array('name' => 'rollprocessupdate__qty2', 'value' => $rollprocessupdate__qty2, 'id' => 'rollprocessupdate__qty2'));?></td></tr><tr class='basic'>
<td>Shipping</td><td><?=form_input(array('name' => 'rollprocessupdate__shipping', 'value' => $rollprocessupdate__shipping, 'id' => 'rollprocessupdate__shipping'));?></td></tr><tr class='basic'>
<td>Wrapping</td><td><?=form_input(array('name' => 'rollprocessupdate__wrapping', 'value' => $rollprocessupdate__wrapping, 'id' => 'rollprocessupdate__wrapping'));?></td></tr><tr class='basic'>
<td>Vulcanizing</td><td><?=form_input(array('name' => 'rollprocessupdate__vulcanizing', 'value' => $rollprocessupdate__vulcanizing, 'id' => 'rollprocessupdate__vulcanizing'));?></td></tr><tr class='basic'>
<td>Face Off</td><td><?=form_input(array('name' => 'rollprocessupdate__faceoff', 'value' => $rollprocessupdate__faceoff, 'id' => 'rollprocessupdate__faceoff'));?></td></tr><tr class='basic'>
<td>Grinding</td><td><?=form_input(array('name' => 'rollprocessupdate__grinding', 'value' => $rollprocessupdate__grinding, 'id' => 'rollprocessupdate__grinding'));?></td></tr><tr class='basic'>
<td>Polishing</td><td><?=form_input(array('name' => 'rollprocessupdate__polishing', 'value' => $rollprocessupdate__polishing, 'id' => 'rollprocessupdate__polishing'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#rollprocessupdate__maxdate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Max Date *</td><td><?=form_input(array('name' => 'rollprocessupdate__maxdate', 'value' => $rollprocessupdate__maxdate, 'class' => 'date', 'id' => 'rollprocessupdate__maxdate'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#rollprocessupdate__deadlinedate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Deadline Date *</td><td><?=form_input(array('name' => 'rollprocessupdate__deadlinedate', 'value' => $rollprocessupdate__deadlinedate, 'class' => 'date', 'id' => 'rollprocessupdate__deadlinedate'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_textarea(array('name' => 'rollprocessupdate__notes', 'value' => $rollprocessupdate__notes, 'id' => 'rollprocessupdate__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/roll_process_updatelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


