<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#manufacturing_order_done_to_rejectoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#manufacturing_order_done_to_rejecteditform').click(function(){$('#manufacturing_order_done_to_rejecteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Manufacturing Order Done To Reject</h3>

<p>
<div id="manufacturing_order_done_to_rejectoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/manufacturing_order_done_to_rejectedit/submit" id="manufacturing_order_done_to_rejecteditform" class="editform">

<?=form_hidden("manufacturing_order_done_to_reject_id", $manufacturing_order_done_to_reject_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_done_to_rejectlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


