<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#sales_return_orderchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_return_orderconfirmdelete(delid, obj)
	{
		$('#sales_return_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_orderconfirmdelete3(delid, obj));
	}

function sales_return_orderconfirmdelete2(delid, obj)
	{
		$( "#sales_return_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_ordercalldeletefn('sales_return_orderdelete', delid, 'sales_return_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_order-dialog-confirm').html('');
	}
	
	function sales_return_orderconfirmdelete3(delid, obj)
	{
		$( "#sales_return_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_return_ordercalldeletefn3('sales_return_orderdelete', delid, 'sales_return_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_order-dialog-confirm').html('');
	}

function sales_return_ordercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_return_ordercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_return_order-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Return Order</h3>

<?=form_hidden("sales_return_order_id", $sales_return_order_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$salesreturnorder__date;?></td></tr><tr class='basic'>
<td>Return ID</td><td><?=$salesreturnorder__salesreturnorderid;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$salesreturnorder__customer_id])?$customer_opt[$salesreturnorder__customer_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$salesreturnorder__currency_id])?$currency_opt[$salesreturnorder__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($salesreturnorder__currencyrate, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$salesreturnorder__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesreturnorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesreturnorder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesreturnorder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesreturnorder__createdby;?></td></tr>

</table>

<br>
<div id="sales_return_orderbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_orderedit/index/".$sales_return_order_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_orderconfirmdelete(<?=$sales_return_order_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_return_orderchildtabs">
	
	<ul><li><a href='<?=site_url()."/sales_return_order_linelist/index/".$sales_return_order_id;?>'>Sales Return Order Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_orderlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
