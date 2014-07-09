<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#open_bank_transfer_outoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#open_bank_transfer_outeditform').click(function(){$('#open_bank_transfer_outeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Open Bank Transfer Out</h3>

<p>
<div id="open_bank_transfer_outoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/open_bank_transfer_outedit/submit" id="open_bank_transfer_outeditform" class="editform">

<?=form_hidden("open_bank_transfer_out_id", $open_bank_transfer_out_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_bank_transfer_outlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


