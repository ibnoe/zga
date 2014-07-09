<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#reject_manufacturingchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function reject_manufacturingconfirmdelete(delid, obj)
	{
		$('#reject_manufacturing-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', reject_manufacturingconfirmdelete3(delid, obj));
	}

function reject_manufacturingconfirmdelete2(delid, obj)
	{
		$( "#reject_manufacturing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					reject_manufacturingcalldeletefn('reject_manufacturingdelete', delid, 'reject_manufacturinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#reject_manufacturing-dialog-confirm').html('');
	}
	
	function reject_manufacturingconfirmdelete3(delid, obj)
	{
		$( "#reject_manufacturing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					reject_manufacturingcalldeletefn3('reject_manufacturingdelete', delid, 'reject_manufacturinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#reject_manufacturing-dialog-confirm').html('');
	}

function reject_manufacturingcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function reject_manufacturingcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="reject_manufacturing-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Reject Manufacturing</h3>

<?=form_hidden("reject_manufacturing_id", $reject_manufacturing_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$rejectmanufacturing__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$rejectmanufacturing__date;?></td></tr><tr class='basic'>
<td>Manufacturing Reject Reason</td><td><?=isset($manufacturingrejectreason_opt[$rejectmanufacturing__manufacturingrejectreason_id])?$manufacturingrejectreason_opt[$rejectmanufacturing__manufacturingrejectreason_id]:'';?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$rejectmanufacturing__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$rejectmanufacturing__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$rejectmanufacturing__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$rejectmanufacturing__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$rejectmanufacturing__createdby;?></td></tr>

</table>

<br>
<div id="reject_manufacturingbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/reject_manufacturingedit/index/".$reject_manufacturing_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="reject_manufacturingconfirmdelete(<?=$reject_manufacturing_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="reject_manufacturingchildtabs">
	
	<ul><li><a href='<?=site_url()."/reject_manufacturing_line_viewlist/index/".$reject_manufacturing_id;?>'>Reject Manufacturing Line View</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/reject_manufacturinglist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
