<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#insert_item_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function insert_item_lineconfirmdelete(delid, obj)
	{
		$('#insert_item_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', insert_item_lineconfirmdelete3(delid, obj));
	}

function insert_item_lineconfirmdelete2(delid, obj)
	{
		$( "#insert_item_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					insert_item_linecalldeletefn('insert_item_linedelete', delid, 'insert_item_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#insert_item_line-dialog-confirm').html('');
	}
	
	function insert_item_lineconfirmdelete3(delid, obj)
	{
		$( "#insert_item_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					insert_item_linecalldeletefn3('insert_item_linedelete', delid, 'insert_item_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#insert_item_line-dialog-confirm').html('');
	}

function insert_item_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function insert_item_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="insert_item_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Insert Item Line</h3>

<?=form_hidden("insert_item_line_id", $insert_item_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Location</td><td><?=isset($warehouse_opt[$insertitemline__warehouse_id])?$warehouse_opt[$insertitemline__warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$insertitemline__item_id])?$item_opt[$insertitemline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($insertitemline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$insertitemline__uom_id])?$uom_opt[$insertitemline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$insertitemline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$insertitemline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$insertitemline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$insertitemline__createdby;?></td></tr>

</table>

<br>
<div id="insert_item_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/insert_item_lineedit/index/".$insert_item_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="insert_item_lineconfirmdelete(<?=$insert_item_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="insert_item_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/insert_item_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
