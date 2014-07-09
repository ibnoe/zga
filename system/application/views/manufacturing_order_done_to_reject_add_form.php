<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#manufacturing_order_done_to_rejectoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/manufacturing_order_done_to_rejectview/index/' },
		}; 
		
		$('#manufacturing_order_done_to_rejectform').click(function(){$('#manufacturing_order_done_to_rejectform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Manufacturing Order Done To Reject</h3>

<p>
<div id="manufacturing_order_done_to_rejectoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/manufacturing_order_done_to_rejectadd/submit" id="manufacturing_order_done_to_rejectform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_done_to_rejectlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
