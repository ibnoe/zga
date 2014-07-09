<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_orderoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_return_orderview/index/' },
		}; 
		
		$('#purchase_return_orderform').click(function(){$('#purchase_return_orderform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Order</h3>

<p>
<div id="purchase_return_orderoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_orderadd/submit" id="purchase_return_orderform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchasereturnorder__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchasereturnorder__date', 'value' => $purchasereturnorder__date, 'class' => 'purchasereturnorder__datebasic'));?></td></tr>
<tr class='basic'>
<td>Return ID *</td>
<td><?=form_input(array('name' => 'purchasereturnorder__purchasereturnorderid', 'value' => $purchasereturnorder__purchasereturnorderid, 'class' => 'basic', 'id' => 'purchasereturnorder__purchasereturnorderid'));?></td></tr>
<tr class='basic'>
<td>Supplier *</td>
<?php if ($purchasereturnorder__supplier_id > 0): ?>
<td><?=$supplier_opt[$purchasereturnorder__supplier_id];?></td>
<?=form_hidden('purchasereturnorder__supplier_id', $purchasereturnorder__supplier_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasereturnorder__supplier_id', $supplier_opt, $purchasereturnorder__supplier_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency *</td>
<?php if ($purchasereturnorder__currency_id > 0): ?>
<td><?=$currency_opt[$purchasereturnorder__currency_id];?></td>
<?=form_hidden('purchasereturnorder__currency_id', $purchasereturnorder__currency_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasereturnorder__currency_id', $currency_opt, $purchasereturnorder__currency_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency Rate</td>
<td><?=form_input(array('name' => 'purchasereturnorder__currencyrate', 'value' => $purchasereturnorder__currencyrate, 'class' => 'basic', 'id' => 'purchasereturnorder__currencyrate'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'purchasereturnorder__notes', 'value' => $purchasereturnorder__notes, 'class' => 'basic', 'id' => 'purchasereturnorder__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>


<table>
<th>Item
</th>
<th>Quantity
</th>
<th>Unit
</th><?php foreach ($purchasereturnorderline_data as $row): ?>
<tr>
<td><?=$item_opt[$row['purchasereturnorderline__item_id']];?></td>
<?=form_hidden('purchasereturnorderline__item_id[]', $row['purchasereturnorderline__item_id']);?>
<td><?=form_input(array('name' => 'purchasereturnorderline__quantitytosend[]', 'value' => $row['purchasereturnorderline__quantitytosend'], 'class' => 'basic', 'id' => 'purchasereturnorderline__quantitytosend[]'));?></td>
<td><?=$uom_opt[$row['purchasereturnorderline__uom_id']];?></td>
<?=form_hidden('purchasereturnorderline__uom_id[]', $row['purchasereturnorderline__uom_id']);?>
<?=form_hidden('purchasereturnorderline__receiveditemline_id[]', $row['purchasereturnorderline__receiveditemline_id']);?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_orderlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
