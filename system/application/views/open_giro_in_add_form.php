<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#open_giro_inoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/open_giro_inview/index/' },
		}; 
		
		$('#open_giro_inform').click(function(){$('#open_giro_inform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Open Giro In</h3>

<p>
<div id="open_giro_inoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/open_giro_inadd/submit" id="open_giro_inform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_giro_inlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
