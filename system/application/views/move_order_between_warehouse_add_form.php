<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#move_order_between_warehouseoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#move_order_between_warehouseform').click(function(){$('#move_order_between_warehouseform').ajaxForm(options);});
	
  });
  </script>

<h3>New move_order_between_warehouse</h3>

<p>
<div id="move_order_between_warehouseoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/move_order_between_warehouseadd/submit" id="move_order_between_warehouseform">

<table width="100%">

<tr class='basic'><td>Order ID *</td><td><?=form_input(array('name' => 'porder__orderid', 'value' => $porder__orderid, 'class' => 'basic', 'id' => 'porder__orderid'));?></td></tr><script type="text/javascript">$(document).ready(function() {$("#porder__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<tr class='basic'><td>Date</td><td><?=form_input(array('name' => 'porder__date', 'value' => $porder__date, 'class' => 'basic', 'id' => 'porder__date'));?></td></tr>
<tr class='basic'><td>Description</td><td><?=form_input(array('name' => 'porder__notes', 'value' => $porder__notes, 'class' => 'basic', 'id' => 'porder__notes'));?></td></tr>
<tr class='basic'><td>From Location</td><td><?=form_dropdown('porder__from_id', $contact_opt, $porder__from_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>To Location</td><td><?=form_dropdown('porder__to_id', $contact_opt, $porder__to_id, 'class="basic"');?></td></tr>
<tr class='basic'><td>Details</td><td><?=form_input(array('name' => 'porder__', 'value' => $porder__, 'class' => 'basic', 'id' => 'porder__'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/move_order_between_warehouselist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
