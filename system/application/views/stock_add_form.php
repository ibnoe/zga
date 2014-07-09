<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#stockoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/stockview/index/' },
		}; 
		
		$('#stockform').click(function(){$('#stockform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Stock</h3>

<p>
<div id="stockoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/stockadd/submit" id="stockform" class="addform">

<table width="100%" class="addtable">


</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/stocklist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
