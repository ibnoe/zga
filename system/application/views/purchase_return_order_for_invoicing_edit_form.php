<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_return_order_for_invoicingoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_return_order_for_invoicingeditform').click(function(){$('#purchase_return_order_for_invoicingeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Return Order For Invoicing</h3>

<p>
<div id="purchase_return_order_for_invoicingoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_order_for_invoicingedit/submit" id="purchase_return_order_for_invoicingeditform" class="editform">

<?=form_hidden("purchase_return_order_for_invoicing_id", $purchase_return_order_for_invoicing_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_order_for_invoicinglist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


