<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#manufacturing_rejectchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufacturing_rejectconfirmdelete(delid, obj)
	{
		$('#manufacturing_reject-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_rejectconfirmdelete3(delid, obj));
	}

function manufacturing_rejectconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_reject-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_rejectcalldeletefn('manufacturing_rejectdelete', delid, 'manufacturing_rejectlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_reject-dialog-confirm').html('');
	}
	
	function manufacturing_rejectconfirmdelete3(delid, obj)
	{
		$( "#manufacturing_reject-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufacturing_rejectcalldeletefn3('manufacturing_rejectdelete', delid, 'manufacturing_rejectlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_reject-dialog-confirm').html('');
	}

function manufacturing_rejectcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufacturing_rejectcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufacturing_reject-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufacturing Reject</h3>

<?=form_hidden("manufacturing_reject_id", $manufacturing_reject_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$manufacturingreject__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$manufacturingreject__date;?></td></tr><tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$manufacturingreject__item_id])?$item_opt[$manufacturingreject__item_id]:'';?></td></tr><tr class='basic'>
<td>Goods Location</td><td><?=isset($warehouse_opt[$manufacturingreject__warehouse_id])?$warehouse_opt[$manufacturingreject__warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($manufacturingreject__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$manufacturingreject__uom_id])?$uom_opt[$manufacturingreject__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$manufacturingreject__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$manufacturingreject__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$manufacturingreject__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$manufacturingreject__createdby;?></td></tr>

</table>

<br>
<div id="manufacturing_rejectbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_rejectedit/index/".$manufacturing_reject_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_rejectconfirmdelete(<?=$manufacturing_reject_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufacturing_rejectchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_rejectlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
