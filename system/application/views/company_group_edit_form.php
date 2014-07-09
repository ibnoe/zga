<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#company_groupoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#company_groupeditform').click(function(){$('#company_groupeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Company Group</h3>

<p>
<div id="company_groupoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/company_groupedit/submit" id="company_groupeditform" class="editform">

<?=form_hidden("company_group_id", $company_group_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'customergroup__idstring', 'value' => $customergroup__idstring, 'id' => 'customergroup__idstring'));?></td></tr><tr class='basic'>
<td>Group Name *</td><td><?=form_input(array('name' => 'customergroup__name', 'value' => $customergroup__name, 'id' => 'customergroup__name'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'customergroup__notes', 'value' => $customergroup__notes, 'id' => 'customergroup__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/company_grouplist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


