<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#open_bank_transfer_inoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#open_bank_transfer_ineditform').click(function(){$('#open_bank_transfer_ineditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Open Bank Transfer In</h3>

<p>
<div id="open_bank_transfer_inoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/open_bank_transfer_inedit/submit" id="open_bank_transfer_ineditform" class="editform">

<?=form_hidden("open_bank_transfer_in_id", $open_bank_transfer_in_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_bank_transfer_inlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


