<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_order_quote_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_order_quote_lineconfirmdelete(delid, obj)
	{
		$('#purchase_order_quote_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_order_quote_lineconfirmdelete3(delid, obj));
	}

function purchase_order_quote_lineconfirmdelete2(delid, obj)
	{
		$( "#purchase_order_quote_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_order_quote_linecalldeletefn('purchase_order_quote_linedelete', delid, 'purchase_order_quote_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_order_quote_line-dialog-confirm').html('');
	}
	
	function purchase_order_quote_lineconfirmdelete3(delid, obj)
	{
		$( "#purchase_order_quote_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_order_quote_linecalldeletefn3('purchase_order_quote_linedelete', delid, 'purchase_order_quote_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_order_quote_line-dialog-confirm').html('');
	}

function purchase_order_quote_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_order_quote_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_order_quote_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Order Quote Line</h3>

<?=form_hidden("purchase_order_quote_line_id", $purchase_order_quote_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=$item_opt[$purchaseorderquoteline__item_id];?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($purchaseorderquoteline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=$uom_opt[$purchaseorderquoteline__uom_id];?></td></tr><tr class='basic'>
<td>Price</td><td><?=number_format($purchaseorderquoteline__price, 2);?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=number_format($purchaseorderquoteline__subtotal, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchaseorderquoteline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchaseorderquoteline__updatedby;?></td></tr>

</table>

<br>
<div id="purchase_order_quote_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_order_quote_lineedit/index/".$purchase_order_quote_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_order_quote_lineconfirmdelete(<?=$purchase_order_quote_line_id;?>, this);"></td>
</tr>
</table>
</div>
<br>

<div id="purchase_order_quote_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_order_quote_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
