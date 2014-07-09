<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_return_delivery_for_invoicechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_return_delivery_for_invoiceconfirmdelete(delid, obj)
	{
		$('#sales_return_delivery_for_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_delivery_for_invoiceconfirmdelete3(delid, obj));
	}

function sales_return_delivery_for_invoiceconfirmdelete2(delid, obj)
	{
		$( "#sales_return_delivery_for_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_delivery_for_invoicecalldeletefn('sales_return_delivery_for_invoicedelete', delid, 'sales_return_delivery_for_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_delivery_for_invoice-dialog-confirm').html('');
	}
	
	function sales_return_delivery_for_invoiceconfirmdelete3(delid, obj)
	{
		$( "#sales_return_delivery_for_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_return_delivery_for_invoicecalldeletefn3('sales_return_delivery_for_invoicedelete', delid, 'sales_return_delivery_for_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_delivery_for_invoice-dialog-confirm').html('');
	}

function sales_return_delivery_for_invoicecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_return_delivery_for_invoicecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_return_delivery_for_invoice-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Return Delivery For Invoice</h3>

<?=form_hidden("sales_return_delivery_for_invoice_id", $sales_return_delivery_for_invoice_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$salesreturndelivery__date;?></td></tr><tr class='basic'>
<td>Delivery No</td><td><?=$salesreturndelivery__salesreturndeliveryid;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$salesreturndelivery__customer_id])?$customer_opt[$salesreturndelivery__customer_id]:'';?></td></tr><tr class='basic'>
<td>Warehouse</td><td><?=isset($warehouse_opt[$salesreturndelivery__warehouse_id])?$warehouse_opt[$salesreturndelivery__warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$salesreturndelivery__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesreturndelivery__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesreturndelivery__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesreturndelivery__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesreturndelivery__createdby;?></td></tr>

</table>

<br>
<div id="sales_return_delivery_for_invoicebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_delivery_for_invoiceedit/index/".$sales_return_delivery_for_invoice_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_delivery_for_invoiceconfirmdelete(<?=$sales_return_delivery_for_invoice_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_return_delivery_for_invoicechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_delivery_for_invoicelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
