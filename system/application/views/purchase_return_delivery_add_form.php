<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_deliveryoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_return_deliveryview/index/' },
		}; 
		
		$('#purchase_return_deliveryform').click(function(){$('#purchase_return_deliveryform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Delivery</h3>

<p>
<div id="purchase_return_deliveryoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_deliveryadd/submit" id="purchase_return_deliveryform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchasereturndelivery__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchasereturndelivery__date', 'value' => $purchasereturndelivery__date, 'class' => 'purchasereturndelivery__datebasic'));?></td></tr>
<tr class='basic'>
<td>Delivery No *</td>
<td><?=form_input(array('name' => 'purchasereturndelivery__purchasereturndeliveryid', 'value' => $purchasereturndelivery__purchasereturndeliveryid, 'class' => 'basic', 'id' => 'purchasereturndelivery__purchasereturndeliveryid'));?></td></tr>
<tr class='basic'>
<td>Supplier *</td>
<?php if ($purchasereturndelivery__supplier_id > 0): ?>
<td><?=$supplier_opt[$purchasereturndelivery__supplier_id];?></td>
<?=form_hidden('purchasereturndelivery__supplier_id', $purchasereturndelivery__supplier_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasereturndelivery__supplier_id', $supplier_opt, $purchasereturndelivery__supplier_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Warehouse *</td>
<?php if ($purchasereturndelivery__warehouse_id > 0): ?>
<td><?=$warehouse_opt[$purchasereturndelivery__warehouse_id];?></td>
<?=form_hidden('purchasereturndelivery__warehouse_id', $purchasereturndelivery__warehouse_id);?>
<?php else: ?>
<td><?=form_dropdown('purchasereturndelivery__warehouse_id', $warehouse_opt, $purchasereturndelivery__warehouse_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'purchasereturndelivery__notes', 'value' => $purchasereturndelivery__notes, 'class' => 'basic', 'id' => 'purchasereturndelivery__notes'));?></td></tr>
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
</th><?php foreach ($purchasereturndeliveryline_data as $row): ?>
<tr>
<td><?=$item_opt[$row['purchasereturndeliveryline__item_id']];?></td>
<?=form_hidden('purchasereturndeliveryline__item_id[]', $row['purchasereturndeliveryline__item_id']);?>
<td><?=form_input(array('name' => 'purchasereturndeliveryline__quantitytosend[]', 'value' => $row['purchasereturndeliveryline__quantitytosend'], 'class' => 'basic', 'id' => 'purchasereturndeliveryline__quantitytosend[]'));?></td>
<td><?=$uom_opt[$row['purchasereturndeliveryline__uom_id']];?></td>
<?=form_hidden('purchasereturndeliveryline__uom_id[]', $row['purchasereturndeliveryline__uom_id']);?>
<?=form_hidden('purchasereturndeliveryline__purchasereturnorderline_id[]', $row['purchasereturndeliveryline__purchasereturnorderline_id']);?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_deliverylist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
