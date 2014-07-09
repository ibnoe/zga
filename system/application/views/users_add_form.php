<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#usersoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/usersview/index/' },
		}; 
		
		$('#usersform').click(function(){$('#usersform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Users</h3>

<p>
<div id="usersoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/usersadd/submit" id="usersform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>First Name</td>
<td><?=form_input(array('name' => 'users__firstname', 'value' => $users__firstname, 'class' => 'basic', 'id' => 'users__firstname'));?></td></tr>
<tr class='basic'>
<td>Last Name</td>
<td><?=form_input(array('name' => 'users__lastname', 'value' => $users__lastname, 'class' => 'basic', 'id' => 'users__lastname'));?></td></tr>
<tr class='basic'>
<td>Username</td>
<td><?=form_input(array('name' => 'users__username', 'value' => $users__username, 'class' => 'basic', 'id' => 'users__username'));?></td></tr>
<tr class='basic'>
<td>Password</td>
<td><?=form_password(array('name' => 'users__password', 'value' => $users__password, 'class' => 'basic', 'id' => 'users__password'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/userslist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
