<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#rif_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function rif_lineconfirmdelete(delid, obj)
	{
		$('#rif_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', rif_lineconfirmdelete3(delid, obj));
	}

function rif_lineconfirmdelete2(delid, obj)
	{
		$( "#rif_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					rif_linecalldeletefn('rif_linedelete', delid, 'rif_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rif_line-dialog-confirm').html('');
	}
	
	function rif_lineconfirmdelete3(delid, obj)
	{
		$( "#rif_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					rif_linecalldeletefn3('rif_linedelete', delid, 'rif_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rif_line-dialog-confirm').html('');
	}

function rif_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function rif_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="rif_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View RIF Line</h3>

<?=form_hidden("rif_line_id", $rif_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Machine Specification</td><td><?=$rcnline__machinespec;?></td></tr><tr class='basic'>
<td>Rubber Diameter (RD)</td><td><?=number_format($rcnline__rd, 2);?></td></tr><tr class='basic'>
<td>Core Diameter (CD)</td><td><?=number_format($rcnline__cd, 2);?></td></tr><tr class='basic'>
<td>Rubber Length (RL)</td><td><?=number_format($rcnline__rl, 2);?></td></tr><tr class='basic'>
<td>Working Length (WL)</td><td><?=number_format($rcnline__wl, 2);?></td></tr><tr class='basic'>
<td>Total Length (TL)</td><td><?=number_format($rcnline__tl, 2);?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.r').attr('disabled', 'disabled');$('.r').hide();$('.z').attr('disabled', 'disabled');$('.z').hide();var s = $("#rcnline__coretype option:selected").text();if (s == 'R') {$('.r').attr('disabled', '');$('.r').show();}if (s == 'Z') {$('.z').attr('disabled', '');$('.z').show();}});</script>
<td>Core Type</td><td><?=$rcnline__coretype;?></td></tr><tr class='basic'>
<td>Acc Fitted</td><td><?=$rcnline__accfitted;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.bearing_seat_(bs)').attr('disabled', 'disabled');$('.bearing_seat_(bs)').hide();$('.centre_drill_(cd)').attr('disabled', 'disabled');$('.centre_drill_(cd)').hide();var s = $("#rcnline__repairrequest option:selected").text();if (s == 'Bearing Seat (BS)') {$('.bearing_seat_(bs)').attr('disabled', '');$('.bearing_seat_(bs)').show();}if (s == 'Centre Drill (CD)') {$('.centre_drill_(cd)').attr('disabled', '');$('.centre_drill_(cd)').show();}});</script>
<td>Repair Request</td><td><?=$rcnline__repairrequest;?></td></tr><tr class='basic'>
<td>Remarks</td><td><?=$rcnline__remarks;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$rcnline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$rcnline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$rcnline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$rcnline__createdby;?></td></tr>

</table>

<br>
<div id="rif_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/rif_lineedit/index/".$rif_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="rif_lineconfirmdelete(<?=$rif_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="rif_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/rif_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
