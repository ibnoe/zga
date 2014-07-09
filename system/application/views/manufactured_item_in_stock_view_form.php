<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#manufactured_item_in_stockchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufactured_item_in_stockconfirmdelete(delid, obj)
	{
		$('#manufactured_item_in_stock-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufactured_item_in_stockconfirmdelete3(delid, obj));
	}

function manufactured_item_in_stockconfirmdelete2(delid, obj)
	{
		$( "#manufactured_item_in_stock-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufactured_item_in_stockcalldeletefn('manufactured_item_in_stockdelete', delid, 'manufactured_item_in_stocklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufactured_item_in_stock-dialog-confirm').html('');
	}
	
	function manufactured_item_in_stockconfirmdelete3(delid, obj)
	{
		$( "#manufactured_item_in_stock-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufactured_item_in_stockcalldeletefn3('manufactured_item_in_stockdelete', delid, 'manufactured_item_in_stocklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufactured_item_in_stock-dialog-confirm').html('');
	}

function manufactured_item_in_stockcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufactured_item_in_stockcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufactured_item_in_stock-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufactured Item In Stock</h3>

<?=form_hidden("manufactured_item_in_stock_id", $manufactured_item_in_stock_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item ID</td><td><?=$item__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$item__name;?></td></tr><tr class='basic'>
<td>Minimum Quantity</td><td><?=number_format($item__minquantity, 2);?></td></tr><tr class='basic'>
<td>Maximum Quantity</td><td><?=number_format($item__maxquantity, 2);?></td></tr><tr class='brandnew'>
<td>Buffer 3 Months</td><td><?=number_format($item__buffer3months, 2);?></td></tr><tr class='basic'>
<td>Is Purchasable?</td><td><?=$item__purchaseable;?></td></tr><tr class='basic'>
<td>Is Sellable?</td><td><?=$item__sellable;?></td></tr><tr class='basic'>
<td>Is Manufactured?</td><td><?=$item__manufactured;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$item__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$item__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$item__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$item__createdby;?></td></tr>

</table>

<br>
<div id="manufactured_item_in_stockbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufactured_item_in_stockedit/index/".$manufactured_item_in_stock_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufactured_item_in_stockconfirmdelete(<?=$manufactured_item_in_stock_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufactured_item_in_stockchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufactured_item_in_stocklist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
