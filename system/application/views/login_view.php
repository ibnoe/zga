<?php include 'header.php'; ?>

<form method="post" action="<?=site_url();?>/login/submit">
<table>
<tr>
<td>Username</td><td><?=form_input(array("name" => "username"));?></td>
</tr>
<tr>
<td>Password</td><td><?=form_password(array("name" => "password"));?></td>
</tr>
</table>
<br>
<?=form_submit('login', 'Login');?>
</form>

