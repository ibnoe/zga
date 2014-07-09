<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_order_line_optionsoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_return_order_line_optionsview/index/' },
		}; 
		
		$('#purchase_return_order_line_optionsform').click(function(){$('#purchase_return_order_line_optionsform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Order Line Options</h3>

<p>
<div id="purchase_return_order_line_optionsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_order_line_optionsadd/submit" id="purchase_return_order_line_optionsform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_order_line_optionslist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
