<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#manufacturing_order_historychildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufacturing_order_historyconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_history-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_historyconfirmdelete3(delid, obj));
	}

function manufacturing_order_historyconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_history-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_historycalldeletefn('manufacturing_order_historydelete', delid, 'manufacturing_order_historylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_history-dialog-confirm').html('');
	}
	
	function manufacturing_order_historyconfirmdelete3(delid, obj)
	{
		$( "#manufacturing_order_history-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufacturing_order_historycalldeletefn3('manufacturing_order_historydelete', delid, 'manufacturing_order_historylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_history-dialog-confirm').html('');
	}

function manufacturing_order_historycalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufacturing_order_historycalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufacturing_order_history-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufacturing Order History</h3>

<?=form_hidden("manufacturing_order_history_id", $manufacturing_order_history_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$manufacturingorderdone__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$manufacturingorderdone__date;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$manufacturingorderdone__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$manufacturingorderdone__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$manufacturingorderdone__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$manufacturingorderdone__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$manufacturingorderdone__createdby;?></td></tr>

</table>

<br>
<div id="manufacturing_order_historybuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_historyedit/index/".$manufacturing_order_history_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_historyconfirmdelete(<?=$manufacturing_order_history_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufacturing_order_historychildtabs">
	
	<ul><li><a href='<?=site_url()."/manufacturing_order_history_linelist/index/".$manufacturing_order_history_id;?>'>Manufacturing Order History Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_historylist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
