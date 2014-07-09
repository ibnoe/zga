<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#surat_pengajuan_repairchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function surat_pengajuan_repairconfirmdelete(delid, obj)
	{
		$('#surat_pengajuan_repair-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', surat_pengajuan_repairconfirmdelete3(delid, obj));
	}

function surat_pengajuan_repairconfirmdelete2(delid, obj)
	{
		$( "#surat_pengajuan_repair-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					surat_pengajuan_repaircalldeletefn('surat_pengajuan_repairdelete', delid, 'surat_pengajuan_repairlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#surat_pengajuan_repair-dialog-confirm').html('');
	}
	
	function surat_pengajuan_repairconfirmdelete3(delid, obj)
	{
		$( "#surat_pengajuan_repair-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					surat_pengajuan_repaircalldeletefn3('surat_pengajuan_repairdelete', delid, 'surat_pengajuan_repairlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#surat_pengajuan_repair-dialog-confirm').html('');
	}

function surat_pengajuan_repaircalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function surat_pengajuan_repaircalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="surat_pengajuan_repair-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Surat Pengajuan Repair</h3>

<?=form_hidden("surat_pengajuan_repair_id", $surat_pengajuan_repair_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>No Form</td><td><?=$suratpengajuanrepair__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$suratpengajuanrepair__date;?></td></tr><tr class='basic'>
<td>Diajukan oleh</td><td><?=$suratpengajuanrepair__requester;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$suratpengajuanrepair__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$suratpengajuanrepair__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$suratpengajuanrepair__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$suratpengajuanrepair__createdby;?></td></tr>

</table>

<br>
<div id="surat_pengajuan_repairbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/surat_pengajuan_repairedit/index/".$surat_pengajuan_repair_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="surat_pengajuan_repairconfirmdelete(<?=$surat_pengajuan_repair_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="surat_pengajuan_repairchildtabs">
	
	<ul><li><a href='<?=site_url()."/surat_pengajuan_repair_linelist/index/".$surat_pengajuan_repair_id;?>'>Surat Pengajuan Repair Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/surat_pengajuan_repairlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
