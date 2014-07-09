<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#sales_order_quotechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_order_quoteconfirmdelete(delid, obj)
	{
		$('#sales_order_quote-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_order_quoteconfirmdelete3(delid, obj));
	}

function sales_order_quoteconfirmdelete2(delid, obj)
	{
		$( "#sales_order_quote-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_order_quotecalldeletefn('sales_order_quotedelete', delid, 'sales_order_quotelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order_quote-dialog-confirm').html('');
	}
	
	function sales_order_quoteconfirmdelete3(delid, obj)
	{
		$( "#sales_order_quote-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_order_quotecalldeletefn3('sales_order_quotedelete', delid, 'sales_order_quotelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order_quote-dialog-confirm').html('');
	}

function sales_order_quotecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_order_quotecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_order_quote-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Order Quote</h3>

<?=form_hidden("sales_order_quote_id", $sales_order_quote_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>No Penawaran</td><td><?=$salesorder__nopenawaran;?></td></tr><tr class='basic'>
<td>No PO</td><td><?=$salesorder__customerponumber;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$salesorder__date;?></td></tr><tr class='basic'>
<td>Description</td><td><?=$salesorder__notes;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$salesorder__customer_id])?$customer_opt[$salesorder__customer_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$salesorder__currency_id])?$currency_opt[$salesorder__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($salesorder__currencyrate, 2);?></td></tr><tr class='basic'>
<td>Marketing Officer</td><td><?=isset($marketingofficer_opt[$salesorder__marketingofficer_id])?$marketingofficer_opt[$salesorder__marketingofficer_id]:'';?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#salesorder__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});</script>
<td>Status</td><td><?=$salesorder__status;?></td></tr><tr class='approved'>
<td>SO ID</td><td><?=$salesorder__orderid;?></td></tr><tr class='basic'>
<td>Gross Amount</td><td><?=number_format($salesorder__total, 2);?></td></tr><tr class='basic'>
<td>Total Discount</td><td><?=number_format($salesorder__totaldiscount, 2);?></td></tr><tr class='basic'>
<td>Total Tax</td><td><?=number_format($salesorder__totaltax, 2);?></td></tr><tr class='basic'>
<td>Total Amount</td><td><?=number_format($salesorder__grandtotal, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesorder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesorder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesorder__createdby;?></td></tr>

</table>

<br>
<div id="sales_order_quotebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_order_quoteedit/index/".$sales_order_quote_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_order_quoteconfirmdelete(<?=$sales_order_quote_id;?>, this);"></td>
<td class="print"><input class="button" type="button" value="Print" onclick="location.href='<?=site_url()."/printing/index/sales_order_quote/".$sales_order_quote_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="sales_order_quotechildtabs">
	
	<ul><li><a href='<?=site_url()."/sales_order_quote_linelist/index/".$sales_order_quote_id;?>'>Sales Order Quote Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_order_quotelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
