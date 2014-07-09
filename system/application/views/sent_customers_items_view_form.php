<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sent_customers_itemschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sent_customers_itemsconfirmdelete(delid, obj)
	{
		$('#sent_customers_items-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sent_customers_itemsconfirmdelete3(delid, obj));
	}

function sent_customers_itemsconfirmdelete2(delid, obj)
	{
		$( "#sent_customers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sent_customers_itemscalldeletefn('sent_customers_itemsdelete', delid, 'sent_customers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sent_customers_items-dialog-confirm').html('');
	}
	
	function sent_customers_itemsconfirmdelete3(delid, obj)
	{
		$( "#sent_customers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sent_customers_itemscalldeletefn3('sent_customers_itemsdelete', delid, 'sent_customers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sent_customers_items-dialog-confirm').html('');
	}

function sent_customers_itemscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sent_customers_itemscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sent_customers_items-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sent Customers Items</h3>

<?=form_hidden("sent_customers_items_id", $sent_customers_items_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$deliveryorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$deliveryorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$deliveryorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$deliveryorderline__createdby;?></td></tr>

</table>

<br>
<div id="sent_customers_itemsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sent_customers_itemsedit/index/".$sent_customers_items_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sent_customers_itemsconfirmdelete(<?=$sent_customers_items_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sent_customers_itemschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sent_customers_itemslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
