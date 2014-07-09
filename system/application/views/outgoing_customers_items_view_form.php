<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#outgoing_customers_itemschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function outgoing_customers_itemsconfirmdelete(delid, obj)
	{
		$('#outgoing_customers_items-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', outgoing_customers_itemsconfirmdelete3(delid, obj));
	}

function outgoing_customers_itemsconfirmdelete2(delid, obj)
	{
		$( "#outgoing_customers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					outgoing_customers_itemscalldeletefn('outgoing_customers_itemsdelete', delid, 'outgoing_customers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#outgoing_customers_items-dialog-confirm').html('');
	}
	
	function outgoing_customers_itemsconfirmdelete3(delid, obj)
	{
		$( "#outgoing_customers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					outgoing_customers_itemscalldeletefn3('outgoing_customers_itemsdelete', delid, 'outgoing_customers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#outgoing_customers_items-dialog-confirm').html('');
	}

function outgoing_customers_itemscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function outgoing_customers_itemscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="outgoing_customers_items-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Outgoing Customers Items</h3>

<?=form_hidden("outgoing_customers_items_id", $outgoing_customers_items_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$salesorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesorderline__createdby;?></td></tr>

</table>

<br>
<div id="outgoing_customers_itemsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/outgoing_customers_itemsedit/index/".$outgoing_customers_items_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="outgoing_customers_itemsconfirmdelete(<?=$outgoing_customers_items_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="outgoing_customers_itemschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/outgoing_customers_itemslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
