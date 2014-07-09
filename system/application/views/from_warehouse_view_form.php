<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#from_warehousechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function from_warehouseconfirmdelete(delid, obj)
	{
		$('#from_warehouse-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', from_warehouseconfirmdelete3(delid, obj));
	}

function from_warehouseconfirmdelete2(delid, obj)
	{
		$( "#from_warehouse-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					from_warehousecalldeletefn('from_warehousedelete', delid, 'from_warehouselist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#from_warehouse-dialog-confirm').html('');
	}
	
	function from_warehouseconfirmdelete3(delid, obj)
	{
		$( "#from_warehouse-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					from_warehousecalldeletefn3('from_warehousedelete', delid, 'from_warehouselist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#from_warehouse-dialog-confirm').html('');
	}

function from_warehousecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function from_warehousecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="from_warehouse-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View From Warehouse</h3>

<?=form_hidden("from_warehouse_id", $from_warehouse_id);?>

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
<div id="from_warehousebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/from_warehouseedit/index/".$from_warehouse_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="from_warehouseconfirmdelete(<?=$from_warehouse_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="from_warehousechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/from_warehouselist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
