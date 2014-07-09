<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#delivery_orderoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/delivery_orderview/index/' },
		}; 
		
		$('#delivery_orderform').click(function(){$('#delivery_orderform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Delivery Order</h3>

<p>
<div id="delivery_orderoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/delivery_orderadd/submit" id="delivery_orderform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".deliveryorder__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'deliveryorder__date', 'value' => $deliveryorder__date, 'class' => 'deliveryorder__datebasic'));?></td></tr>
<tr class='basic'>
<td>Delivery Order No *</td>
<td><?=form_input(array('name' => 'deliveryorder__orderid', 'value' => $deliveryorder__orderid, 'class' => 'basic', 'id' => 'deliveryorder__orderid'));?></td></tr>
<tr class='basic'>
<td>DO Number</td>
<td><?=form_input(array('name' => 'deliveryorder__donum', 'value' => $deliveryorder__donum, 'class' => 'basic', 'id' => 'deliveryorder__donum'));?></td></tr>
<tr class='basic'>
<td>DO Date *</td><script type="text/javascript">$(document).ready(function() {$(".deliveryorder__dodatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'deliveryorder__dodate', 'value' => $deliveryorder__dodate, 'class' => 'deliveryorder__dodatebasic'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<?php if ($deliveryorder__customer_id > 0): ?>
<td><?=$customer_opt[$deliveryorder__customer_id];?></td>
<?=form_hidden('deliveryorder__customer_id', $deliveryorder__customer_id);?>
<?php else: ?>
<td><?=form_dropdown('deliveryorder__customer_id', $customer_opt, $deliveryorder__customer_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Warehouse *</td>
<?php if ($deliveryorder__warehouse_id > 0): ?>
<td><?=$warehouse_opt[$deliveryorder__warehouse_id];?></td>
<?=form_hidden('deliveryorder__warehouse_id', $deliveryorder__warehouse_id);?>
<?php else: ?>
<td><?=form_dropdown('deliveryorder__warehouse_id', $warehouse_opt, $deliveryorder__warehouse_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Delivered By</td>
<td><?=form_input(array('name' => 'deliveryorder__deliveredby', 'value' => $deliveryorder__deliveredby, 'class' => 'basic', 'id' => 'deliveryorder__deliveredby'));?></td></tr>
<tr class='basic'>
<td>Vehicle Number</td>
<td><?=form_input(array('name' => 'deliveryorder__vehicleno', 'value' => $deliveryorder__vehicleno, 'class' => 'basic', 'id' => 'deliveryorder__vehicleno'));?></td></tr>
<tr class='basic'>
<td>Special Instruction</td>
<td><?=form_textarea(array('name' => 'deliveryorder__notes', 'value' => $deliveryorder__notes, 'class' => 'basic', 'id' => 'deliveryorder__notes'));?></td></tr>
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
</th><?php foreach ($deliveryorderline_data as $row): ?>
<tr>
<td><?=$item_opt[$row['deliveryorderline__item_id']];?></td>
<?=form_hidden('deliveryorderline__item_id[]', $row['deliveryorderline__item_id']);?>
<td><?=form_input(array('name' => 'deliveryorderline__quantitytosend[]', 'value' => $row['deliveryorderline__quantitytosend'], 'class' => 'basic', 'id' => 'deliveryorderline__quantitytosend[]'));?></td>
<td><?=$uom_opt[$row['deliveryorderline__uom_id']];?></td>
<?=form_hidden('deliveryorderline__uom_id[]', $row['deliveryorderline__uom_id']);?>
<?=form_hidden('deliveryorderline__salesorderline_id[]', $row['deliveryorderline__salesorderline_id']);?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/delivery_orderlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
