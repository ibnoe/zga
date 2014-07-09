<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#manufacturing_order_doneoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#manufacturing_order_doneeditform').click(function(){$('#manufacturing_order_doneeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Manufacturing Order Done</h3>

<p>
<div id="manufacturing_order_doneoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/manufacturing_order_doneedit/submit" id="manufacturing_order_doneeditform" class="editform">

<?=form_hidden("manufacturing_order_done_id", $manufacturing_order_done_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'manufacturingorderdone__idstring', 'value' => $manufacturingorderdone__idstring, 'id' => 'manufacturingorderdone__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#manufacturingorderdone__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'manufacturingorderdone__date', 'value' => $manufacturingorderdone__date, 'class' => 'date', 'id' => 'manufacturingorderdone__date'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'manufacturingorderdone__notes', 'value' => $manufacturingorderdone__notes, 'id' => 'manufacturingorderdone__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_donelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


