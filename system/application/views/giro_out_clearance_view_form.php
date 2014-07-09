<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#giro_out_clearancechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function giro_out_clearanceconfirmdelete(delid, obj)
	{
		$('#giro_out_clearance-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_out_clearanceconfirmdelete3(delid, obj));
	}

function giro_out_clearanceconfirmdelete2(delid, obj)
	{
		$( "#giro_out_clearance-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_out_clearancecalldeletefn('giro_out_clearancedelete', delid, 'giro_out_clearancelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out_clearance-dialog-confirm').html('');
	}
	
	function giro_out_clearanceconfirmdelete3(delid, obj)
	{
		$( "#giro_out_clearance-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					giro_out_clearancecalldeletefn3('giro_out_clearancedelete', delid, 'giro_out_clearancelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out_clearance-dialog-confirm').html('');
	}

function giro_out_clearancecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function giro_out_clearancecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="giro_out_clearance-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Giro Out Clearance</h3>

<?=form_hidden("giro_out_clearance_id", $giro_out_clearance_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$girooutclearance__date;?></td></tr><tr class='basic'>
<td>ID</td><td><?=$girooutclearance__idstring;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$girooutclearance__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$girooutclearance__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$girooutclearance__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$girooutclearance__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$girooutclearance__createdby;?></td></tr>

</table>

<br>
<div id="giro_out_clearancebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_out_clearanceedit/index/".$giro_out_clearance_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_out_clearanceconfirmdelete(<?=$giro_out_clearance_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="giro_out_clearancechildtabs">
	
	<ul><li><a href='<?=site_url()."/giro_out_clearance_linelist/index/".$giro_out_clearance_id;?>'>Giro Out Clearance Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_out_clearancelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
