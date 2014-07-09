<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#tunjangan_kesehatan_to_processoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#tunjangan_kesehatan_to_processeditform').click(function(){$('#tunjangan_kesehatan_to_processeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Tunjangan Kesehatan To Process</h3>

<p>
<div id="tunjangan_kesehatan_to_processoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/tunjangan_kesehatan_to_processedit/submit" id="tunjangan_kesehatan_to_processeditform" class="editform">

<?=form_hidden("tunjangan_kesehatan_to_process_id", $tunjangan_kesehatan_to_process_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/tunjangan_kesehatan_to_processlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


