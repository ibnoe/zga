<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#purchase_return_paymentchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_return_paymentconfirmdelete(delid, obj)
	{
		$('#purchase_return_payment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_paymentconfirmdelete3(delid, obj));
	}

function purchase_return_paymentconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_paymentcalldeletefn('purchase_return_paymentdelete', delid, 'purchase_return_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_payment-dialog-confirm').html('');
	}
	
	function purchase_return_paymentconfirmdelete3(delid, obj)
	{
		$( "#purchase_return_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_return_paymentcalldeletefn3('purchase_return_paymentdelete', delid, 'purchase_return_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_payment-dialog-confirm').html('');
	}

function purchase_return_paymentcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_return_paymentcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_return_payment-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Return Payment</h3>

<?=form_hidden("purchase_return_payment_id", $purchase_return_payment_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$purchasereturnpayment__date;?></td></tr><tr class='basic'>
<td>ID</td><td><?=$purchasereturnpayment__purchasereturnpaymentid;?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=isset($supplier_opt[$purchasereturnpayment__supplier_id])?$supplier_opt[$purchasereturnpayment__supplier_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$purchasereturnpayment__currency_id])?$currency_opt[$purchasereturnpayment__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($purchasereturnpayment__currencyrate, 2);?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#purchasereturnpayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td>Payment Type</td><td><?=$purchasereturnpayment__paymenttype;?></td></tr><tr class='cash_bank'>
<td>Cash Bank</td><td><?=isset($cashbank_opt[$purchasereturnpayment__cashbank_id])?$cashbank_opt[$purchasereturnpayment__cashbank_id]:'';?></td></tr><tr class='giro'>
<td>Giro In</td><td><?=isset($giroin_opt[$purchasereturnpayment__giroin_id])?$giroin_opt[$purchasereturnpayment__giroin_id]:'';?></td></tr><tr class='credit_note'>
<td>Credit Note In</td><td><?=isset($creditnotein_opt[$purchasereturnpayment__creditnotein_id])?$creditnotein_opt[$purchasereturnpayment__creditnotein_id]:'';?></td></tr><tr class='basic'>
<td>Amount To Pay</td><td><?=number_format($purchasereturnpayment__total, 2);?></td></tr><tr class='basic'>
<td>Total Pay</td><td><?=number_format($purchasereturnpayment__totalpay, 2);?></td></tr><tr class='basic'>
<td>Adjustment</td><td><?=number_format($purchasereturnpayment__adjustment, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchasereturnpayment__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchasereturnpayment__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchasereturnpayment__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchasereturnpayment__createdby;?></td></tr>

</table>

<br>
<div id="purchase_return_paymentbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_paymentedit/index/".$purchase_return_payment_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_paymentconfirmdelete(<?=$purchase_return_payment_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_return_paymentchildtabs">
	
	<ul><li><a href='<?=site_url()."/purchase_return_payment_linelist/index/".$purchase_return_payment_id;?>'>Purchase Return Payment Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_paymentlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
