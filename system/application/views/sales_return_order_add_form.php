<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_return_orderoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sales_return_orderview/index/' },
		}; 
		
		$('#sales_return_orderform').click(function(){$('#sales_return_orderform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Return Order</h3>

<p>
<div id="sales_return_orderoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_orderadd/submit" id="sales_return_orderform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".salesreturnorder__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'salesreturnorder__date', 'value' => $salesreturnorder__date, 'class' => 'salesreturnorder__datebasic'));?></td></tr>
<tr class='basic'>
<td>Return ID *</td>
<td><?=form_input(array('name' => 'salesreturnorder__salesreturnorderid', 'value' => $salesreturnorder__salesreturnorderid, 'class' => 'basic', 'id' => 'salesreturnorder__salesreturnorderid'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<?php if ($salesreturnorder__customer_id > 0): ?>
<td><?=$customer_opt[$salesreturnorder__customer_id];?></td>
<?=form_hidden('salesreturnorder__customer_id', $salesreturnorder__customer_id);?>
<?php else: ?>
<td><?=form_dropdown('salesreturnorder__customer_id', $customer_opt, $salesreturnorder__customer_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency *</td>
<?php if ($salesreturnorder__currency_id > 0): ?>
<td><?=$currency_opt[$salesreturnorder__currency_id];?></td>
<?=form_hidden('salesreturnorder__currency_id', $salesreturnorder__currency_id);?>
<?php else: ?>
<td><?=form_dropdown('salesreturnorder__currency_id', $currency_opt, $salesreturnorder__currency_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Currency Rate</td>
<td><?=form_input(array('name' => 'salesreturnorder__currencyrate', 'value' => $salesreturnorder__currencyrate, 'class' => 'basic', 'id' => 'salesreturnorder__currencyrate'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'salesreturnorder__notes', 'value' => $salesreturnorder__notes, 'class' => 'basic', 'id' => 'salesreturnorder__notes'));?></td></tr>
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
</th><?php foreach ($salesreturnorderline_data as $row): ?>
<tr>
<td><?=$item_opt[$row['salesreturnorderline__item_id']];?></td>
<?=form_hidden('salesreturnorderline__item_id[]', $row['salesreturnorderline__item_id']);?>
<td><?=form_input(array('name' => 'salesreturnorderline__quantitytoreceive[]', 'value' => $row['salesreturnorderline__quantitytoreceive'], 'class' => 'basic', 'id' => 'salesreturnorderline__quantitytoreceive[]'));?></td>
<td><?=$uom_opt[$row['salesreturnorderline__uom_id']];?></td>
<?=form_hidden('salesreturnorderline__uom_id[]', $row['salesreturnorderline__uom_id']);?>
<?=form_hidden('salesreturnorderline__deliveryorderline_id[]', $row['salesreturnorderline__deliveryorderline_id']);?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_orderlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
