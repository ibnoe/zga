<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#open_sales_invoice_for_paymentoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#open_sales_invoice_for_paymenteditform').click(function(){$('#open_sales_invoice_for_paymenteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Open Sales Invoice For Payment</h3>

<p>
<div id="open_sales_invoice_for_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/open_sales_invoice_for_paymentedit/submit" id="open_sales_invoice_for_paymenteditform" class="editform">

<?=form_hidden("open_sales_invoice_for_payment_id", $open_sales_invoice_for_payment_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_sales_invoice_for_paymentlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


