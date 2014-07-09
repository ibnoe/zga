<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#cuti_to_processchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function cuti_to_processconfirmdelete(delid, obj)
	{
		$('#cuti_to_process-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cuti_to_processconfirmdelete3(delid, obj));
	}

function cuti_to_processconfirmdelete2(delid, obj)
	{
		$( "#cuti_to_process-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cuti_to_processcalldeletefn('cuti_to_processdelete', delid, 'cuti_to_processlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_to_process-dialog-confirm').html('');
	}
	
	function cuti_to_processconfirmdelete3(delid, obj)
	{
		$( "#cuti_to_process-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					cuti_to_processcalldeletefn3('cuti_to_processdelete', delid, 'cuti_to_processlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_to_process-dialog-confirm').html('');
	}

function cuti_to_processcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function cuti_to_processcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="cuti_to_process-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Cuti To Process</h3>

<?=form_hidden("cuti_to_process_id", $cuti_to_process_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$cutiklaim__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$cutiklaim__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$cutiklaim__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$cutiklaim__createdby;?></td></tr>

</table>

<br>
<div id="cuti_to_processbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cuti_to_processedit/index/".$cuti_to_process_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="cuti_to_processconfirmdelete(<?=$cuti_to_process_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="cuti_to_processchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cuti_to_processlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
