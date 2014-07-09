<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_invoice_line_viewchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_invoice_line_viewconfirmdelete(delid, obj)
	{
		$('#purchase_invoice_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_invoice_line_viewconfirmdelete3(delid, obj));
	}

function purchase_invoice_line_viewconfirmdelete2(delid, obj)
	{
		$( "#purchase_invoice_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_invoice_line_viewcalldeletefn('purchase_invoice_line_viewdelete', delid, 'purchase_invoice_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_invoice_line_view-dialog-confirm').html('');
	}
	
	function purchase_invoice_line_viewconfirmdelete3(delid, obj)
	{
		$( "#purchase_invoice_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_invoice_line_viewcalldeletefn3('purchase_invoice_line_viewdelete', delid, 'purchase_invoice_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_invoice_line_view-dialog-confirm').html('');
	}

function purchase_invoice_line_viewcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_invoice_line_viewcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_invoice_line_view-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Invoice Line View</h3>

<?=form_hidden("purchase_invoice_line_view_id", $purchase_invoice_line_view_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$purchaseinvoiceline__item_id])?$item_opt[$purchaseinvoiceline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($purchaseinvoiceline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$purchaseinvoiceline__uom_id])?$uom_opt[$purchaseinvoiceline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Price</td><td><?=number_format($purchaseinvoiceline__price, 2);?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=number_format($purchaseinvoiceline__subtotal, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchaseinvoiceline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchaseinvoiceline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchaseinvoiceline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchaseinvoiceline__createdby;?></td></tr>

</table>

<br>
<div id="purchase_invoice_line_viewbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_invoice_line_viewedit/index/".$purchase_invoice_line_view_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_invoice_line_viewconfirmdelete(<?=$purchase_invoice_line_view_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_invoice_line_viewchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_invoice_line_viewlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
