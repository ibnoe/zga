<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#purchase_return_orderchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_return_orderconfirmdelete(delid, obj)
	{
		$('#purchase_return_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_orderconfirmdelete3(delid, obj));
	}

function purchase_return_orderconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_ordercalldeletefn('purchase_return_orderdelete', delid, 'purchase_return_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_order-dialog-confirm').html('');
	}
	
	function purchase_return_orderconfirmdelete3(delid, obj)
	{
		$( "#purchase_return_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_return_ordercalldeletefn3('purchase_return_orderdelete', delid, 'purchase_return_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_order-dialog-confirm').html('');
	}

function purchase_return_ordercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_return_ordercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_return_order-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Return Order</h3>

<?=form_hidden("purchase_return_order_id", $purchase_return_order_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$purchasereturnorder__date;?></td></tr><tr class='basic'>
<td>Return ID</td><td><?=$purchasereturnorder__purchasereturnorderid;?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=isset($supplier_opt[$purchasereturnorder__supplier_id])?$supplier_opt[$purchasereturnorder__supplier_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$purchasereturnorder__currency_id])?$currency_opt[$purchasereturnorder__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($purchasereturnorder__currencyrate, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$purchasereturnorder__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchasereturnorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchasereturnorder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchasereturnorder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchasereturnorder__createdby;?></td></tr>

</table>

<br>
<div id="purchase_return_orderbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_orderedit/index/".$purchase_return_order_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_orderconfirmdelete(<?=$purchase_return_order_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_return_orderchildtabs">
	
	<ul><li><a href='<?=site_url()."/purchase_return_order_line_viewlist/index/".$purchase_return_order_id;?>'>Purchase Return Order Line View</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_orderlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
