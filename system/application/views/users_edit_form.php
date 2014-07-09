<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#usersoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#userseditform').click(function(){$('#userseditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Users</h3>

<p>
<div id="usersoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/usersedit/submit" id="userseditform" class="editform">

<?=form_hidden("users_id", $users_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>First Name</td><td><?=form_input(array('name' => 'users__firstname', 'value' => $users__firstname, 'id' => 'users__firstname'));?></td></tr><tr class='basic'>
<td>Last Name</td><td><?=form_input(array('name' => 'users__lastname', 'value' => $users__lastname, 'id' => 'users__lastname'));?></td></tr><tr class='basic'>
<td>Username</td><td><?=form_input(array('name' => 'users__username', 'value' => $users__username, 'id' => 'users__username'));?></td></tr><tr class='basic'>
<td>Password</td><td><?=form_password(array('name' => 'users__password', 'value' => $users__password, 'id' => 'users__password'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/userslist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


