<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#notificationchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function notificationconfirmdelete(delid, obj)
	{
		$('#notification-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', notificationconfirmdelete3(delid, obj));
	}

function notificationconfirmdelete2(delid, obj)
	{
		$( "#notification-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					notificationcalldeletefn('notificationdelete', delid, 'notificationlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#notification-dialog-confirm').html('');
	}
	
	function notificationconfirmdelete3(delid, obj)
	{
		$( "#notification-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					notificationcalldeletefn3('notificationdelete', delid, 'notificationlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#notification-dialog-confirm').html('');
	}

function notificationcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function notificationcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="notification-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Notification</h3>

<?=form_hidden("notification_id", $notification_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Summary</td><td><?=$vmessagenotification__summary;?></td></tr><tr class='basic'>
<td>Message</td><td><?=$vmessagenotification__message;?></td></tr><tr class='basic'>
<td>Time</td><td><?=$vmessagenotification__lastupdate;?></td></tr><tr class='basic'>
<td>By</td><td><?=$vmessagenotification__updatedby;?></td></tr>

</table>

<br>
<div id="notificationbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/notificationedit/index/".$notification_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="notificationconfirmdelete(<?=$notification_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="notificationchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/notificationlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
