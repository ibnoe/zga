<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#manufacturing_order_progresschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufacturing_order_progressconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_progress-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_progressconfirmdelete3(delid, obj));
	}

function manufacturing_order_progressconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_progress-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_progresscalldeletefn('manufacturing_order_progressdelete', delid, 'manufacturing_order_progresslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_progress-dialog-confirm').html('');
	}
	
	function manufacturing_order_progressconfirmdelete3(delid, obj)
	{
		$( "#manufacturing_order_progress-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufacturing_order_progresscalldeletefn3('manufacturing_order_progressdelete', delid, 'manufacturing_order_progresslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_progress-dialog-confirm').html('');
	}

function manufacturing_order_progresscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufacturing_order_progresscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufacturing_order_progress-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufacturing Order Progress</h3>

<?=form_hidden("manufacturing_order_progress_id", $manufacturing_order_progress_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$manufacturingorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$manufacturingorder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$manufacturingorder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$manufacturingorder__createdby;?></td></tr>

</table>

<br>
<div id="manufacturing_order_progressbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_progressedit/index/".$manufacturing_order_progress_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_progressconfirmdelete(<?=$manufacturing_order_progress_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufacturing_order_progresschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_progresslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
