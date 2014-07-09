<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#cuti_to_processedoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/cuti_to_processedview/index/' },
		}; 
		
		$('#cuti_to_processedform').click(function(){$('#cuti_to_processedform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Cuti To Processed</h3>

<p>
<div id="cuti_to_processedoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/cuti_to_processedadd/submit" id="cuti_to_processedform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cuti_to_processedlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
