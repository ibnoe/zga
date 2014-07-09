<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#tunjangan_kesehatan_to_processchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function tunjangan_kesehatan_to_processconfirmdelete(delid, obj)
	{
		$('#tunjangan_kesehatan_to_process-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', tunjangan_kesehatan_to_processconfirmdelete3(delid, obj));
	}

function tunjangan_kesehatan_to_processconfirmdelete2(delid, obj)
	{
		$( "#tunjangan_kesehatan_to_process-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					tunjangan_kesehatan_to_processcalldeletefn('tunjangan_kesehatan_to_processdelete', delid, 'tunjangan_kesehatan_to_processlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#tunjangan_kesehatan_to_process-dialog-confirm').html('');
	}
	
	function tunjangan_kesehatan_to_processconfirmdelete3(delid, obj)
	{
		$( "#tunjangan_kesehatan_to_process-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					tunjangan_kesehatan_to_processcalldeletefn3('tunjangan_kesehatan_to_processdelete', delid, 'tunjangan_kesehatan_to_processlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#tunjangan_kesehatan_to_process-dialog-confirm').html('');
	}

function tunjangan_kesehatan_to_processcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function tunjangan_kesehatan_to_processcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="tunjangan_kesehatan_to_process-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Tunjangan Kesehatan To Process</h3>

<?=form_hidden("tunjangan_kesehatan_to_process_id", $tunjangan_kesehatan_to_process_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$tunjangankesehatanusage__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$tunjangankesehatanusage__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$tunjangankesehatanusage__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$tunjangankesehatanusage__createdby;?></td></tr>

</table>

<br>
<div id="tunjangan_kesehatan_to_processbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/tunjangan_kesehatan_to_processedit/index/".$tunjangan_kesehatan_to_process_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="tunjangan_kesehatan_to_processconfirmdelete(<?=$tunjangan_kesehatan_to_process_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="tunjangan_kesehatan_to_processchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/tunjangan_kesehatan_to_processlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
