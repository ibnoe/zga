<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#uploaded_pricelistoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#uploaded_pricelisteditform').click(function(){$('#uploaded_pricelisteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Uploaded Pricelist</h3>

<p>
<div id="uploaded_pricelistoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/uploaded_pricelistedit/submit" id="uploaded_pricelisteditform" class="editform">

<?=form_hidden("uploaded_pricelist_id", $uploaded_pricelist_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>File *</td><td><?=form_upload(array('name' => 'uploadedpricelist__name', 'id' => 'uploadedpricelist__name'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'uploadedpricelist__notes', 'value' => $uploadedpricelist__notes, 'id' => 'uploadedpricelist__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/uploaded_pricelistlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


