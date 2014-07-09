<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#reject_manufacturingoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/reject_manufacturingview/index/' },
		}; 
		
		$('#reject_manufacturingform').click(function(){$('#reject_manufacturingform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Reject Manufacturing</h3>

<p>
<div id="reject_manufacturingoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/reject_manufacturingadd/submit" id="reject_manufacturingform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'rejectmanufacturing__idstring', 'value' => $rejectmanufacturing__idstring, 'class' => 'basic', 'id' => 'rejectmanufacturing__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".rejectmanufacturing__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'rejectmanufacturing__date', 'value' => $rejectmanufacturing__date, 'class' => 'rejectmanufacturing__datebasic'));?></td></tr>
<tr class='basic'>
<td>Manufacturing Reject Reason *</td>
<?php if ($rejectmanufacturing__manufacturingrejectreason_id > 0): ?>
<td><?=$manufacturingrejectreason_opt[$rejectmanufacturing__manufacturingrejectreason_id];?></td>
<?=form_hidden('rejectmanufacturing__manufacturingrejectreason_id', $rejectmanufacturing__manufacturingrejectreason_id);?>
<?php else: ?>
<td><?=form_dropdown('rejectmanufacturing__manufacturingrejectreason_id', $manufacturingrejectreason_opt, $rejectmanufacturing__manufacturingrejectreason_id, 'class="basic"');?></td>
<?php endif; ?></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'rejectmanufacturing__notes', 'value' => $rejectmanufacturing__notes, 'class' => 'basic', 'id' => 'rejectmanufacturing__notes'));?></td></tr>
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
</th><?php foreach ($rejectmanufacturingline_data as $row): ?>
<tr>
<td><?=$item_opt[$row['rejectmanufacturingline__item_id']];?></td>
<?=form_hidden('rejectmanufacturingline__item_id[]', $row['rejectmanufacturingline__item_id']);?>
<td><?=form_input(array('name' => 'rejectmanufacturingline__quantitytoprocess[]', 'value' => $row['rejectmanufacturingline__quantitytoprocess'], 'class' => 'basic', 'id' => 'rejectmanufacturingline__quantitytoprocess[]'));?></td>
<td><?=$uom_opt[$row['rejectmanufacturingline__uom_id']];?></td>
<?=form_hidden('rejectmanufacturingline__uom_id[]', $row['rejectmanufacturingline__uom_id']);?>
<?=form_hidden('rejectmanufacturingline__manufacturingorderdoneline_id[]', $row['rejectmanufacturingline__manufacturingorderdoneline_id']);?>
</tr><?php endforeach; ?>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/reject_manufacturinglist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
