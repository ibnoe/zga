<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#open_credit_note_outoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#open_credit_note_outeditform').click(function(){$('#open_credit_note_outeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Open Credit Note Out</h3>

<p>
<div id="open_credit_note_outoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/open_credit_note_outedit/submit" id="open_credit_note_outeditform" class="editform">

<?=form_hidden("open_credit_note_out_id", $open_credit_note_out_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_credit_note_outlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


