<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_order_quote_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_order_quote_lineeditform').click(function(){$('#purchase_order_quote_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Order Quote Line</h3>

<p>
<div id="purchase_order_quote_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_order_quote_lineedit/submit" id="purchase_order_quote_lineeditform" class="editform">

<?=form_hidden("purchase_order_quote_line_id", $purchase_order_quote_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>No PO Quote</td><td><?=form_input(array('name' => 'purchaseorderquoteline__orderid', 'value' => $purchaseorderquoteline__orderid, 'id' => 'purchaseorderquoteline__orderid'));?></td></tr><tr class='basic'>
<td>Date</td><td><?=form_input(array('name' => 'purchaseorderquoteline__date', 'value' => $purchaseorderquoteline__date, 'id' => 'purchaseorderquoteline__date'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'purchaseorderquoteline__notes', 'value' => $purchaseorderquoteline__notes, 'id' => 'purchaseorderquoteline__notes'));?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=form_input(array('name' => 'purchaseorderquoteline__supplier_id', 'value' => $purchaseorderquoteline__supplier_id, 'id' => 'purchaseorderquoteline__supplier_id'));?></td></tr><tr class='basic'>
<td>Currency</td><td><?=form_input(array('name' => 'purchaseorderquoteline__currency_id', 'value' => $purchaseorderquoteline__currency_id, 'id' => 'purchaseorderquoteline__currency_id'));?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=form_input(array('name' => 'purchaseorderquoteline__currencyrate', 'value' => $purchaseorderquoteline__currencyrate, 'id' => 'purchaseorderquoteline__currencyrate'));?></td></tr><tr class='basic'>
<td>Ship To Location</td><td><?=form_input(array('name' => 'purchaseorderquoteline__warehouse_id', 'value' => $purchaseorderquoteline__warehouse_id, 'id' => 'purchaseorderquoteline__warehouse_id'));?></td></tr><tr class='basic'>
<td>Item *</td><td><?=form_dropdown('purchaseorderquoteline__item_id', $item_opt, $purchaseorderquoteline__item_id);?></td></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'purchaseorderquoteline__quantity', 'value' => $purchaseorderquoteline__quantity, 'id' => 'purchaseorderquoteline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('purchaseorderquoteline__uom_id', $uom_opt, $purchaseorderquoteline__uom_id);?></td></tr><tr class='basic'>
<td>Price *</td><td><?=form_input(array('name' => 'purchaseorderquoteline__price', 'value' => $purchaseorderquoteline__price, 'id' => 'purchaseorderquoteline__price'));?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=form_input(array('name' => 'purchaseorderquoteline__subtotal', 'value' => $purchaseorderquoteline__subtotal, 'id' => 'purchaseorderquoteline__subtotal'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_order_quote_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


