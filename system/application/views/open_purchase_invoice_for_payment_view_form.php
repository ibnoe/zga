<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#open_purchase_invoice_for_paymentchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function open_purchase_invoice_for_paymentconfirmdelete(delid, obj)
	{
		$('#open_purchase_invoice_for_payment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_purchase_invoice_for_paymentconfirmdelete3(delid, obj));
	}

function open_purchase_invoice_for_paymentconfirmdelete2(delid, obj)
	{
		$( "#open_purchase_invoice_for_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_purchase_invoice_for_paymentcalldeletefn('open_purchase_invoice_for_paymentdelete', delid, 'open_purchase_invoice_for_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_purchase_invoice_for_payment-dialog-confirm').html('');
	}
	
	function open_purchase_invoice_for_paymentconfirmdelete3(delid, obj)
	{
		$( "#open_purchase_invoice_for_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					open_purchase_invoice_for_paymentcalldeletefn3('open_purchase_invoice_for_paymentdelete', delid, 'open_purchase_invoice_for_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_purchase_invoice_for_payment-dialog-confirm').html('');
	}

function open_purchase_invoice_for_paymentcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function open_purchase_invoice_for_paymentcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="open_purchase_invoice_for_payment-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Open Purchase Invoice For Payment</h3>

<?=form_hidden("open_purchase_invoice_for_payment_id", $open_purchase_invoice_for_payment_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$purchaseinvoice__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchaseinvoice__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchaseinvoice__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchaseinvoice__createdby;?></td></tr>

</table>

<br>
<div id="open_purchase_invoice_for_paymentbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_purchase_invoice_for_paymentedit/index/".$open_purchase_invoice_for_payment_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="open_purchase_invoice_for_paymentconfirmdelete(<?=$open_purchase_invoice_for_payment_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="open_purchase_invoice_for_paymentchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_purchase_invoice_for_paymentlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
