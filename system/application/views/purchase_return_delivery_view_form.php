<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#purchase_return_deliverychildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_return_deliveryconfirmdelete(delid, obj)
	{
		$('#purchase_return_delivery-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_deliveryconfirmdelete3(delid, obj));
	}

function purchase_return_deliveryconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_delivery-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_deliverycalldeletefn('purchase_return_deliverydelete', delid, 'purchase_return_deliverylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_delivery-dialog-confirm').html('');
	}
	
	function purchase_return_deliveryconfirmdelete3(delid, obj)
	{
		$( "#purchase_return_delivery-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_return_deliverycalldeletefn3('purchase_return_deliverydelete', delid, 'purchase_return_deliverylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_delivery-dialog-confirm').html('');
	}

function purchase_return_deliverycalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_return_deliverycalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_return_delivery-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Return Delivery</h3>

<?=form_hidden("purchase_return_delivery_id", $purchase_return_delivery_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$purchasereturndelivery__date;?></td></tr><tr class='basic'>
<td>Delivery No</td><td><?=$purchasereturndelivery__purchasereturndeliveryid;?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=isset($supplier_opt[$purchasereturndelivery__supplier_id])?$supplier_opt[$purchasereturndelivery__supplier_id]:'';?></td></tr><tr class='basic'>
<td>Warehouse</td><td><?=isset($warehouse_opt[$purchasereturndelivery__warehouse_id])?$warehouse_opt[$purchasereturndelivery__warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$purchasereturndelivery__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchasereturndelivery__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchasereturndelivery__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchasereturndelivery__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchasereturndelivery__createdby;?></td></tr>

</table>

<br>
<div id="purchase_return_deliverybuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_deliveryedit/index/".$purchase_return_delivery_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_deliveryconfirmdelete(<?=$purchase_return_delivery_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_return_deliverychildtabs">
	
	<ul><li><a href='<?=site_url()."/purchase_return_delivery_line_viewlist/index/".$purchase_return_delivery_id;?>'>Purchase Return Delivery Line View</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_deliverylist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
