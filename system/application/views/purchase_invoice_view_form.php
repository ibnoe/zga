<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_invoicechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_invoiceconfirmdelete(delid, obj)
	{
		$('#purchase_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_invoiceconfirmdelete3(delid, obj));
	}

function purchase_invoiceconfirmdelete2(delid, obj)
	{
		$( "#purchase_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_invoicecalldeletefn('purchase_invoicedelete', delid, 'purchase_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_invoice-dialog-confirm').html('');
	}
	
	function purchase_invoiceconfirmdelete3(delid, obj)
	{
		$( "#purchase_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_invoicecalldeletefn3('purchase_invoicedelete', delid, 'purchase_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_invoice-dialog-confirm').html('');
	}

function purchase_invoicecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_invoicecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_invoice-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Invoice</h3>

<?=form_hidden("purchase_invoice_id", $purchase_invoice_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$purchaseinvoice__date;?></td></tr><tr class='basic'>
<td>Purchase Invoice No</td><td><?=$purchaseinvoice__orderid;?></td></tr><tr class='basic'>
<td>Receive Items</td><td><?=isset($receiveditem_opt[$purchaseinvoice__receiveditem_id])?$receiveditem_opt[$purchaseinvoice__receiveditem_id]:'';?></td></tr><tr class='basic'>
<td>Total</td><td><?=number_format($purchaseinvoice__total, 2);?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.1_week').attr('disabled', 'disabled');$('.1_week').hide();$('.2_weeks').attr('disabled', 'disabled');$('.2_weeks').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#purchaseinvoice__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '1 Week') {$('.1_week').attr('disabled', '');$('.1_week').show();}if (s == '2 Weeks') {$('.2_weeks').attr('disabled', '');$('.2_weeks').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});</script>
<td>Payment Term</td><td><?=$purchaseinvoice__top;?></td></tr><tr class='basic'>
<td>Ongkos Kirim Import</td><td><?=isset($ongkoskirimimport_opt[$purchaseinvoice__ongkoskirimimport_id])?$ongkoskirimimport_opt[$purchaseinvoice__ongkoskirimimport_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchaseinvoice__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchaseinvoice__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchaseinvoice__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchaseinvoice__createdby;?></td></tr>

</table>

<br>
<div id="purchase_invoicebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_invoiceedit/index/".$purchase_invoice_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_invoiceconfirmdelete(<?=$purchase_invoice_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_invoicechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_invoicelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
