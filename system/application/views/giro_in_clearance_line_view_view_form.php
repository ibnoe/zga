<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#giro_in_clearance_line_viewchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function giro_in_clearance_line_viewconfirmdelete(delid, obj)
	{
		$('#giro_in_clearance_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_in_clearance_line_viewconfirmdelete3(delid, obj));
	}

function giro_in_clearance_line_viewconfirmdelete2(delid, obj)
	{
		$( "#giro_in_clearance_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_in_clearance_line_viewcalldeletefn('giro_in_clearance_line_viewdelete', delid, 'giro_in_clearance_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in_clearance_line_view-dialog-confirm').html('');
	}
	
	function giro_in_clearance_line_viewconfirmdelete3(delid, obj)
	{
		$( "#giro_in_clearance_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					giro_in_clearance_line_viewcalldeletefn3('giro_in_clearance_line_viewdelete', delid, 'giro_in_clearance_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in_clearance_line_view-dialog-confirm').html('');
	}

function giro_in_clearance_line_viewcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function giro_in_clearance_line_viewcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="giro_in_clearance_line_view-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Giro In Clearance Line View</h3>

<?=form_hidden("giro_in_clearance_line_view_id", $giro_in_clearance_line_view_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Giro In</td><td><?=isset($giroin_opt[$giroinclearanceline__giroin_id])?$giroin_opt[$giroinclearanceline__giroin_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$giroinclearanceline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$giroinclearanceline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$giroinclearanceline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$giroinclearanceline__createdby;?></td></tr>

</table>

<br>
<div id="giro_in_clearance_line_viewbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_in_clearance_line_viewedit/index/".$giro_in_clearance_line_view_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_in_clearance_line_viewconfirmdelete(<?=$giro_in_clearance_line_view_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="giro_in_clearance_line_viewchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_in_clearance_line_viewlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
