<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#giro_out_clearance_line_viewchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function giro_out_clearance_line_viewconfirmdelete(delid, obj)
	{
		$('#giro_out_clearance_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_out_clearance_line_viewconfirmdelete3(delid, obj));
	}

function giro_out_clearance_line_viewconfirmdelete2(delid, obj)
	{
		$( "#giro_out_clearance_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_out_clearance_line_viewcalldeletefn('giro_out_clearance_line_viewdelete', delid, 'giro_out_clearance_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out_clearance_line_view-dialog-confirm').html('');
	}
	
	function giro_out_clearance_line_viewconfirmdelete3(delid, obj)
	{
		$( "#giro_out_clearance_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					giro_out_clearance_line_viewcalldeletefn3('giro_out_clearance_line_viewdelete', delid, 'giro_out_clearance_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out_clearance_line_view-dialog-confirm').html('');
	}

function giro_out_clearance_line_viewcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function giro_out_clearance_line_viewcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="giro_out_clearance_line_view-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Giro Out Clearance Line View</h3>

<?=form_hidden("giro_out_clearance_line_view_id", $giro_out_clearance_line_view_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Giro Out</td><td><?=isset($giroout_opt[$girooutclearanceline__giroout_id])?$giroout_opt[$girooutclearanceline__giroout_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$girooutclearanceline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$girooutclearanceline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$girooutclearanceline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$girooutclearanceline__createdby;?></td></tr>

</table>

<br>
<div id="giro_out_clearance_line_viewbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_out_clearance_line_viewedit/index/".$giro_out_clearance_line_view_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_out_clearance_line_viewconfirmdelete(<?=$giro_out_clearance_line_view_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="giro_out_clearance_line_viewchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_out_clearance_line_viewlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
