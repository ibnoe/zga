<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#notificationoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#notificationeditform').click(function(){$('#notificationeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Notification</h3>

<p>
<div id="notificationoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/notificationedit/submit" id="notificationeditform" class="editform">

<?=form_hidden("notification_id", $notification_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Summary</td><td><?=form_input(array('name' => 'vmessagenotification__summary', 'value' => $vmessagenotification__summary, 'id' => 'vmessagenotification__summary'));?></td></tr><tr class='basic'>
<td>Message</td><td><?=form_textarea(array('name' => 'vmessagenotification__message', 'value' => $vmessagenotification__message, 'id' => 'vmessagenotification__message'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/notificationlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


