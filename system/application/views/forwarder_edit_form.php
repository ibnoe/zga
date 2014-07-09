<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#forwarderoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#forwardereditform').click(function(){$('#forwardereditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Forwarder</h3>

<p>
<div id="forwarderoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/forwarderedit/submit" id="forwardereditform" class="editform">

<?=form_hidden("forwarder_id", $forwarder_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'forwarder__name', 'value' => $forwarder__name, 'id' => 'forwarder__name'));?></td></tr><tr class='basic'>
<td>Address</td><td><?=form_textarea(array('name' => 'forwarder__address', 'value' => $forwarder__address, 'id' => 'forwarder__address'));?></td></tr><tr class='basic'>
<td>Rating</td><td><?=form_input(array('name' => 'forwarder__rating', 'value' => $forwarder__rating, 'id' => 'forwarder__rating'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'forwarder__notes', 'value' => $forwarder__notes, 'id' => 'forwarder__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/forwarderlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


