<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_return_order_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_return_order_lineconfirmdelete(delid, obj)
	{
		$('#sales_return_order_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_order_lineconfirmdelete3(delid, obj));
	}

function sales_return_order_lineconfirmdelete2(delid, obj)
	{
		$( "#sales_return_order_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_order_linecalldeletefn('sales_return_order_linedelete', delid, 'sales_return_order_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_order_line-dialog-confirm').html('');
	}
	
	function sales_return_order_lineconfirmdelete3(delid, obj)
	{
		$( "#sales_return_order_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_return_order_linecalldeletefn3('sales_return_order_linedelete', delid, 'sales_return_order_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_order_line-dialog-confirm').html('');
	}

function sales_return_order_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_return_order_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_return_order_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Return Order Line</h3>

<?=form_hidden("sales_return_order_line_id", $sales_return_order_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$salesreturnorderline__item_id])?$item_opt[$salesreturnorderline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($salesreturnorderline__quantitytoreceive, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$salesreturnorderline__uom_id])?$uom_opt[$salesreturnorderline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesreturnorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesreturnorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesreturnorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesreturnorderline__createdby;?></td></tr>

</table>

<br>
<div id="sales_return_order_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_order_lineedit/index/".$sales_return_order_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_order_lineconfirmdelete(<?=$sales_return_order_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_return_order_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_order_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
