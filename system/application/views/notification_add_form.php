<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#notificationoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/notificationview/index/' },
		}; 
		
		$('#notificationform').click(function(){$('#notificationform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Notification</h3>

<p>
<div id="notificationoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/notificationadd/submit" id="notificationform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Summary</td>
<td><?=form_input(array('name' => 'vmessagenotification__summary', 'value' => $vmessagenotification__summary, 'class' => 'basic', 'id' => 'vmessagenotification__summary'));?></td></tr>
<tr class='basic'>
<td>Message</td>
<td><?=form_textarea(array('name' => 'vmessagenotification__message', 'value' => $vmessagenotification__message, 'class' => 'basic', 'id' => 'vmessagenotification__message'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/notificationlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
