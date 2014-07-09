<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#giro_in_clearance_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function giro_in_clearance_lineconfirmdelete(delid, obj)
	{
		$('#giro_in_clearance_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_in_clearance_lineconfirmdelete3(delid, obj));
	}

function giro_in_clearance_lineconfirmdelete2(delid, obj)
	{
		$( "#giro_in_clearance_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_in_clearance_linecalldeletefn('giro_in_clearance_linedelete', delid, 'giro_in_clearance_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in_clearance_line-dialog-confirm').html('');
	}
	
	function giro_in_clearance_lineconfirmdelete3(delid, obj)
	{
		$( "#giro_in_clearance_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					giro_in_clearance_linecalldeletefn3('giro_in_clearance_linedelete', delid, 'giro_in_clearance_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in_clearance_line-dialog-confirm').html('');
	}

function giro_in_clearance_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function giro_in_clearance_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="giro_in_clearance_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Giro In Clearance Line</h3>

<?=form_hidden("giro_in_clearance_line_id", $giro_in_clearance_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Giro In</td><td><?=isset($giroin_opt[$giroinclearanceline__giroin_id])?$giroin_opt[$giroinclearanceline__giroin_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$giroinclearanceline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$giroinclearanceline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$giroinclearanceline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$giroinclearanceline__createdby;?></td></tr>

</table>

<br>
<div id="giro_in_clearance_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_in_clearance_lineedit/index/".$giro_in_clearance_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_in_clearance_lineconfirmdelete(<?=$giro_in_clearance_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="giro_in_clearance_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_in_clearance_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
