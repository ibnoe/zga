<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#manufacturing_order_donechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function manufacturing_order_doneconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_done-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_doneconfirmdelete3(delid, obj));
	}

function manufacturing_order_doneconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_done-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_donecalldeletefn('manufacturing_order_donedelete', delid, 'manufacturing_order_donelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_done-dialog-confirm').html('');
	}
	
	function manufacturing_order_doneconfirmdelete3(delid, obj)
	{
		$( "#manufacturing_order_done-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					manufacturing_order_donecalldeletefn3('manufacturing_order_donedelete', delid, 'manufacturing_order_donelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_done-dialog-confirm').html('');
	}

function manufacturing_order_donecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function manufacturing_order_donecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="manufacturing_order_done-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Manufacturing Order Done</h3>

<?=form_hidden("manufacturing_order_done_id", $manufacturing_order_done_id);?>

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
<div id="manufacturing_order_donebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_doneedit/index/".$manufacturing_order_done_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_doneconfirmdelete(<?=$manufacturing_order_done_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="manufacturing_order_donechildtabs">
	
	<ul><li><a href='<?=site_url()."/manufacturing_order_done_linelist/index/".$manufacturing_order_done_id;?>'>Manufacturing Order Done Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_donelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
