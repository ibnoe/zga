<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#stock_movementchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function stock_movementconfirmdelete(delid, obj)
	{
		$('#stock_movement-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', stock_movementconfirmdelete3(delid, obj));
	}

function stock_movementconfirmdelete2(delid, obj)
	{
		$( "#stock_movement-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					stock_movementcalldeletefn('stock_movementdelete', delid, 'stock_movementlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_movement-dialog-confirm').html('');
	}
	
	function stock_movementconfirmdelete3(delid, obj)
	{
		$( "#stock_movement-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					stock_movementcalldeletefn3('stock_movementdelete', delid, 'stock_movementlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_movement-dialog-confirm').html('');
	}

function stock_movementcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function stock_movementcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="stock_movement-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Stock Movement</h3>

<?=form_hidden("stock_movement_id", $stock_movement_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$moveaction__date;?></td></tr><tr class='basic'>
<td>ID</td><td><?=$moveaction__orderid;?></td></tr><tr class='basic'>
<td>From Warehouse</td><td><?=isset($warehouse_opt[$moveaction__from_warehouse_id])?$warehouse_opt[$moveaction__from_warehouse_id]:'';?></td></tr><tr class='basic'>
<td>To Warehouse</td><td><?=isset($warehouse_opt[$moveaction__to_warehouse_id])?$warehouse_opt[$moveaction__to_warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$moveaction__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$moveaction__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$moveaction__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$moveaction__createdby;?></td></tr>

</table>

<br>
<div id="stock_movementbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/stock_movementedit/index/".$stock_movement_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="stock_movementconfirmdelete(<?=$stock_movement_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="stock_movementchildtabs">
	
	<ul><li><a href='<?=site_url()."/stock_movement_line_viewlist/index/".$stock_movement_id;?>'>Stock Movement Line View</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/stock_movementlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
