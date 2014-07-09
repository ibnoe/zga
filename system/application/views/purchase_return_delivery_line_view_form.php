<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_return_delivery_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_return_delivery_lineconfirmdelete(delid, obj)
	{
		$('#purchase_return_delivery_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_delivery_lineconfirmdelete3(delid, obj));
	}

function purchase_return_delivery_lineconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_delivery_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_delivery_linecalldeletefn('purchase_return_delivery_linedelete', delid, 'purchase_return_delivery_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_delivery_line-dialog-confirm').html('');
	}
	
	function purchase_return_delivery_lineconfirmdelete3(delid, obj)
	{
		$( "#purchase_return_delivery_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_return_delivery_linecalldeletefn3('purchase_return_delivery_linedelete', delid, 'purchase_return_delivery_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_delivery_line-dialog-confirm').html('');
	}

function purchase_return_delivery_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_return_delivery_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_return_delivery_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Return Delivery Line</h3>

<?=form_hidden("purchase_return_delivery_line_id", $purchase_return_delivery_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$purchasereturndeliveryline__item_id])?$item_opt[$purchasereturndeliveryline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($purchasereturndeliveryline__quantitytosend, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$purchasereturndeliveryline__uom_id])?$uom_opt[$purchasereturndeliveryline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchasereturndeliveryline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchasereturndeliveryline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchasereturndeliveryline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchasereturndeliveryline__createdby;?></td></tr>

</table>

<br>
<div id="purchase_return_delivery_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_delivery_lineedit/index/".$purchase_return_delivery_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_delivery_lineconfirmdelete(<?=$purchase_return_delivery_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_return_delivery_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_delivery_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
