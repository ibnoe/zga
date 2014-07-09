<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#from_warehouseoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#from_warehouseeditform').click(function(){$('#from_warehouseeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit From Warehouse</h3>

<p>
<div id="from_warehouseoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/from_warehouseedit/submit" id="from_warehouseeditform" class="editform">

<?=form_hidden("from_warehouse_id", $from_warehouse_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'warehouse__name', 'value' => $warehouse__name, 'id' => 'warehouse__name'));?></td></tr><tr class='basic'>
<td>Address</td><td><?=form_input(array('name' => 'warehouse__address', 'value' => $warehouse__address, 'id' => 'warehouse__address'));?></td></tr><tr class='basic'>
<td>Phone</td><td><?=form_input(array('name' => 'warehouse__phone', 'value' => $warehouse__phone, 'id' => 'warehouse__phone'));?></td></tr><tr class='basic'>
<td>Fax</td><td><?=form_input(array('name' => 'warehouse__fax', 'value' => $warehouse__fax, 'id' => 'warehouse__fax'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/from_warehouselist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


