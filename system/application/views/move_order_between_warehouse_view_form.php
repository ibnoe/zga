<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#move_order_between_warehousechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View move_order_between_warehouse</h3>

<?=form_hidden("move_order_between_warehouse_id", $move_order_between_warehouse_id);?>

<table width="100%">


</table>

<br>
<div id="move_order_between_warehousebuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/move_order_between_warehouseedit/index/".$move_order_between_warehouse_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="move_order_between_warehousechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/move_order_between_warehouselist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
