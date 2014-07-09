<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#sales_orderchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_orderconfirmdelete(delid, obj)
	{
		$('#sales_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_orderconfirmdelete3(delid, obj));
	}

function sales_orderconfirmdelete2(delid, obj)
	{
		$( "#sales_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_ordercalldeletefn('sales_orderdelete', delid, 'sales_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order-dialog-confirm').html('');
	}
	
	function sales_orderconfirmdelete3(delid, obj)
	{
		$( "#sales_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_ordercalldeletefn3('sales_orderdelete', delid, 'sales_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order-dialog-confirm').html('');
	}

function sales_ordercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_ordercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_order-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Order</h3>

<?=form_hidden("sales_order_id", $sales_order_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>SO ID</td><td><?=$salesorder__orderid;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$salesorder__date;?></td></tr><tr class='basic'>
<td>No Penawaran</td><td><?=$salesorder__nopenawaran;?></td></tr><tr class='basic'>
<td>No PO</td><td><?=$salesorder__customerponumber;?></td></tr><tr class='basic'>
<td>Marketing Officer</td><td><?=isset($marketingofficer_opt[$salesorder__marketingofficer_id])?$marketingofficer_opt[$salesorder__marketingofficer_id]:'';?></td></tr><tr class='basic'>
<td>Description</td><td><?=$salesorder__notes;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$salesorder__customer_id])?$customer_opt[$salesorder__customer_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$salesorder__currency_id])?$currency_opt[$salesorder__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($salesorder__currencyrate, 2);?></td></tr><tr class='basic'>
<td>Gross Amount</td><td><?=number_format($salesorder__total, 2);?></td></tr><tr class='basic'>
<td>Total Discount</td><td><?=number_format($salesorder__totaldiscount, 2);?></td></tr><tr class='basic'>
<td>Total Tax</td><td><?=number_format($salesorder__totaltax, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesorder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesorder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesorder__createdby;?></td></tr>

</table>

<br>
<div id="sales_orderbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_orderedit/index/".$sales_order_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_orderconfirmdelete(<?=$sales_order_id;?>, this);"></td>
<td class="print"><input class="button" type="button" value="Print" onclick="location.href='<?=site_url()."/printing/index/sales_order/".$sales_order_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="sales_orderchildtabs">
	
	<ul><li><a href='<?=site_url()."/sales_order_linelist/index/".$sales_order_id;?>'>Sales Order Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_orderlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
