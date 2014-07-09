<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#receive_items_for_invoicechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function receive_items_for_invoiceconfirmdelete(delid, obj)
	{
		$('#receive_items_for_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', receive_items_for_invoiceconfirmdelete3(delid, obj));
	}

function receive_items_for_invoiceconfirmdelete2(delid, obj)
	{
		$( "#receive_items_for_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					receive_items_for_invoicecalldeletefn('receive_items_for_invoicedelete', delid, 'receive_items_for_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#receive_items_for_invoice-dialog-confirm').html('');
	}
	
	function receive_items_for_invoiceconfirmdelete3(delid, obj)
	{
		$( "#receive_items_for_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					receive_items_for_invoicecalldeletefn3('receive_items_for_invoicedelete', delid, 'receive_items_for_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#receive_items_for_invoice-dialog-confirm').html('');
	}

function receive_items_for_invoicecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function receive_items_for_invoicecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="receive_items_for_invoice-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Receive Items For Invoice</h3>

<?=form_hidden("receive_items_for_invoice_id", $receive_items_for_invoice_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$receiveditem__date;?></td></tr><tr class='basic'>
<td>Receive Item No</td><td><?=$receiveditem__orderid;?></td></tr><tr class='basic'>
<td>Surat Jalan No</td><td><?=$receiveditem__suratjalanno;?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=isset($supplier_opt[$receiveditem__supplier_id])?$supplier_opt[$receiveditem__supplier_id]:'';?></td></tr><tr class='basic'>
<td>Warehouse</td><td><?=isset($warehouse_opt[$receiveditem__warehouse_id])?$warehouse_opt[$receiveditem__warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$receiveditem__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$receiveditem__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$receiveditem__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$receiveditem__createdby;?></td></tr>

</table>

<br>
<div id="receive_items_for_invoicebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/receive_items_for_invoiceedit/index/".$receive_items_for_invoice_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="receive_items_for_invoiceconfirmdelete(<?=$receive_items_for_invoice_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="receive_items_for_invoicechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/receive_items_for_invoicelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
