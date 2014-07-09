<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#received_suppliers_itemschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function received_suppliers_itemsconfirmdelete(delid, obj)
	{
		$('#received_suppliers_items-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', received_suppliers_itemsconfirmdelete3(delid, obj));
	}

function received_suppliers_itemsconfirmdelete2(delid, obj)
	{
		$( "#received_suppliers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					received_suppliers_itemscalldeletefn('received_suppliers_itemsdelete', delid, 'received_suppliers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#received_suppliers_items-dialog-confirm').html('');
	}
	
	function received_suppliers_itemsconfirmdelete3(delid, obj)
	{
		$( "#received_suppliers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					received_suppliers_itemscalldeletefn3('received_suppliers_itemsdelete', delid, 'received_suppliers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#received_suppliers_items-dialog-confirm').html('');
	}

function received_suppliers_itemscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function received_suppliers_itemscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="received_suppliers_items-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Received Suppliers Items</h3>

<?=form_hidden("received_suppliers_items_id", $received_suppliers_items_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$receiveditemline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$receiveditemline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$receiveditemline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$receiveditemline__createdby;?></td></tr>

</table>

<br>
<div id="received_suppliers_itemsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/received_suppliers_itemsedit/index/".$received_suppliers_items_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="received_suppliers_itemsconfirmdelete(<?=$received_suppliers_items_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="received_suppliers_itemschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/received_suppliers_itemslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
