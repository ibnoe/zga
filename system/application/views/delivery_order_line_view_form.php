<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#delivery_order_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function delivery_order_lineconfirmdelete(delid, obj)
	{
		$('#delivery_order_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', delivery_order_lineconfirmdelete3(delid, obj));
	}

function delivery_order_lineconfirmdelete2(delid, obj)
	{
		$( "#delivery_order_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					delivery_order_linecalldeletefn('delivery_order_linedelete', delid, 'delivery_order_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#delivery_order_line-dialog-confirm').html('');
	}
	
	function delivery_order_lineconfirmdelete3(delid, obj)
	{
		$( "#delivery_order_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					delivery_order_linecalldeletefn3('delivery_order_linedelete', delid, 'delivery_order_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#delivery_order_line-dialog-confirm').html('');
	}

function delivery_order_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function delivery_order_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="delivery_order_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Delivery Order Line</h3>

<?=form_hidden("delivery_order_line_id", $delivery_order_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$deliveryorderline__item_id])?$item_opt[$deliveryorderline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($deliveryorderline__quantitytosend, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$deliveryorderline__uom_id])?$uom_opt[$deliveryorderline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$deliveryorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$deliveryorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$deliveryorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$deliveryorderline__createdby;?></td></tr>

</table>

<br>
<div id="delivery_order_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/delivery_order_lineedit/index/".$delivery_order_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="delivery_order_lineconfirmdelete(<?=$delivery_order_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="delivery_order_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/delivery_order_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
