<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#klaim_tunjangan_kesehatan_to_processoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#klaim_tunjangan_kesehatan_to_processeditform').click(function(){$('#klaim_tunjangan_kesehatan_to_processeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Klaim Tunjangan Kesehatan To Process</h3>

<p>
<div id="klaim_tunjangan_kesehatan_to_processoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/klaim_tunjangan_kesehatan_to_processedit/submit" id="klaim_tunjangan_kesehatan_to_processeditform" class="editform">

<?=form_hidden("klaim_tunjangan_kesehatan_to_process_id", $klaim_tunjangan_kesehatan_to_process_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/klaim_tunjangan_kesehatan_to_processlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


