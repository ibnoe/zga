<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#marketing_officeroutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#marketing_officereditform').click(function(){$('#marketing_officereditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Marketing Officer</h3>

<p>
<div id="marketing_officeroutput"></div>
</p>

<form method="post" action="<?=site_url();?>/marketing_officeredit/submit" id="marketing_officereditform" class="editform">

<?=form_hidden("marketing_officer_id", $marketing_officer_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'marketingofficer__idstring', 'value' => $marketingofficer__idstring, 'id' => 'marketingofficer__idstring'));?></td></tr><tr class='basic'>
<td>Officer Name *</td><td><?=form_input(array('name' => 'marketingofficer__name', 'value' => $marketingofficer__name, 'id' => 'marketingofficer__name'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'marketingofficer__notes', 'value' => $marketingofficer__notes, 'id' => 'marketingofficer__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/marketing_officerlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


