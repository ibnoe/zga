<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#hr_userschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function hr_usersconfirmdelete(delid, obj)
	{
		$('#hr_users-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', hr_usersconfirmdelete3(delid, obj));
	}

function hr_usersconfirmdelete2(delid, obj)
	{
		$( "#hr_users-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					hr_userscalldeletefn('hr_usersdelete', delid, 'hr_userslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#hr_users-dialog-confirm').html('');
	}
	
	function hr_usersconfirmdelete3(delid, obj)
	{
		$( "#hr_users-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					hr_userscalldeletefn3('hr_usersdelete', delid, 'hr_userslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#hr_users-dialog-confirm').html('');
	}

function hr_userscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function hr_userscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="hr_users-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View HR Users</h3>

<?=form_hidden("hr_users_id", $hr_users_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>First Name</td><td><?=$users__firstname;?></td></tr><tr class='basic'>
<td>Last Name</td><td><?=$users__lastname;?></td></tr><tr class='basic'>
<td>Username</td><td><?=$users__username;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$users__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$users__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$users__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$users__createdby;?></td></tr>

</table>

<br>
<div id="hr_usersbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/hr_usersedit/index/".$hr_users_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="hr_usersconfirmdelete(<?=$hr_users_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="hr_userschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/hr_userslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
