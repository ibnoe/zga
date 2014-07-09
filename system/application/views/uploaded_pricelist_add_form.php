<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#uploaded_pricelistoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/uploaded_pricelistview/index/' },
		}; 
		
		$('#uploaded_pricelistform').click(function(){$('#uploaded_pricelistform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Uploaded Pricelist</h3>

<p>
<div id="uploaded_pricelistoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/uploaded_pricelistadd/submit" id="uploaded_pricelistform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>File *</td>
<td><?=form_upload(array('name' => 'uploadedpricelist__name', 'class' => 'basic', 'id' => 'uploadedpricelist__name'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'uploadedpricelist__notes', 'value' => $uploadedpricelist__notes, 'class' => 'basic', 'id' => 'uploadedpricelist__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/uploaded_pricelistlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
