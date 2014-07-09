<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#cuti_to_processedchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function cuti_to_processedconfirmdelete(delid, obj)
	{
		$('#cuti_to_processed-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cuti_to_processedconfirmdelete3(delid, obj));
	}

function cuti_to_processedconfirmdelete2(delid, obj)
	{
		$( "#cuti_to_processed-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cuti_to_processedcalldeletefn('cuti_to_processeddelete', delid, 'cuti_to_processedlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_to_processed-dialog-confirm').html('');
	}
	
	function cuti_to_processedconfirmdelete3(delid, obj)
	{
		$( "#cuti_to_processed-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					cuti_to_processedcalldeletefn3('cuti_to_processeddelete', delid, 'cuti_to_processedlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_to_processed-dialog-confirm').html('');
	}

function cuti_to_processedcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function cuti_to_processedcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="cuti_to_processed-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Cuti To Processed</h3>

<?=form_hidden("cuti_to_processed_id", $cuti_to_processed_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$cutiklaim__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$cutiklaim__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$cutiklaim__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$cutiklaim__createdby;?></td></tr>

</table>

<br>
<div id="cuti_to_processedbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cuti_to_processededit/index/".$cuti_to_processed_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="cuti_to_processedconfirmdelete(<?=$cuti_to_processed_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="cuti_to_processedchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cuti_to_processedlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
