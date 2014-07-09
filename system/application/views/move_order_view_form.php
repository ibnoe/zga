<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#move_orderchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function move_orderconfirmdelete(delid, obj)
	{
		$('#move_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', move_orderconfirmdelete3(delid, obj));
	}

function move_orderconfirmdelete2(delid, obj)
	{
		$( "#move_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					move_ordercalldeletefn('move_orderdelete', delid, 'move_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#move_order-dialog-confirm').html('');
	}
	
	function move_orderconfirmdelete3(delid, obj)
	{
		$( "#move_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					move_ordercalldeletefn3('move_orderdelete', delid, 'move_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#move_order-dialog-confirm').html('');
	}

function move_ordercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function move_ordercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="move_order-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Move Order</h3>

<?=form_hidden("move_order_id", $move_order_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$moveorder__orderid;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$moveorder__date;?></td></tr><tr class='basic'>
<td>From Location</td><td><?=isset($warehouse_opt[$moveorder__from_warehouse_id])?$warehouse_opt[$moveorder__from_warehouse_id]:'';?></td></tr><tr class='basic'>
<td>To Location</td><td><?=isset($warehouse_opt[$moveorder__to_warehouse_id])?$warehouse_opt[$moveorder__to_warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$moveorder__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$moveorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$moveorder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$moveorder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$moveorder__createdby;?></td></tr>

</table>

<br>
<div id="move_orderbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/move_orderedit/index/".$move_order_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="move_orderconfirmdelete(<?=$move_order_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="move_orderchildtabs">
	
	<ul><li><a href='<?=site_url()."/move_order_linelist/index/".$move_order_id;?>'>Move Order Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/move_orderlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
