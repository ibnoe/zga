<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#marketing_officerchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function marketing_officerconfirmdelete(delid, obj)
	{
		$('#marketing_officer-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', marketing_officerconfirmdelete3(delid, obj));
	}

function marketing_officerconfirmdelete2(delid, obj)
	{
		$( "#marketing_officer-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					marketing_officercalldeletefn('marketing_officerdelete', delid, 'marketing_officerlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#marketing_officer-dialog-confirm').html('');
	}
	
	function marketing_officerconfirmdelete3(delid, obj)
	{
		$( "#marketing_officer-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					marketing_officercalldeletefn3('marketing_officerdelete', delid, 'marketing_officerlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#marketing_officer-dialog-confirm').html('');
	}

function marketing_officercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function marketing_officercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="marketing_officer-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Marketing Officer</h3>

<?=form_hidden("marketing_officer_id", $marketing_officer_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$marketingofficer__idstring;?></td></tr><tr class='basic'>
<td>Officer Name</td><td><?=$marketingofficer__name;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$marketingofficer__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$marketingofficer__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$marketingofficer__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$marketingofficer__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$marketingofficer__createdby;?></td></tr>

</table>

<br>
<div id="marketing_officerbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/marketing_officeredit/index/".$marketing_officer_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="marketing_officerconfirmdelete(<?=$marketing_officer_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="marketing_officerchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/marketing_officerlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
