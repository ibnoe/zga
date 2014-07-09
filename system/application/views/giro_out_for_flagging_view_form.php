<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#giro_out_for_flaggingchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function giro_out_for_flaggingconfirmdelete(delid, obj)
	{
		$('#giro_out_for_flagging-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_out_for_flaggingconfirmdelete3(delid, obj));
	}

function giro_out_for_flaggingconfirmdelete2(delid, obj)
	{
		$( "#giro_out_for_flagging-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_out_for_flaggingcalldeletefn('giro_out_for_flaggingdelete', delid, 'giro_out_for_flagginglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out_for_flagging-dialog-confirm').html('');
	}
	
	function giro_out_for_flaggingconfirmdelete3(delid, obj)
	{
		$( "#giro_out_for_flagging-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					giro_out_for_flaggingcalldeletefn3('giro_out_for_flaggingdelete', delid, 'giro_out_for_flagginglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out_for_flagging-dialog-confirm').html('');
	}

function giro_out_for_flaggingcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function giro_out_for_flaggingcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="giro_out_for_flagging-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Giro Out For Flagging</h3>

<?=form_hidden("giro_out_for_flagging_id", $giro_out_for_flagging_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$giroout__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$giroout__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$giroout__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$giroout__createdby;?></td></tr>

</table>

<br>
<div id="giro_out_for_flaggingbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_out_for_flaggingedit/index/".$giro_out_for_flagging_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_out_for_flaggingconfirmdelete(<?=$giro_out_for_flagging_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="giro_out_for_flaggingchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_out_for_flagginglist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
