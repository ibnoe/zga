<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#delivery_orderchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function delivery_orderconfirmdelete(delid, obj)
	{
		$('#delivery_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', delivery_orderconfirmdelete3(delid, obj));
	}

function delivery_orderconfirmdelete2(delid, obj)
	{
		$( "#delivery_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					delivery_ordercalldeletefn('delivery_orderdelete', delid, 'delivery_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#delivery_order-dialog-confirm').html('');
	}
	
	function delivery_orderconfirmdelete3(delid, obj)
	{
		$( "#delivery_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					delivery_ordercalldeletefn3('delivery_orderdelete', delid, 'delivery_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#delivery_order-dialog-confirm').html('');
	}

function delivery_ordercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function delivery_ordercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="delivery_order-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Delivery Order</h3>

<?=form_hidden("delivery_order_id", $delivery_order_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$deliveryorder__date;?></td></tr><tr class='basic'>
<td>Delivery Order No</td><td><?=$deliveryorder__orderid;?></td></tr><tr class='basic'>
<td>DO Number</td><td><?=$deliveryorder__donum;?></td></tr><tr class='basic'>
<td>DO Date</td><td><?=$deliveryorder__dodate;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$deliveryorder__customer_id])?$customer_opt[$deliveryorder__customer_id]:'';?></td></tr><tr class='basic'>
<td>Warehouse</td><td><?=isset($warehouse_opt[$deliveryorder__warehouse_id])?$warehouse_opt[$deliveryorder__warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Delivered By</td><td><?=$deliveryorder__deliveredby;?></td></tr><tr class='basic'>
<td>Vehicle Number</td><td><?=$deliveryorder__vehicleno;?></td></tr><tr class='basic'>
<td>Special Instruction</td><td><?=$deliveryorder__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$deliveryorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$deliveryorder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$deliveryorder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$deliveryorder__createdby;?></td></tr>

</table>

<br>
<div id="delivery_orderbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/delivery_orderedit/index/".$delivery_order_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="delivery_orderconfirmdelete(<?=$delivery_order_id;?>, this);"></td>
<td class="print"><input class="button" type="button" value="Print" onclick="location.href='<?=site_url()."/printing/index/delivery_order/".$delivery_order_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="delivery_orderchildtabs">
	
	<ul><li><a href='<?=site_url()."/delivery_order_line_viewlist/index/".$delivery_order_id;?>'>Delivery Order Line View</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/delivery_orderlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
