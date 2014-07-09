<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#receive_items_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function receive_items_lineconfirmdelete(delid, obj)
	{
		$('#receive_items_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', receive_items_lineconfirmdelete3(delid, obj));
	}

function receive_items_lineconfirmdelete2(delid, obj)
	{
		$( "#receive_items_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					receive_items_linecalldeletefn('receive_items_linedelete', delid, 'receive_items_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#receive_items_line-dialog-confirm').html('');
	}
	
	function receive_items_lineconfirmdelete3(delid, obj)
	{
		$( "#receive_items_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					receive_items_linecalldeletefn3('receive_items_linedelete', delid, 'receive_items_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#receive_items_line-dialog-confirm').html('');
	}

function receive_items_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function receive_items_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="receive_items_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Receive Items Line</h3>

<?=form_hidden("receive_items_line_id", $receive_items_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$receiveditemline__item_id])?$item_opt[$receiveditemline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($receiveditemline__quantitytoreceive, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$receiveditemline__uom_id])?$uom_opt[$receiveditemline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Serial No</td><td><?=$receiveditemline__serialno;?></td></tr><tr class='basic'>
<td>Expired Date</td><td><?=$receiveditemline__expireddate;?></td></tr><tr class='basic'>
<td>HS Code</td><td><?=$receiveditemline__hscode;?></td></tr><tr class='basic'>
<td>Packing List</td><td><?=$receiveditemline__packinglist;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$receiveditemline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$receiveditemline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$receiveditemline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$receiveditemline__createdby;?></td></tr>

</table>

<br>
<div id="receive_items_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/receive_items_lineedit/index/".$receive_items_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="receive_items_lineconfirmdelete(<?=$receive_items_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="receive_items_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/receive_items_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
