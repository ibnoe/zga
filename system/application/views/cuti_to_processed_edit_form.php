<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#cuti_to_processedoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#cuti_to_processededitform').click(function(){$('#cuti_to_processededitform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Cuti To Processed</h3>

<p>
<div id="cuti_to_processedoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/cuti_to_processededit/submit" id="cuti_to_processededitform" class="editform">

<?=form_hidden("cuti_to_processed_id", $cuti_to_processed_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cuti_to_processedlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


