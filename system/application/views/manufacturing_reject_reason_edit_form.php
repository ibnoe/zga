<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#manufacturing_reject_reasonoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#manufacturing_reject_reasoneditform').click(function(){$('#manufacturing_reject_reasoneditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Manufacturing Reject Reason</h3>

<p>
<div id="manufacturing_reject_reasonoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/manufacturing_reject_reasonedit/submit" id="manufacturing_reject_reasoneditform" class="editform">

<?=form_hidden("manufacturing_reject_reason_id", $manufacturing_reject_reason_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'manufacturingrejectreason__name', 'value' => $manufacturingrejectreason__name, 'id' => 'manufacturingrejectreason__name'));?></td></tr><tr class='basic'>
<td>Notes *</td><td><?=form_textarea(array('name' => 'manufacturingrejectreason__name', 'value' => $manufacturingrejectreason__name, 'id' => 'manufacturingrejectreason__name'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_reject_reasonlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


