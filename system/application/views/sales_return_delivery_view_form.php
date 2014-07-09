<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#sales_return_deliverychildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_return_deliveryconfirmdelete(delid, obj)
	{
		$('#sales_return_delivery-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_deliveryconfirmdelete3(delid, obj));
	}

function sales_return_deliveryconfirmdelete2(delid, obj)
	{
		$( "#sales_return_delivery-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_deliverycalldeletefn('sales_return_deliverydelete', delid, 'sales_return_deliverylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_delivery-dialog-confirm').html('');
	}
	
	function sales_return_deliveryconfirmdelete3(delid, obj)
	{
		$( "#sales_return_delivery-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_return_deliverycalldeletefn3('sales_return_deliverydelete', delid, 'sales_return_deliverylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_delivery-dialog-confirm').html('');
	}

function sales_return_deliverycalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_return_deliverycalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_return_delivery-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Return Delivery</h3>

<?=form_hidden("sales_return_delivery_id", $sales_return_delivery_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$salesreturndelivery__date;?></td></tr><tr class='basic'>
<td>Delivery No</td><td><?=$salesreturndelivery__salesreturndeliveryid;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$salesreturndelivery__customer_id])?$customer_opt[$salesreturndelivery__customer_id]:'';?></td></tr><tr class='basic'>
<td>Warehouse</td><td><?=isset($warehouse_opt[$salesreturndelivery__warehouse_id])?$warehouse_opt[$salesreturndelivery__warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$salesreturndelivery__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesreturndelivery__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesreturndelivery__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesreturndelivery__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesreturndelivery__createdby;?></td></tr>

</table>

<br>
<div id="sales_return_deliverybuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_deliveryedit/index/".$sales_return_delivery_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_deliveryconfirmdelete(<?=$sales_return_delivery_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_return_deliverychildtabs">
	
	<ul><li><a href='<?=site_url()."/sales_return_delivery_linelist/index/".$sales_return_delivery_id;?>'>Sales Return Delivery Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_deliverylist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
