<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#open_giro_outchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function open_giro_outconfirmdelete(delid, obj)
	{
		$('#open_giro_out-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_giro_outconfirmdelete3(delid, obj));
	}

function open_giro_outconfirmdelete2(delid, obj)
	{
		$( "#open_giro_out-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_giro_outcalldeletefn('open_giro_outdelete', delid, 'open_giro_outlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_giro_out-dialog-confirm').html('');
	}
	
	function open_giro_outconfirmdelete3(delid, obj)
	{
		$( "#open_giro_out-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					open_giro_outcalldeletefn3('open_giro_outdelete', delid, 'open_giro_outlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_giro_out-dialog-confirm').html('');
	}

function open_giro_outcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function open_giro_outcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="open_giro_out-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Open Giro Out</h3>

<?=form_hidden("open_giro_out_id", $open_giro_out_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$giroout__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$giroout__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$giroout__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$giroout__createdby;?></td></tr>

</table>

<br>
<div id="open_giro_outbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_giro_outedit/index/".$open_giro_out_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="open_giro_outconfirmdelete(<?=$open_giro_out_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="open_giro_outchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_giro_outlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
