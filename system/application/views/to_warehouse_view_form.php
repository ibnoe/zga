<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#to_warehousechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function to_warehouseconfirmdelete(delid, obj)
	{
		$('#to_warehouse-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', to_warehouseconfirmdelete3(delid, obj));
	}

function to_warehouseconfirmdelete2(delid, obj)
	{
		$( "#to_warehouse-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					to_warehousecalldeletefn('to_warehousedelete', delid, 'to_warehouselist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#to_warehouse-dialog-confirm').html('');
	}
	
	function to_warehouseconfirmdelete3(delid, obj)
	{
		$( "#to_warehouse-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					to_warehousecalldeletefn3('to_warehousedelete', delid, 'to_warehouselist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#to_warehouse-dialog-confirm').html('');
	}

function to_warehousecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function to_warehousecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="to_warehouse-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View To Warehouse</h3>

<?=form_hidden("to_warehouse_id", $to_warehouse_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Name</td><td><?=$warehouse__name;?></td></tr><tr class='basic'>
<td>Address</td><td><?=$warehouse__address;?></td></tr><tr class='basic'>
<td>Phone</td><td><?=$warehouse__phone;?></td></tr><tr class='basic'>
<td>Fax</td><td><?=$warehouse__fax;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$warehouse__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$warehouse__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$warehouse__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$warehouse__createdby;?></td></tr>

</table>

<br>
<div id="to_warehousebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/to_warehouseedit/index/".$to_warehouse_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="to_warehouseconfirmdelete(<?=$to_warehouse_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="to_warehousechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/to_warehouselist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
