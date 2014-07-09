<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#cuti_approvalchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function cuti_approvalconfirmdelete(delid, obj)
	{
		$('#cuti_approval-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cuti_approvalconfirmdelete3(delid, obj));
	}

function cuti_approvalconfirmdelete2(delid, obj)
	{
		$( "#cuti_approval-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cuti_approvalcalldeletefn('cuti_approvaldelete', delid, 'cuti_approvallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_approval-dialog-confirm').html('');
	}
	
	function cuti_approvalconfirmdelete3(delid, obj)
	{
		$( "#cuti_approval-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					cuti_approvalcalldeletefn3('cuti_approvaldelete', delid, 'cuti_approvallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_approval-dialog-confirm').html('');
	}

function cuti_approvalcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function cuti_approvalcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="cuti_approval-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Cuti Approval</h3>

<?=form_hidden("cuti_approval_id", $cuti_approval_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$cutiklaim__date;?></td></tr><tr class='basic'>
<td>Total Cuti Diambil</td><td><?=number_format($cutiklaim__totalcutiklaimed, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$cutiklaim__notes;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#cutiklaim__status option:selected").text();if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});</script>
<td>Status</td><td><?=$cutiklaim__status;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$cutiklaim__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$cutiklaim__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$cutiklaim__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$cutiklaim__createdby;?></td></tr>

</table>

<br>
<div id="cuti_approvalbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cuti_approvaledit/index/".$cuti_approval_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="cuti_approvalconfirmdelete(<?=$cuti_approval_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="cuti_approvalchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cuti_approvallist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
