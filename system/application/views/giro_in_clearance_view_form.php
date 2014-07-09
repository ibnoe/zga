<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#giro_in_clearancechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function giro_in_clearanceconfirmdelete(delid, obj)
	{
		$('#giro_in_clearance-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_in_clearanceconfirmdelete3(delid, obj));
	}

function giro_in_clearanceconfirmdelete2(delid, obj)
	{
		$( "#giro_in_clearance-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_in_clearancecalldeletefn('giro_in_clearancedelete', delid, 'giro_in_clearancelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in_clearance-dialog-confirm').html('');
	}
	
	function giro_in_clearanceconfirmdelete3(delid, obj)
	{
		$( "#giro_in_clearance-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					giro_in_clearancecalldeletefn3('giro_in_clearancedelete', delid, 'giro_in_clearancelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in_clearance-dialog-confirm').html('');
	}

function giro_in_clearancecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function giro_in_clearancecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="giro_in_clearance-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Giro In Clearance</h3>

<?=form_hidden("giro_in_clearance_id", $giro_in_clearance_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$giroinclearance__date;?></td></tr><tr class='basic'>
<td>ID</td><td><?=$giroinclearance__idstring;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$giroinclearance__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$giroinclearance__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$giroinclearance__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$giroinclearance__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$giroinclearance__createdby;?></td></tr>

</table>

<br>
<div id="giro_in_clearancebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_in_clearanceedit/index/".$giro_in_clearance_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_in_clearanceconfirmdelete(<?=$giro_in_clearance_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="giro_in_clearancechildtabs">
	
	<ul><li><a href='<?=site_url()."/giro_in_clearance_linelist/index/".$giro_in_clearance_id;?>'>Giro In Clearance Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_in_clearancelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
