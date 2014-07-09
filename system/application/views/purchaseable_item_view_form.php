<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchaseable_itemchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchaseable_itemconfirmdelete(delid, obj)
	{
		$('#purchaseable_item-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchaseable_itemconfirmdelete3(delid, obj));
	}

function purchaseable_itemconfirmdelete2(delid, obj)
	{
		$( "#purchaseable_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchaseable_itemcalldeletefn('purchaseable_itemdelete', delid, 'purchaseable_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchaseable_item-dialog-confirm').html('');
	}
	
	function purchaseable_itemconfirmdelete3(delid, obj)
	{
		$( "#purchaseable_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchaseable_itemcalldeletefn3('purchaseable_itemdelete', delid, 'purchaseable_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchaseable_item-dialog-confirm').html('');
	}

function purchaseable_itemcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchaseable_itemcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchaseable_item-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchaseable Item</h3>

<?=form_hidden("purchaseable_item_id", $purchaseable_item_id);?>

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
<div id="purchaseable_itembuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchaseable_itemedit/index/".$purchaseable_item_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchaseable_itemconfirmdelete(<?=$purchaseable_item_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchaseable_itemchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchaseable_itemlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
