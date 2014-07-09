<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#manufacturing_order_doneoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/manufacturing_order_doneview/index/' },
		}; 
		
		$('#manufacturing_order_doneform').click(function(){$('#manufacturing_order_doneform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Manufacturing Order Done</h3>

<p>
<div id="manufacturing_order_doneoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/manufacturing_order_doneadd/submit" id="manufacturing_order_doneform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'manufacturingorderdone__idstring', 'value' => $manufacturingorderdone__idstring, 'class' => 'basic', 'id' => 'manufacturingorderdone__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".manufacturingorderdone__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'manufacturingorderdone__date', 'value' => $manufacturingorderdone__date, 'class' => 'manufacturingorderdone__datebasic'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'manufacturingorderdone__notes', 'value' => $manufacturingorderdone__notes, 'class' => 'basic', 'id' => 'manufacturingorderdone__notes'));?></td></tr>
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
</th><?php foreach ($manufacturingorderdoneline_data as $row): ?>
<tr>
<?=form_hidden('manufacturingorderdoneline__idstring[]', $row['manufacturingorderdoneline__idstring']);?>
<?=form_hidden('manufacturingorderdoneline__date[]', $row['manufacturingorderdoneline__date']);?>
<?php if ($row['manufacturingorderdoneline__item_id'] > 0): ?>
<td><?=$item_opt[$row['manufacturingorderdoneline__item_id']];?></td>
<?=form_hidden('manufacturingorderdoneline__item_id[]', $row['manufacturingorderdoneline__item_id']);?>
<?php else: ?>
<td><?=form_dropdown('manufacturingorderdoneline__item_id[]', $item_opt, $row['manufacturingorderdoneline__item_id'], 'class="basic"');?></td>
<?php endif; ?>
<td><?=form_input(array('name' => 'manufacturingorderdoneline__quantitytoprocess[]', 'value' => $row['manufacturingorderdoneline__quantitytoprocess'], 'class' => 'basic', 'id' => 'manufacturingorderdoneline__quantitytoprocess[]'));?></td>
<?php if ($row['manufacturingorderdoneline__uom_id'] > 0): ?>
<td><?=$uom_opt[$row['manufacturingorderdoneline__uom_id']];?></td>
<?=form_hidden('manufacturingorderdoneline__uom_id[]', $row['manufacturingorderdoneline__uom_id']);?>
<?php else: ?>
<td><?=form_dropdown('manufacturingorderdoneline__uom_id[]', $uom_opt, $row['manufacturingorderdoneline__uom_id'], 'class="basic"');?></td>
<?php endif; ?>
<?=form_hidden('manufacturingorderdoneline__manufacturingorder_id[]', $row['manufacturingorderdoneline__manufacturingorder_id']);?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_donelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
