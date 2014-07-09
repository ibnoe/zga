<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#purchase_order_quotechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_order_quoteconfirmdelete(delid, obj)
	{
		$('#purchase_order_quote-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_order_quoteconfirmdelete3(delid, obj));
	}

function purchase_order_quoteconfirmdelete2(delid, obj)
	{
		$( "#purchase_order_quote-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_order_quotecalldeletefn('purchase_order_quotedelete', delid, 'purchase_order_quotelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_order_quote-dialog-confirm').html('');
	}
	
	function purchase_order_quoteconfirmdelete3(delid, obj)
	{
		$( "#purchase_order_quote-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_order_quotecalldeletefn3('purchase_order_quotedelete', delid, 'purchase_order_quotelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_order_quote-dialog-confirm').html('');
	}

function purchase_order_quotecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_order_quotecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_order_quote-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Order Quote</h3>

<?=form_hidden("purchase_order_quote_id", $purchase_order_quote_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>No PO Quote</td><td><?=$purchaseorderquote__orderid;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$purchaseorderquote__date;?></td></tr><tr class='basic'>
<td>Description</td><td><?=$purchaseorderquote__notes;?></td></tr><tr class='basic'>
<td>SPP</td><td><?=$suratpermintaanpembelian_opt[$purchaseorderquote__suratpermintaanpembelian_id];?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=$supplier_opt[$purchaseorderquote__supplier_id];?></td></tr><tr class='basic'>
<td>Currency</td><td><?=$currency_opt[$purchaseorderquote__currency_id];?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($purchaseorderquote__currencyrate, 2);?></td></tr><tr class='basic'>
<td>Ship To Location</td><td><?=$warehouse_opt[$purchaseorderquote__warehouse_id];?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchaseorderquote__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchaseorderquote__updatedby;?></td></tr>

</table>

<br>
<div id="purchase_order_quotebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_order_quoteedit/index/".$purchase_order_quote_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_order_quoteconfirmdelete(<?=$purchase_order_quote_id;?>, this);"></td>
</tr>
</table>
</div>
<br>

<div id="purchase_order_quotechildtabs">
	
	<ul><li><a href='<?=site_url()."/purchase_order_quote_linelist/index/".$purchase_order_quote_id;?>'>Purchase Order Quote Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_order_quotelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
