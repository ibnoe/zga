<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#stock_movement_line_viewchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function stock_movement_line_viewconfirmdelete(delid, obj)
	{
		$('#stock_movement_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', stock_movement_line_viewconfirmdelete3(delid, obj));
	}

function stock_movement_line_viewconfirmdelete2(delid, obj)
	{
		$( "#stock_movement_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					stock_movement_line_viewcalldeletefn('stock_movement_line_viewdelete', delid, 'stock_movement_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_movement_line_view-dialog-confirm').html('');
	}
	
	function stock_movement_line_viewconfirmdelete3(delid, obj)
	{
		$( "#stock_movement_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					stock_movement_line_viewcalldeletefn3('stock_movement_line_viewdelete', delid, 'stock_movement_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_movement_line_view-dialog-confirm').html('');
	}

function stock_movement_line_viewcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function stock_movement_line_viewcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="stock_movement_line_view-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Stock Movement Line View</h3>

<?=form_hidden("stock_movement_line_view_id", $stock_movement_line_view_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$moveactionline__item_id])?$item_opt[$moveactionline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($moveactionline__quantitytomove, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$moveactionline__uom_id])?$uom_opt[$moveactionline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$moveactionline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$moveactionline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$moveactionline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$moveactionline__createdby;?></td></tr>

</table>

<br>
<div id="stock_movement_line_viewbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/stock_movement_line_viewedit/index/".$stock_movement_line_view_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="stock_movement_line_viewconfirmdelete(<?=$stock_movement_line_view_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="stock_movement_line_viewchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/stock_movement_line_viewlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
