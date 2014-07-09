<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#incoming_suppliers_itemschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function incoming_suppliers_itemsconfirmdelete(delid, obj)
	{
		$('#incoming_suppliers_items-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', incoming_suppliers_itemsconfirmdelete3(delid, obj));
	}

function incoming_suppliers_itemsconfirmdelete2(delid, obj)
	{
		$( "#incoming_suppliers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					incoming_suppliers_itemscalldeletefn('incoming_suppliers_itemsdelete', delid, 'incoming_suppliers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#incoming_suppliers_items-dialog-confirm').html('');
	}
	
	function incoming_suppliers_itemsconfirmdelete3(delid, obj)
	{
		$( "#incoming_suppliers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					incoming_suppliers_itemscalldeletefn3('incoming_suppliers_itemsdelete', delid, 'incoming_suppliers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#incoming_suppliers_items-dialog-confirm').html('');
	}

function incoming_suppliers_itemscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function incoming_suppliers_itemscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="incoming_suppliers_items-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Incoming Suppliers Items</h3>

<?=form_hidden("incoming_suppliers_items_id", $incoming_suppliers_items_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$purchaseorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchaseorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchaseorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchaseorderline__createdby;?></td></tr>

</table>

<br>
<div id="incoming_suppliers_itemsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/incoming_suppliers_itemsedit/index/".$incoming_suppliers_items_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="incoming_suppliers_itemsconfirmdelete(<?=$incoming_suppliers_items_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="incoming_suppliers_itemschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/incoming_suppliers_itemslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
