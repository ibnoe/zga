<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_return_invoicechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_return_invoiceconfirmdelete(delid, obj)
	{
		$('#purchase_return_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_invoiceconfirmdelete3(delid, obj));
	}

function purchase_return_invoiceconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_invoicecalldeletefn('purchase_return_invoicedelete', delid, 'purchase_return_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_invoice-dialog-confirm').html('');
	}
	
	function purchase_return_invoiceconfirmdelete3(delid, obj)
	{
		$( "#purchase_return_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_return_invoicecalldeletefn3('purchase_return_invoicedelete', delid, 'purchase_return_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_invoice-dialog-confirm').html('');
	}

function purchase_return_invoicecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_return_invoicecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_return_invoice-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Return Invoice</h3>

<?=form_hidden("purchase_return_invoice_id", $purchase_return_invoice_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$purchasereturninvoice__date;?></td></tr><tr class='basic'>
<td>Invoice No</td><td><?=$purchasereturninvoice__purchasereturninvoiceid;?></td></tr><tr class='basic'>
<td>Purchase Return Delivery</td><td><?=isset($purchasereturndelivery_opt[$purchasereturninvoice__purchasereturndelivery_id])?$purchasereturndelivery_opt[$purchasereturninvoice__purchasereturndelivery_id]:'';?></td></tr><tr class='basic'>
<td>Total</td><td><?=number_format($purchasereturninvoice__total, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchasereturninvoice__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchasereturninvoice__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchasereturninvoice__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchasereturninvoice__createdby;?></td></tr>

</table>

<br>
<div id="purchase_return_invoicebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_invoiceedit/index/".$purchase_return_invoice_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_invoiceconfirmdelete(<?=$purchase_return_invoice_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_return_invoicechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_invoicelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
