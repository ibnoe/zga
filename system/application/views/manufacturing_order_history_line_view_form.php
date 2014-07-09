<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#manufacturing_order_history_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufacturing_order_history_lineconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_history_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_history_lineconfirmdelete3(delid, obj));
	}

function manufacturing_order_history_lineconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_history_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_history_linecalldeletefn('manufacturing_order_history_linedelete', delid, 'manufacturing_order_history_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_history_line-dialog-confirm').html('');
	}
	
	function manufacturing_order_history_lineconfirmdelete3(delid, obj)
	{
		$( "#manufacturing_order_history_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufacturing_order_history_linecalldeletefn3('manufacturing_order_history_linedelete', delid, 'manufacturing_order_history_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_history_line-dialog-confirm').html('');
	}

function manufacturing_order_history_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufacturing_order_history_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufacturing_order_history_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufacturing Order History Line</h3>

<?=form_hidden("manufacturing_order_history_line_id", $manufacturing_order_history_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$manufacturingorderdoneline__item_id])?$item_opt[$manufacturingorderdoneline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($manufacturingorderdoneline__quantitytoprocess, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$manufacturingorderdoneline__uom_id])?$uom_opt[$manufacturingorderdoneline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$manufacturingorderdoneline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$manufacturingorderdoneline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$manufacturingorderdoneline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$manufacturingorderdoneline__createdby;?></td></tr>

</table>

<br>
<div id="manufacturing_order_history_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_history_lineedit/index/".$manufacturing_order_history_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_history_lineconfirmdelete(<?=$manufacturing_order_history_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufacturing_order_history_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_history_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
