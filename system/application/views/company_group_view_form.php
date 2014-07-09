<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#company_groupchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function company_groupconfirmdelete(delid, obj)
	{
		$('#company_group-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', company_groupconfirmdelete3(delid, obj));
	}

function company_groupconfirmdelete2(delid, obj)
	{
		$( "#company_group-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					company_groupcalldeletefn('company_groupdelete', delid, 'company_grouplist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#company_group-dialog-confirm').html('');
	}
	
	function company_groupconfirmdelete3(delid, obj)
	{
		$( "#company_group-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					company_groupcalldeletefn3('company_groupdelete', delid, 'company_grouplist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#company_group-dialog-confirm').html('');
	}

function company_groupcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function company_groupcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="company_group-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Company Group</h3>

<?=form_hidden("company_group_id", $company_group_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$customergroup__idstring;?></td></tr><tr class='basic'>
<td>Group Name</td><td><?=$customergroup__name;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$customergroup__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$customergroup__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$customergroup__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$customergroup__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$customergroup__createdby;?></td></tr>

</table>

<br>
<div id="company_groupbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/company_groupedit/index/".$company_group_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="company_groupconfirmdelete(<?=$company_group_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="company_groupchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/company_grouplist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
