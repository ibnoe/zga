<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#account_typeoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#account_typeeditform').click(function(){$('#account_typeeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Account Type</h3>

<p>
<div id="account_typeoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/account_typeedit/submit" id="account_typeeditform" class="editform">

<?=form_hidden("account_type_id", $account_type_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Account Class</td><td><?=form_input(array('name' => 'coatype__classtype', 'value' => $coatype__classtype, 'id' => 'coatype__classtype'));?></td></tr><tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'coatype__name', 'value' => $coatype__name, 'id' => 'coatype__name'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/account_typelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


