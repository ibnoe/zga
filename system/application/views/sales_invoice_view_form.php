<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_invoicechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_invoiceconfirmdelete(delid, obj)
	{
		$('#sales_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_invoiceconfirmdelete3(delid, obj));
	}

function sales_invoiceconfirmdelete2(delid, obj)
	{
		$( "#sales_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_invoicecalldeletefn('sales_invoicedelete', delid, 'sales_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_invoice-dialog-confirm').html('');
	}
	
	function sales_invoiceconfirmdelete3(delid, obj)
	{
		$( "#sales_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_invoicecalldeletefn3('sales_invoicedelete', delid, 'sales_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_invoice-dialog-confirm').html('');
	}

function sales_invoicecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_invoicecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_invoice-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Invoice</h3>

<?=form_hidden("sales_invoice_id", $sales_invoice_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$salesinvoice__date;?></td></tr><tr class='basic'>
<td>Sales Invoice No</td><td><?=$salesinvoice__orderid;?></td></tr><tr class='basic'>
<td>DO No</td><td><?=$salesinvoice__donum;?></td></tr><tr class='basic'>
<td>Delivery Order</td><td><?=isset($deliveryorder_opt[$salesinvoice__deliveryorder_id])?$deliveryorder_opt[$salesinvoice__deliveryorder_id]:'';?></td></tr><tr class='basic'>
<td>Total</td><td><?=number_format($salesinvoice__total, 2);?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.1_week').attr('disabled', 'disabled');$('.1_week').hide();$('.2_weeks').attr('disabled', 'disabled');$('.2_weeks').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#salesinvoice__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '1 Week') {$('.1_week').attr('disabled', '');$('.1_week').show();}if (s == '2 Weeks') {$('.2_weeks').attr('disabled', '');$('.2_weeks').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});</script>
<td>Payment Term</td><td><?=$salesinvoice__top;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesinvoice__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesinvoice__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesinvoice__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesinvoice__createdby;?></td></tr>

</table>

<br>
<div id="sales_invoicebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_invoiceedit/index/".$sales_invoice_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_invoiceconfirmdelete(<?=$sales_invoice_id;?>, this);"></td>
<td class="print"><input class="button" type="button" value="Print" onclick="location.href='<?=site_url()."/printing/index/sales_invoice/".$sales_invoice_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="sales_invoicechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_invoicelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
