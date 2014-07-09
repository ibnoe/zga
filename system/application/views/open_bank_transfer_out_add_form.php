<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#open_bank_transfer_outoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/open_bank_transfer_outview/index/' },
		}; 
		
		$('#open_bank_transfer_outform').click(function(){$('#open_bank_transfer_outform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Open Bank Transfer Out</h3>

<p>
<div id="open_bank_transfer_outoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/open_bank_transfer_outadd/submit" id="open_bank_transfer_outform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_bank_transfer_outlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
