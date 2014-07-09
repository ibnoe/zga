<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_order_open_paymentchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_order_open_paymentconfirmdelete(delid, obj)
	{
		$('#purchase_order_open_payment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_order_open_paymentconfirmdelete3(delid, obj));
	}

function purchase_order_open_paymentconfirmdelete2(delid, obj)
	{
		$( "#purchase_order_open_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_order_open_paymentcalldeletefn('purchase_order_open_paymentdelete', delid, 'purchase_order_open_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_order_open_payment-dialog-confirm').html('');
	}
	
	function purchase_order_open_paymentconfirmdelete3(delid, obj)
	{
		$( "#purchase_order_open_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_order_open_paymentcalldeletefn3('purchase_order_open_paymentdelete', delid, 'purchase_order_open_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_order_open_payment-dialog-confirm').html('');
	}

function purchase_order_open_paymentcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_order_open_paymentcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_order_open_payment-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Order Open Payment</h3>

<?=form_hidden("purchase_order_open_payment_id", $purchase_order_open_payment_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>PO ID</td><td><?=$purchaseorder__orderid;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$purchaseorder__date;?></td></tr><tr class='basic'>
<td>SPP</td><td><?=isset($suratpermintaanpembelian_opt[$purchaseorder__suratpermintaanpembelian_id])?$suratpermintaanpembelian_opt[$purchaseorder__suratpermintaanpembelian_id]:'';?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=isset($supplier_opt[$purchaseorder__supplier_id])?$supplier_opt[$purchaseorder__supplier_id]:'';?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.lokal').attr('disabled', 'disabled');$('.lokal').hide();$('.import').attr('disabled', 'disabled');$('.import').hide();var s = $("#purchaseorder__buysource option:selected").text();if (s == 'Lokal') {$('.lokal').attr('disabled', '');$('.lokal').show();}if (s == 'Import') {$('.import').attr('disabled', '');$('.import').show();}});</script>
<td>Buy Source</td><td><?=$purchaseorder__buysource;?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$purchaseorder__currency_id])?$currency_opt[$purchaseorder__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($purchaseorder__currencyrate, 2);?></td></tr><tr class='basic'>
<td>PO Quote 1</td><td><a href='<?=base_url();?>upload/<?=$purchaseorder__quote1;?>'><?=$purchaseorder__quote1;?></a></td></tr><tr class='basic'>
<td>Notes</td><td><?=$purchaseorder__notes;?></td></tr><tr class='basic'>
<td>Supplier 2</td><td><?=isset($supplier_opt[$purchaseorder__supplier2_id])?$supplier_opt[$purchaseorder__supplier2_id]:'';?></td></tr><tr class='basic'>
<td>PO Quote 2</td><td><a href='<?=base_url();?>upload/<?=$purchaseorder__quote2;?>'><?=$purchaseorder__quote2;?></a></td></tr><tr class='basic'>
<td>Notes 2</td><td><?=$purchaseorder__notes2;?></td></tr><tr class='basic'>
<td>Supplier 3</td><td><?=isset($supplier_opt[$purchaseorder__supplier3_id])?$supplier_opt[$purchaseorder__supplier3_id]:'';?></td></tr><tr class='basic'>
<td>PO Quote 3</td><td><a href='<?=base_url();?>upload/<?=$purchaseorder__quote3;?>'><?=$purchaseorder__quote3;?></a></td></tr><tr class='basic'>
<td>Notes 3</td><td><?=$purchaseorder__notes3;?></td></tr><tr class='basic'>
<td>Forwarder</td><td><?=isset($forwarder_opt[$purchaseorder__forwarder_id])?$forwarder_opt[$purchaseorder__forwarder_id]:'';?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.by_sea').attr('disabled', 'disabled');$('.by_sea').hide();$('.by_air').attr('disabled', 'disabled');$('.by_air').hide();$('.by_land').attr('disabled', 'disabled');$('.by_land').hide();var s = $("#purchaseorder__shipmethod option:selected").text();if (s == 'By Sea') {$('.by_sea').attr('disabled', '');$('.by_sea').show();}if (s == 'By Air') {$('.by_air').attr('disabled', '');$('.by_air').show();}if (s == 'By Land') {$('.by_land').attr('disabled', '');$('.by_land').show();}});</script>
<td>Ship Method</td><td><?=$purchaseorder__shipmethod;?></td></tr><tr class='basic'>
<td>Est Arrival Date</td><td><?=$purchaseorder__estarrivaldate;?></td></tr><tr class='basic'>
<td>Total Amount</td><td><?=number_format($purchaseorder__total, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchaseorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchaseorder__updatedby;?></td></tr>

</table>

<br>
<div id="purchase_order_open_paymentbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_order_open_paymentedit/index/".$purchase_order_open_payment_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_order_open_paymentconfirmdelete(<?=$purchase_order_open_payment_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_order_open_paymentchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_order_open_paymentlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
