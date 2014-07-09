<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_order_quote_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#purchase_order_quote_lineform').click(function(){$('#purchase_order_quote_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Order Quote Line</h3>

<p>
<div id="purchase_order_quote_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_order_quote_lineadd/submit" id="purchase_order_quote_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('purchaseorderquote_id', $purchaseorderquote_id);?>
<tr class='basic'>
<?=form_hidden('purchaseorderquoteline__orderid', $purchaseorderquoteline__orderid);?></tr>
<tr class='basic'>
<?=form_hidden('purchaseorderquoteline__date', $purchaseorderquoteline__date);?></tr>
<tr class='basic'>
<?=form_hidden('purchaseorderquoteline__notes', $purchaseorderquoteline__notes);?></tr>
<tr class='basic'>
<?=form_hidden('purchaseorderquoteline__supplier_id', $purchaseorderquoteline__supplier_id);?></tr>
<tr class='basic'>
<?=form_hidden('purchaseorderquoteline__currency_id', $purchaseorderquoteline__currency_id);?></tr>
<tr class='basic'>
<?=form_hidden('purchaseorderquoteline__currencyrate', $purchaseorderquoteline__currencyrate);?></tr>
<tr class='basic'>
<?=form_hidden('purchaseorderquoteline__warehouse_id', $purchaseorderquoteline__warehouse_id);?></tr>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('purchaseorderquoteline__item_id', $item_opt, $purchaseorderquoteline__item_id, 'class="basic"');?></td></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'purchaseorderquoteline__quantity', 'value' => $purchaseorderquoteline__quantity, 'class' => 'basic', 'id' => 'purchaseorderquoteline__quantity'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('purchaseorderquoteline__uom_id', $uom_opt, $purchaseorderquoteline__uom_id, 'class="basic"');?></td></tr>
<tr class='basic'>
<td>Price *</td>
<td><?=form_input(array('name' => 'purchaseorderquoteline__price', 'value' => $purchaseorderquoteline__price, 'class' => 'basic', 'id' => 'purchaseorderquoteline__price'));?></td></tr>
<tr class='basic'>
<?=form_hidden('purchaseorderquoteline__subtotal', $purchaseorderquoteline__subtotal);?></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=$_SERVER['HTTP_REFERER'];?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
