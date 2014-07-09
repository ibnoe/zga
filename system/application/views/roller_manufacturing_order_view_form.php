<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#roller_manufacturing_orderchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function roller_manufacturing_orderconfirmdelete(delid, obj)
	{
		$('#roller_manufacturing_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', roller_manufacturing_orderconfirmdelete3(delid, obj));
	}

function roller_manufacturing_orderconfirmdelete2(delid, obj)
	{
		$( "#roller_manufacturing_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					roller_manufacturing_ordercalldeletefn('roller_manufacturing_orderdelete', delid, 'roller_manufacturing_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roller_manufacturing_order-dialog-confirm').html('');
	}
	
	function roller_manufacturing_orderconfirmdelete3(delid, obj)
	{
		$( "#roller_manufacturing_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					roller_manufacturing_ordercalldeletefn3('roller_manufacturing_orderdelete', delid, 'roller_manufacturing_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roller_manufacturing_order-dialog-confirm').html('');
	}

function roller_manufacturing_ordercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function roller_manufacturing_ordercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="roller_manufacturing_order-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Roller Manufacturing Order</h3>

<?=form_hidden("roller_manufacturing_order_id", $roller_manufacturing_order_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$manufacturingorder__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$manufacturingorder__date;?></td></tr><tr class='basic'>
<td>RCN</td><td><?=isset($rcn_opt[$manufacturingorder__rcn_id])?$rcn_opt[$manufacturingorder__rcn_id]:'';?></td></tr><tr class='basic'>
<td>Roll</td><td><?=isset($item_opt[$manufacturingorder__item_id])?$item_opt[$manufacturingorder__item_id]:'';?></td></tr><tr class='basic'>
<td>Raw Material Location</td><td><?=isset($warehouse_opt[$manufacturingorder__from_warehouse_id])?$warehouse_opt[$manufacturingorder__from_warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Finish Goods Location</td><td><?=isset($warehouse_opt[$manufacturingorder__to_warehouse_id])?$warehouse_opt[$manufacturingorder__to_warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Bill Of Material</td><td><?=isset($bom_opt[$manufacturingorder__bom_id])?$bom_opt[$manufacturingorder__bom_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($manufacturingorder__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$manufacturingorder__uom_id])?$uom_opt[$manufacturingorder__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$manufacturingorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$manufacturingorder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$manufacturingorder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$manufacturingorder__createdby;?></td></tr>

</table>

<br>
<div id="roller_manufacturing_orderbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/roller_manufacturing_orderedit/index/".$roller_manufacturing_order_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="roller_manufacturing_orderconfirmdelete(<?=$roller_manufacturing_order_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="roller_manufacturing_orderchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/roller_manufacturing_orderlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
