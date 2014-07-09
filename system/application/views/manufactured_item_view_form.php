<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#manufactured_itemchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufactured_itemconfirmdelete(delid, obj)
	{
		$('#manufactured_item-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufactured_itemconfirmdelete3(delid, obj));
	}

function manufactured_itemconfirmdelete2(delid, obj)
	{
		$( "#manufactured_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufactured_itemcalldeletefn('manufactured_itemdelete', delid, 'manufactured_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufactured_item-dialog-confirm').html('');
	}
	
	function manufactured_itemconfirmdelete3(delid, obj)
	{
		$( "#manufactured_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufactured_itemcalldeletefn3('manufactured_itemdelete', delid, 'manufactured_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufactured_item-dialog-confirm').html('');
	}

function manufactured_itemcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufactured_itemcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufactured_item-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufactured Item</h3>

<?=form_hidden("manufactured_item_id", $manufactured_item_id);?>

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
<div id="manufactured_itembuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufactured_itemedit/index/".$manufactured_item_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufactured_itemconfirmdelete(<?=$manufactured_item_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufactured_itemchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufactured_itemlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
