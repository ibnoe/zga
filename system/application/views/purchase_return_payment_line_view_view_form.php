<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_return_payment_line_viewchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_return_payment_line_viewconfirmdelete(delid, obj)
	{
		$('#purchase_return_payment_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_payment_line_viewconfirmdelete3(delid, obj));
	}

function purchase_return_payment_line_viewconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_payment_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_payment_line_viewcalldeletefn('purchase_return_payment_line_viewdelete', delid, 'purchase_return_payment_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_payment_line_view-dialog-confirm').html('');
	}
	
	function purchase_return_payment_line_viewconfirmdelete3(delid, obj)
	{
		$( "#purchase_return_payment_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_return_payment_line_viewcalldeletefn3('purchase_return_payment_line_viewdelete', delid, 'purchase_return_payment_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_payment_line_view-dialog-confirm').html('');
	}

function purchase_return_payment_line_viewcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_return_payment_line_viewcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_return_payment_line_view-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Return Payment Line View</h3>

<?=form_hidden("purchase_return_payment_line_view_id", $purchase_return_payment_line_view_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Purchase Return Invoice</td><td><?=isset($purchasereturninvoice_opt[$purchasereturnpaymentline__purchasereturninvoice_id])?$purchasereturninvoice_opt[$purchasereturnpaymentline__purchasereturninvoice_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchasereturnpaymentline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchasereturnpaymentline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchasereturnpaymentline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchasereturnpaymentline__createdby;?></td></tr>

</table>

<br>
<div id="purchase_return_payment_line_viewbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_payment_line_viewedit/index/".$purchase_return_payment_line_view_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_payment_line_viewconfirmdelete(<?=$purchase_return_payment_line_view_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_return_payment_line_viewchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_payment_line_viewlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
