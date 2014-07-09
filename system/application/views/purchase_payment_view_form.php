<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#purchase_paymentchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_paymentconfirmdelete(delid, obj)
	{
		$('#purchase_payment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_paymentconfirmdelete3(delid, obj));
	}

function purchase_paymentconfirmdelete2(delid, obj)
	{
		$( "#purchase_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_paymentcalldeletefn('purchase_paymentdelete', delid, 'purchase_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_payment-dialog-confirm').html('');
	}
	
	function purchase_paymentconfirmdelete3(delid, obj)
	{
		$( "#purchase_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_paymentcalldeletefn3('purchase_paymentdelete', delid, 'purchase_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_payment-dialog-confirm').html('');
	}

function purchase_paymentcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_paymentcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_payment-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Payment</h3>

<?=form_hidden("purchase_payment_id", $purchase_payment_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$purchasepayment__date;?></td></tr><tr class='basic'>
<td>Purchase Payment No</td><td><?=$purchasepayment__purchasepaymentid;?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=isset($supplier_opt[$purchasepayment__supplier_id])?$supplier_opt[$purchasepayment__supplier_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$purchasepayment__currency_id])?$currency_opt[$purchasepayment__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($purchasepayment__currencyrate, 2);?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.cash_bank').attr('disabled', 'disabled');$('.cash_bank').hide();$('.giro').attr('disabled', 'disabled');$('.giro').hide();$('.credit_note').attr('disabled', 'disabled');$('.credit_note').hide();var s = $("#purchasepayment__paymenttype option:selected").text();if (s == 'Cash Bank') {$('.cash_bank').attr('disabled', '');$('.cash_bank').show();}if (s == 'Giro') {$('.giro').attr('disabled', '');$('.giro').show();}if (s == 'Credit Note') {$('.credit_note').attr('disabled', '');$('.credit_note').show();}});</script>
<td>Payment Type</td><td><?=$purchasepayment__paymenttype;?></td></tr><tr class='cash_bank'>
<td>Cash Bank</td><td><?=isset($cashbank_opt[$purchasepayment__cashbank_id])?$cashbank_opt[$purchasepayment__cashbank_id]:'';?></td></tr><tr class='giro'>
<td>Giro Out</td><td><?=isset($giroout_opt[$purchasepayment__giroout_id])?$giroout_opt[$purchasepayment__giroout_id]:'';?></td></tr><tr class='credit_note'>
<td>Credit Note In</td><td><?=isset($creditnotein_opt[$purchasepayment__creditnotein_id])?$creditnotein_opt[$purchasepayment__creditnotein_id]:'';?></td></tr><tr class='basic'>
<td>Amount To Pay</td><td><?=number_format($purchasepayment__total, 2);?></td></tr><tr class='basic'>
<td>Total Payment</td><td><?=number_format($purchasepayment__totalpay, 2);?></td></tr><tr class='basic'>
<td>Adjustment</td><td><?=number_format($purchasepayment__adjustment, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchasepayment__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchasepayment__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchasepayment__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchasepayment__createdby;?></td></tr>

</table>

<br>
<div id="purchase_paymentbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_paymentedit/index/".$purchase_payment_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_paymentconfirmdelete(<?=$purchase_payment_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_paymentchildtabs">
	
	<ul><li><a href='<?=site_url()."/purchase_payment_linelist/index/".$purchase_payment_id;?>'>Purchase Payment Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_paymentlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
