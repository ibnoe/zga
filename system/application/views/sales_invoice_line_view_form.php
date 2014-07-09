<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_invoice_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_invoice_lineconfirmdelete(delid, obj)
	{
		$('#sales_invoice_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_invoice_lineconfirmdelete3(delid, obj));
	}

function sales_invoice_lineconfirmdelete2(delid, obj)
	{
		$( "#sales_invoice_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_invoice_linecalldeletefn('sales_invoice_linedelete', delid, 'sales_invoice_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_invoice_line-dialog-confirm').html('');
	}
	
	function sales_invoice_lineconfirmdelete3(delid, obj)
	{
		$( "#sales_invoice_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_invoice_linecalldeletefn3('sales_invoice_linedelete', delid, 'sales_invoice_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_invoice_line-dialog-confirm').html('');
	}

function sales_invoice_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_invoice_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_invoice_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Invoice Line</h3>

<?=form_hidden("sales_invoice_line_id", $sales_invoice_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$salesinvoiceline__item_id])?$item_opt[$salesinvoiceline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($salesinvoiceline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$salesinvoiceline__uom_id])?$uom_opt[$salesinvoiceline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Price</td><td><?=number_format($salesinvoiceline__price, 2);?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=number_format($salesinvoiceline__subtotal, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesinvoiceline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesinvoiceline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesinvoiceline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesinvoiceline__createdby;?></td></tr>

</table>

<br>
<div id="sales_invoice_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_invoice_lineedit/index/".$sales_invoice_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_invoice_lineconfirmdelete(<?=$sales_invoice_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_invoice_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_invoice_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
