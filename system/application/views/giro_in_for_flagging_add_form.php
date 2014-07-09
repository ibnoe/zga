<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#giro_in_for_flaggingoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/giro_in_for_flaggingview/index/' },
		}; 
		
		$('#giro_in_for_flaggingform').click(function(){$('#giro_in_for_flaggingform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Giro In For Flagging</h3>

<p>
<div id="giro_in_for_flaggingoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_in_for_flaggingadd/submit" id="giro_in_for_flaggingform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_in_for_flagginglist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
