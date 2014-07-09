<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#sales_return_paymentchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_return_paymentconfirmdelete(delid, obj)
	{
		$('#sales_return_payment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_paymentconfirmdelete3(delid, obj));
	}

function sales_return_paymentconfirmdelete2(delid, obj)
	{
		$( "#sales_return_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_paymentcalldeletefn('sales_return_paymentdelete', delid, 'sales_return_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_payment-dialog-confirm').html('');
	}
	
	function sales_return_paymentconfirmdelete3(delid, obj)
	{
		$( "#sales_return_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_return_paymentcalldeletefn3('sales_return_paymentdelete', delid, 'sales_return_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_payment-dialog-confirm').html('');
	}

function sales_return_paymentcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_return_paymentcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_return_payment-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Return Payment</h3>

<?=form_hidden("sales_return_payment_id", $sales_return_payment_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$salesreturnpayment__date;?></td></tr><tr class='basic'>
<td>ID</td><td><?=$salesreturnpayment__salesreturnpaymentid;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$salesreturnpayment__customer_id])?$customer_opt[$salesreturnpayment__customer_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$salesreturnpayment__currency_id])?$currency_opt[$salesreturnpayment__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($salesreturnpayment__currencyrate, 2);?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#salesreturnpayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td>Payment Type</td><td><?=$salesreturnpayment__paymenttype;?></td></tr><tr class='cash_bank'>
<td>Cash Bank</td><td><?=isset($cashbank_opt[$salesreturnpayment__cashbank_id])?$cashbank_opt[$salesreturnpayment__cashbank_id]:'';?></td></tr><tr class='giro'>
<td>Giro Out</td><td><?=isset($giroout_opt[$salesreturnpayment__giroout_id])?$giroout_opt[$salesreturnpayment__giroout_id]:'';?></td></tr><tr class='credit_note'>
<td>Credit Note Out</td><td><?=isset($creditnoteout_opt[$salesreturnpayment__creditnoteout_id])?$creditnoteout_opt[$salesreturnpayment__creditnoteout_id]:'';?></td></tr><tr class='basic'>
<td>Amount To Pay</td><td><?=number_format($salesreturnpayment__total, 2);?></td></tr><tr class='basic'>
<td>Total Pay</td><td><?=number_format($salesreturnpayment__totalpay, 2);?></td></tr><tr class='basic'>
<td>Adjustment</td><td><?=number_format($salesreturnpayment__adjustment, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesreturnpayment__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesreturnpayment__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesreturnpayment__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesreturnpayment__createdby;?></td></tr>

</table>

<br>
<div id="sales_return_paymentbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_paymentedit/index/".$sales_return_payment_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_paymentconfirmdelete(<?=$sales_return_payment_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_return_paymentchildtabs">
	
	<ul><li><a href='<?=site_url()."/sales_return_payment_linelist/index/".$sales_return_payment_id;?>'>Sales Return Payment Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_paymentlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
