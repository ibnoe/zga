<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#receive_itemsoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/receive_itemsview/index/' },
		}; 
		
		$('#receive_itemsform').click(function(){$('#receive_itemsform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Receive Items</h3>

<p>
<div id="receive_itemsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/receive_itemsadd/submit" id="receive_itemsform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".receiveditem__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'receiveditem__date', 'value' => $receiveditem__date, 'class' => 'receiveditem__datebasic'));?></td></tr>
<tr class='basic'>
<td>Receive Item No *</td>
<td><?=form_input(array('name' => 'receiveditem__orderid', 'value' => $receiveditem__orderid, 'class' => 'basic', 'id' => 'receiveditem__orderid'));?></td></tr>
<tr class='basic'>
<td>Surat Jalan No *</td>
<td><?=form_input(array('name' => 'receiveditem__suratjalanno', 'value' => $receiveditem__suratjalanno, 'class' => 'basic', 'id' => 'receiveditem__suratjalanno'));?></td></tr>
<tr class='basic'>
<td>Supplier *</td>
<?php if ($receiveditem__supplier_id > 0): ?>
<td><?=$supplier_opt[$receiveditem__supplier_id];?></td>
<?=form_hidden('receiveditem__supplier_id', $receiveditem__supplier_id);?>
<?php else: ?>
<td><?=form_dropdown('receiveditem__supplier_id', $supplier_opt, $receiveditem__supplier_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Warehouse *</td>
<?php if ($receiveditem__warehouse_id > 0): ?>
<td><?=$warehouse_opt[$receiveditem__warehouse_id];?></td>
<?=form_hidden('receiveditem__warehouse_id', $receiveditem__warehouse_id);?>
<?php else: ?>
<td><?=form_dropdown('receiveditem__warehouse_id', $warehouse_opt, $receiveditem__warehouse_id, 'class="basic"');?></td>
<?php endif; ?></tr>
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
</th>
<th>Serial No
</th>
<th>Expired Date
</th>
<th>HS Code
</th>
<th>Packing List
</th><?php foreach ($receiveditemline_data as $row): ?>
<tr>
<td><?=$item_opt[$row['receiveditemline__item_id']];?></td>
<?=form_hidden('receiveditemline__item_id[]', $row['receiveditemline__item_id']);?>
<td><?=form_input(array('name' => 'receiveditemline__quantitytoreceive[]', 'value' => $row['receiveditemline__quantitytoreceive'], 'class' => 'basic', 'id' => 'receiveditemline__quantitytoreceive[]'));?></td>
<td><?=$uom_opt[$row['receiveditemline__uom_id']];?></td>
<?=form_hidden('receiveditemline__uom_id[]', $row['receiveditemline__uom_id']);?>
<?=form_hidden('receiveditemline__purchaseorderline_id[]', $row['receiveditemline__purchaseorderline_id']);?>
<td><?=form_input(array('name' => 'receiveditemline__serialno[]', 'value' => $row['receiveditemline__serialno'], 'class' => 'basic', 'id' => 'receiveditemline__serialno[]'));?></td><script type="text/javascript">$(document).ready(function() {$(".receiveditemline__expireddatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'receiveditemline__expireddate[]', 'value' => $row['receiveditemline__expireddate'], 'class' => 'receiveditemline__expireddatebasic'));?></td>
<td><?=form_input(array('name' => 'receiveditemline__hscode[]', 'value' => $row['receiveditemline__hscode'], 'class' => 'basic', 'id' => 'receiveditemline__hscode[]'));?></td>
<td><?=form_input(array('name' => 'receiveditemline__packinglist[]', 'value' => $row['receiveditemline__packinglist'], 'class' => 'basic', 'id' => 'receiveditemline__packinglist[]'));?></td>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/receive_itemslist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
