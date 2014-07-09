<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#giro_out_for_flaggingoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#giro_out_for_flaggingeditform').click(function(){$('#giro_out_for_flaggingeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Giro Out For Flagging</h3>

<p>
<div id="giro_out_for_flaggingoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_out_for_flaggingedit/submit" id="giro_out_for_flaggingeditform" class="editform">

<?=form_hidden("giro_out_for_flagging_id", $giro_out_for_flagging_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_out_for_flagginglist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


