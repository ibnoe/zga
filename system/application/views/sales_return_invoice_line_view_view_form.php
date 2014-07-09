<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_return_invoice_line_viewchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_return_invoice_line_viewconfirmdelete(delid, obj)
	{
		$('#sales_return_invoice_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_invoice_line_viewconfirmdelete3(delid, obj));
	}

function sales_return_invoice_line_viewconfirmdelete2(delid, obj)
	{
		$( "#sales_return_invoice_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_invoice_line_viewcalldeletefn('sales_return_invoice_line_viewdelete', delid, 'sales_return_invoice_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_invoice_line_view-dialog-confirm').html('');
	}
	
	function sales_return_invoice_line_viewconfirmdelete3(delid, obj)
	{
		$( "#sales_return_invoice_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_return_invoice_line_viewcalldeletefn3('sales_return_invoice_line_viewdelete', delid, 'sales_return_invoice_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_invoice_line_view-dialog-confirm').html('');
	}

function sales_return_invoice_line_viewcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_return_invoice_line_viewcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_return_invoice_line_view-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Return Invoice Line View</h3>

<?=form_hidden("sales_return_invoice_line_view_id", $sales_return_invoice_line_view_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$salesreturninvoiceline__item_id])?$item_opt[$salesreturninvoiceline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($salesreturninvoiceline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$salesreturninvoiceline__uom_id])?$uom_opt[$salesreturninvoiceline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Price</td><td><?=number_format($salesreturninvoiceline__price, 2);?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=number_format($salesreturninvoiceline__subtotal, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesreturninvoiceline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesreturninvoiceline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesreturninvoiceline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesreturninvoiceline__createdby;?></td></tr>

</table>

<br>
<div id="sales_return_invoice_line_viewbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_invoice_line_viewedit/index/".$sales_return_invoice_line_view_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_invoice_line_viewconfirmdelete(<?=$sales_return_invoice_line_view_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_return_invoice_line_viewchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_invoice_line_viewlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
