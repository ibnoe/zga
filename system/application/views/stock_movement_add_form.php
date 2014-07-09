<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#stock_movementoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/stock_movementview/index/' },
		}; 
		
		$('#stock_movementform').click(function(){$('#stock_movementform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Stock Movement</h3>

<p>
<div id="stock_movementoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/stock_movementadd/submit" id="stock_movementform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".moveaction__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'moveaction__date', 'value' => $moveaction__date, 'class' => 'moveaction__datebasic'));?></td></tr>
<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'moveaction__orderid', 'value' => $moveaction__orderid, 'class' => 'basic', 'id' => 'moveaction__orderid'));?></td></tr>
<tr class='basic'>
<td>From Warehouse</td>
<?php if ($moveaction__from_warehouse_id > 0): ?>
<td><?=$warehouse_opt[$moveaction__from_warehouse_id];?></td>
<?=form_hidden('moveaction__from_warehouse_id', $moveaction__from_warehouse_id);?>
<?php else: ?>
<td><?=form_dropdown('moveaction__from_warehouse_id', $warehouse_opt, $moveaction__from_warehouse_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>To Warehouse</td>
<?php if ($moveaction__to_warehouse_id > 0): ?>
<td><?=$warehouse_opt[$moveaction__to_warehouse_id];?></td>
<?=form_hidden('moveaction__to_warehouse_id', $moveaction__to_warehouse_id);?>
<?php else: ?>
<td><?=form_dropdown('moveaction__to_warehouse_id', $warehouse_opt, $moveaction__to_warehouse_id, 'class="basic"');?></td>
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
</th><?php foreach ($moveactionline_data as $row): ?>
<tr>
<td><?=$item_opt[$row['moveactionline__item_id']];?></td>
<?=form_hidden('moveactionline__item_id[]', $row['moveactionline__item_id']);?>
<td><?=form_input(array('name' => 'moveactionline__quantitytomove[]', 'value' => $row['moveactionline__quantitytomove'], 'class' => 'basic', 'id' => 'moveactionline__quantitytomove[]'));?></td>
<td><?=$uom_opt[$row['moveactionline__uom_id']];?></td>
<?=form_hidden('moveactionline__uom_id[]', $row['moveactionline__uom_id']);?>
<?=form_hidden('moveactionline__moveorderline_id[]', $row['moveactionline__moveorderline_id']);?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/stock_movementlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
