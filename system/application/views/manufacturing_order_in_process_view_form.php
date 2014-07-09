<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#manufacturing_order_in_processchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufacturing_order_in_processconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_in_process-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_in_processconfirmdelete3(delid, obj));
	}

function manufacturing_order_in_processconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_in_process-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_in_processcalldeletefn('manufacturing_order_in_processdelete', delid, 'manufacturing_order_in_processlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_in_process-dialog-confirm').html('');
	}
	
	function manufacturing_order_in_processconfirmdelete3(delid, obj)
	{
		$( "#manufacturing_order_in_process-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufacturing_order_in_processcalldeletefn3('manufacturing_order_in_processdelete', delid, 'manufacturing_order_in_processlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_in_process-dialog-confirm').html('');
	}

function manufacturing_order_in_processcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufacturing_order_in_processcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufacturing_order_in_process-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufacturing Order In Process</h3>

<?=form_hidden("manufacturing_order_in_process_id", $manufacturing_order_in_process_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$manufacturingorder__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$manufacturingorder__date;?></td></tr><tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$manufacturingorder__item_id])?$item_opt[$manufacturingorder__item_id]:'';?></td></tr><tr class='basic'>
<td>Raw Material Location</td><td><?=isset($warehouse_opt[$manufacturingorder__from_warehouse_id])?$warehouse_opt[$manufacturingorder__from_warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Finish Goods Location</td><td><?=isset($warehouse_opt[$manufacturingorder__to_warehouse_id])?$warehouse_opt[$manufacturingorder__to_warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Bill Of Material</td><td><?=isset($bom_opt[$manufacturingorder__bom_id])?$bom_opt[$manufacturingorder__bom_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($manufacturingorder__quantity, 2);?></td></tr><tr class='basic'>
<td>Quantity To Process</td><td><?=number_format($manufacturingorder__quantitytoprocess, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$manufacturingorder__uom_id])?$uom_opt[$manufacturingorder__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$manufacturingorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$manufacturingorder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$manufacturingorder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$manufacturingorder__createdby;?></td></tr>

</table>

<br>
<div id="manufacturing_order_in_processbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_in_processedit/index/".$manufacturing_order_in_process_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_in_processconfirmdelete(<?=$manufacturing_order_in_process_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufacturing_order_in_processchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_in_processlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
