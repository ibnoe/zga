<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#manufacturing_order_done_to_rejectchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufacturing_order_done_to_rejectconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_done_to_reject-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_done_to_rejectconfirmdelete3(delid, obj));
	}

function manufacturing_order_done_to_rejectconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_done_to_reject-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_done_to_rejectcalldeletefn('manufacturing_order_done_to_rejectdelete', delid, 'manufacturing_order_done_to_rejectlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_done_to_reject-dialog-confirm').html('');
	}
	
	function manufacturing_order_done_to_rejectconfirmdelete3(delid, obj)
	{
		$( "#manufacturing_order_done_to_reject-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufacturing_order_done_to_rejectcalldeletefn3('manufacturing_order_done_to_rejectdelete', delid, 'manufacturing_order_done_to_rejectlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_done_to_reject-dialog-confirm').html('');
	}

function manufacturing_order_done_to_rejectcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufacturing_order_done_to_rejectcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufacturing_order_done_to_reject-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufacturing Order Done To Reject</h3>

<?=form_hidden("manufacturing_order_done_to_reject_id", $manufacturing_order_done_to_reject_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$manufacturingorderdoneline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$manufacturingorderdoneline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$manufacturingorderdoneline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$manufacturingorderdoneline__createdby;?></td></tr>

</table>

<br>
<div id="manufacturing_order_done_to_rejectbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_done_to_rejectedit/index/".$manufacturing_order_done_to_reject_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_done_to_rejectconfirmdelete(<?=$manufacturing_order_done_to_reject_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufacturing_order_done_to_rejectchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_done_to_rejectlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
