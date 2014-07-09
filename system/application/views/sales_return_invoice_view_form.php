<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_return_invoicechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_return_invoiceconfirmdelete(delid, obj)
	{
		$('#sales_return_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_invoiceconfirmdelete3(delid, obj));
	}

function sales_return_invoiceconfirmdelete2(delid, obj)
	{
		$( "#sales_return_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_invoicecalldeletefn('sales_return_invoicedelete', delid, 'sales_return_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_invoice-dialog-confirm').html('');
	}
	
	function sales_return_invoiceconfirmdelete3(delid, obj)
	{
		$( "#sales_return_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_return_invoicecalldeletefn3('sales_return_invoicedelete', delid, 'sales_return_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_invoice-dialog-confirm').html('');
	}

function sales_return_invoicecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_return_invoicecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_return_invoice-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Return Invoice</h3>

<?=form_hidden("sales_return_invoice_id", $sales_return_invoice_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$salesreturninvoice__date;?></td></tr><tr class='basic'>
<td>Invoice No</td><td><?=$salesreturninvoice__salesreturninvoiceid;?></td></tr><tr class='basic'>
<td>Sales Return Delivery</td><td><?=isset($salesreturndelivery_opt[$salesreturninvoice__salesreturndelivery_id])?$salesreturndelivery_opt[$salesreturninvoice__salesreturndelivery_id]:'';?></td></tr><tr class='basic'>
<td>Total</td><td><?=number_format($salesreturninvoice__total, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesreturninvoice__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesreturninvoice__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesreturninvoice__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesreturninvoice__createdby;?></td></tr>

</table>

<br>
<div id="sales_return_invoicebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_invoiceedit/index/".$sales_return_invoice_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_invoiceconfirmdelete(<?=$sales_return_invoice_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_return_invoicechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_invoicelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
