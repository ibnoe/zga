<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_return_for_invoicingoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sales_return_for_invoicingview/index/' },
		}; 
		
		$('#sales_return_for_invoicingform').click(function(){$('#sales_return_for_invoicingform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Return For Invoicing</h3>

<p>
<div id="sales_return_for_invoicingoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_for_invoicingadd/submit" id="sales_return_for_invoicingform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_for_invoicinglist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
