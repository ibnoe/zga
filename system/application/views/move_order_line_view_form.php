<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#move_order_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function move_order_lineconfirmdelete(delid, obj)
	{
		$('#move_order_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', move_order_lineconfirmdelete3(delid, obj));
	}

function move_order_lineconfirmdelete2(delid, obj)
	{
		$( "#move_order_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					move_order_linecalldeletefn('move_order_linedelete', delid, 'move_order_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#move_order_line-dialog-confirm').html('');
	}
	
	function move_order_lineconfirmdelete3(delid, obj)
	{
		$( "#move_order_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					move_order_linecalldeletefn3('move_order_linedelete', delid, 'move_order_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#move_order_line-dialog-confirm').html('');
	}

function move_order_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function move_order_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="move_order_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Move Order Line</h3>

<?=form_hidden("move_order_line_id", $move_order_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$moveorderline__item_id])?$item_opt[$moveorderline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($moveorderline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$moveorderline__uom_id])?$uom_opt[$moveorderline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$moveorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$moveorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$moveorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$moveorderline__createdby;?></td></tr>

</table>

<br>
<div id="move_order_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/move_order_lineedit/index/".$move_order_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="move_order_lineconfirmdelete(<?=$move_order_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="move_order_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/move_order_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
