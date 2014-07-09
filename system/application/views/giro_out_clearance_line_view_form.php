<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#giro_out_clearance_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function giro_out_clearance_lineconfirmdelete(delid, obj)
	{
		$('#giro_out_clearance_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_out_clearance_lineconfirmdelete3(delid, obj));
	}

function giro_out_clearance_lineconfirmdelete2(delid, obj)
	{
		$( "#giro_out_clearance_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_out_clearance_linecalldeletefn('giro_out_clearance_linedelete', delid, 'giro_out_clearance_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out_clearance_line-dialog-confirm').html('');
	}
	
	function giro_out_clearance_lineconfirmdelete3(delid, obj)
	{
		$( "#giro_out_clearance_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					giro_out_clearance_linecalldeletefn3('giro_out_clearance_linedelete', delid, 'giro_out_clearance_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out_clearance_line-dialog-confirm').html('');
	}

function giro_out_clearance_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function giro_out_clearance_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="giro_out_clearance_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Giro Out Clearance Line</h3>

<?=form_hidden("giro_out_clearance_line_id", $giro_out_clearance_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Giro Out</td><td><?=isset($giroout_opt[$girooutclearanceline__giroout_id])?$giroout_opt[$girooutclearanceline__giroout_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$girooutclearanceline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$girooutclearanceline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$girooutclearanceline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$girooutclearanceline__createdby;?></td></tr>

</table>

<br>
<div id="giro_out_clearance_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_out_clearance_lineedit/index/".$giro_out_clearance_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_out_clearance_lineconfirmdelete(<?=$giro_out_clearance_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="giro_out_clearance_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_out_clearance_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
