<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#manufacturing_reject_reasonchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufacturing_reject_reasonconfirmdelete(delid, obj)
	{
		$('#manufacturing_reject_reason-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_reject_reasonconfirmdelete3(delid, obj));
	}

function manufacturing_reject_reasonconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_reject_reason-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_reject_reasoncalldeletefn('manufacturing_reject_reasondelete', delid, 'manufacturing_reject_reasonlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_reject_reason-dialog-confirm').html('');
	}
	
	function manufacturing_reject_reasonconfirmdelete3(delid, obj)
	{
		$( "#manufacturing_reject_reason-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufacturing_reject_reasoncalldeletefn3('manufacturing_reject_reasondelete', delid, 'manufacturing_reject_reasonlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_reject_reason-dialog-confirm').html('');
	}

function manufacturing_reject_reasoncalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufacturing_reject_reasoncalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufacturing_reject_reason-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufacturing Reject Reason</h3>

<?=form_hidden("manufacturing_reject_reason_id", $manufacturing_reject_reason_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Name</td><td><?=$manufacturingrejectreason__name;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$manufacturingrejectreason__name;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$manufacturingrejectreason__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$manufacturingrejectreason__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$manufacturingrejectreason__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$manufacturingrejectreason__createdby;?></td></tr>

</table>

<br>
<div id="manufacturing_reject_reasonbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_reject_reasonedit/index/".$manufacturing_reject_reason_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_reject_reasonconfirmdelete(<?=$manufacturing_reject_reason_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufacturing_reject_reasonchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_reject_reasonlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
