<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_order_quoteoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_order_quoteeditform').click(function(){$('#purchase_order_quoteeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Order Quote</h3>

<p>
<div id="purchase_order_quoteoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_order_quoteedit/submit" id="purchase_order_quoteeditform" class="editform">

<?=form_hidden("purchase_order_quote_id", $purchase_order_quote_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>No PO Quote *</td><td><?=form_input(array('name' => 'purchaseorderquote__orderid', 'value' => $purchaseorderquote__orderid, 'id' => 'purchaseorderquote__orderid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#purchaseorderquote__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'purchaseorderquote__date', 'value' => $purchaseorderquote__date, 'class' => 'date', 'id' => 'purchaseorderquote__date'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'purchaseorderquote__notes', 'value' => $purchaseorderquote__notes, 'id' => 'purchaseorderquote__notes'));?></td></tr><tr class='basic'>
<td>SPP *</td><td><?=form_dropdown('purchaseorderquote__suratpermintaanpembelian_id', $suratpermintaanpembelian_opt, $purchaseorderquote__suratpermintaanpembelian_id);?></td></tr><tr class='basic'>
<td>Supplier *</td><td><?=form_dropdown('purchaseorderquote__supplier_id', $supplier_opt, $purchaseorderquote__supplier_id);?></td></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('purchaseorderquote__currency_id', $currency_opt, $purchaseorderquote__currency_id);?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=form_input(array('name' => 'purchaseorderquote__currencyrate', 'value' => $purchaseorderquote__currencyrate, 'id' => 'purchaseorderquote__currencyrate'));?></td></tr><tr class='basic'>
<td>Ship To Location *</td><td><?=form_dropdown('purchaseorderquote__warehouse_id', $warehouse_opt, $purchaseorderquote__warehouse_id);?></td></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_order_quotelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


