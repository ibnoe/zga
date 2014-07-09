<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#open_purchase_return_invoice_for_paymentoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/open_purchase_return_invoice_for_paymentview/index/' },
		}; 
		
		$('#open_purchase_return_invoice_for_paymentform').click(function(){$('#open_purchase_return_invoice_for_paymentform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Open Purchase Return Invoice For Payment</h3>

<p>
<div id="open_purchase_return_invoice_for_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/open_purchase_return_invoice_for_paymentadd/submit" id="open_purchase_return_invoice_for_paymentform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_purchase_return_invoice_for_paymentlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
