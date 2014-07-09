<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#manufacturing_order_already_donechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufacturing_order_already_doneconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_already_done-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_already_doneconfirmdelete3(delid, obj));
	}

function manufacturing_order_already_doneconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_already_done-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_already_donecalldeletefn('manufacturing_order_already_donedelete', delid, 'manufacturing_order_already_donelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_already_done-dialog-confirm').html('');
	}
	
	function manufacturing_order_already_doneconfirmdelete3(delid, obj)
	{
		$( "#manufacturing_order_already_done-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufacturing_order_already_donecalldeletefn3('manufacturing_order_already_donedelete', delid, 'manufacturing_order_already_donelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_already_done-dialog-confirm').html('');
	}

function manufacturing_order_already_donecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufacturing_order_already_donecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufacturing_order_already_done-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufacturing Order Already Done</h3>

<?=form_hidden("manufacturing_order_already_done_id", $manufacturing_order_already_done_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$manufacturingorder__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$manufacturingorder__date;?></td></tr><tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$manufacturingorder__item_id])?$item_opt[$manufacturingorder__item_id]:'';?></td></tr><tr class='basic'>
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
<div id="manufacturing_order_already_donebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_already_doneedit/index/".$manufacturing_order_already_done_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_already_doneconfirmdelete(<?=$manufacturing_order_already_done_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufacturing_order_already_donechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_already_donelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
