<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#reject_manufacturing_line_viewchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function reject_manufacturing_line_viewconfirmdelete(delid, obj)
	{
		$('#reject_manufacturing_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', reject_manufacturing_line_viewconfirmdelete3(delid, obj));
	}

function reject_manufacturing_line_viewconfirmdelete2(delid, obj)
	{
		$( "#reject_manufacturing_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					reject_manufacturing_line_viewcalldeletefn('reject_manufacturing_line_viewdelete', delid, 'reject_manufacturing_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#reject_manufacturing_line_view-dialog-confirm').html('');
	}
	
	function reject_manufacturing_line_viewconfirmdelete3(delid, obj)
	{
		$( "#reject_manufacturing_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					reject_manufacturing_line_viewcalldeletefn3('reject_manufacturing_line_viewdelete', delid, 'reject_manufacturing_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#reject_manufacturing_line_view-dialog-confirm').html('');
	}

function reject_manufacturing_line_viewcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function reject_manufacturing_line_viewcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="reject_manufacturing_line_view-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Reject Manufacturing Line View</h3>

<?=form_hidden("reject_manufacturing_line_view_id", $reject_manufacturing_line_view_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$rejectmanufacturingline__item_id])?$item_opt[$rejectmanufacturingline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($rejectmanufacturingline__quantitytoprocess, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$rejectmanufacturingline__uom_id])?$uom_opt[$rejectmanufacturingline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$rejectmanufacturingline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$rejectmanufacturingline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$rejectmanufacturingline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$rejectmanufacturingline__createdby;?></td></tr>

</table>

<br>
<div id="reject_manufacturing_line_viewbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/reject_manufacturing_line_viewedit/index/".$reject_manufacturing_line_view_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="reject_manufacturing_line_viewconfirmdelete(<?=$reject_manufacturing_line_view_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="reject_manufacturing_line_viewchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/reject_manufacturing_line_viewlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
