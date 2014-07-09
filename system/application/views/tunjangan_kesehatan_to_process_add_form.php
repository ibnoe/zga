<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#tunjangan_kesehatan_to_processoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/tunjangan_kesehatan_to_processview/index/' },
		}; 
		
		$('#tunjangan_kesehatan_to_processform').click(function(){$('#tunjangan_kesehatan_to_processform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Tunjangan Kesehatan To Process</h3>

<p>
<div id="tunjangan_kesehatan_to_processoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/tunjangan_kesehatan_to_processadd/submit" id="tunjangan_kesehatan_to_processform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/tunjangan_kesehatan_to_processlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
