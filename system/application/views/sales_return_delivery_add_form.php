<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_return_deliveryoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sales_return_deliveryview/index/' },
		}; 
		
		$('#sales_return_deliveryform').click(function(){$('#sales_return_deliveryform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Return Delivery</h3>

<p>
<div id="sales_return_deliveryoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_deliveryadd/submit" id="sales_return_deliveryform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".salesreturndelivery__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'salesreturndelivery__date', 'value' => $salesreturndelivery__date, 'class' => 'salesreturndelivery__datebasic'));?></td></tr>
<tr class='basic'>
<td>Delivery No *</td>
<td><?=form_input(array('name' => 'salesreturndelivery__salesreturndeliveryid', 'value' => $salesreturndelivery__salesreturndeliveryid, 'class' => 'basic', 'id' => 'salesreturndelivery__salesreturndeliveryid'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<?php if ($salesreturndelivery__customer_id > 0): ?>
<td><?=$customer_opt[$salesreturndelivery__customer_id];?></td>
<?=form_hidden('salesreturndelivery__customer_id', $salesreturndelivery__customer_id);?>
<?php else: ?>
<td><?=form_dropdown('salesreturndelivery__customer_id', $customer_opt, $salesreturndelivery__customer_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Warehouse *</td>
<?php if ($salesreturndelivery__warehouse_id > 0): ?>
<td><?=$warehouse_opt[$salesreturndelivery__warehouse_id];?></td>
<?=form_hidden('salesreturndelivery__warehouse_id', $salesreturndelivery__warehouse_id);?>
<?php else: ?>
<td><?=form_dropdown('salesreturndelivery__warehouse_id', $warehouse_opt, $salesreturndelivery__warehouse_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'salesreturndelivery__notes', 'value' => $salesreturndelivery__notes, 'class' => 'basic', 'id' => 'salesreturndelivery__notes'));?></td></tr>
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
</th><?php foreach ($salesreturndeliveryline_data as $row): ?>
<tr>
<td><?=$item_opt[$row['salesreturndeliveryline__item_id']];?></td>
<?=form_hidden('salesreturndeliveryline__item_id[]', $row['salesreturndeliveryline__item_id']);?>
<td><?=form_input(array('name' => 'salesreturndeliveryline__quantitytoreceive[]', 'value' => $row['salesreturndeliveryline__quantitytoreceive'], 'class' => 'basic', 'id' => 'salesreturndeliveryline__quantitytoreceive[]'));?></td>
<td><?=$uom_opt[$row['salesreturndeliveryline__uom_id']];?></td>
<?=form_hidden('salesreturndeliveryline__uom_id[]', $row['salesreturndeliveryline__uom_id']);?>
<?=form_hidden('salesreturndeliveryline__salesreturnorderline_id[]', $row['salesreturndeliveryline__salesreturnorderline_id']);?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_deliverylist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
