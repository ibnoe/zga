<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_return_order_open_sentchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_return_order_open_sentconfirmdelete(delid, obj)
	{
		$('#purchase_return_order_open_sent-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_order_open_sentconfirmdelete3(delid, obj));
	}

function purchase_return_order_open_sentconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_order_open_sent-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_order_open_sentcalldeletefn('purchase_return_order_open_sentdelete', delid, 'purchase_return_order_open_sentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_order_open_sent-dialog-confirm').html('');
	}
	
	function purchase_return_order_open_sentconfirmdelete3(delid, obj)
	{
		$( "#purchase_return_order_open_sent-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_return_order_open_sentcalldeletefn3('purchase_return_order_open_sentdelete', delid, 'purchase_return_order_open_sentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_order_open_sent-dialog-confirm').html('');
	}

function purchase_return_order_open_sentcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_return_order_open_sentcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_return_order_open_sent-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Return Order Open Sent</h3>

<?=form_hidden("purchase_return_order_open_sent_id", $purchase_return_order_open_sent_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$purchasereturnorder__date;?></td></tr><tr class='basic'>
<td>Return ID</td><td><?=$purchasereturnorder__purchasereturnorderid;?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=isset($supplier_opt[$purchasereturnorder__supplier_id])?$supplier_opt[$purchasereturnorder__supplier_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$purchasereturnorder__currency_id])?$currency_opt[$purchasereturnorder__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($purchasereturnorder__currencyrate, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$purchasereturnorder__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchasereturnorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchasereturnorder__updatedby;?></td></tr>

</table>

<br>
<div id="purchase_return_order_open_sentbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_order_open_sentedit/index/".$purchase_return_order_open_sent_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_order_open_sentconfirmdelete(<?=$purchase_return_order_open_sent_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_return_order_open_sentchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_order_open_sentlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
