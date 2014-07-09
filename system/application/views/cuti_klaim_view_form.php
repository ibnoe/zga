<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#cuti_klaimchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function cuti_klaimconfirmdelete(delid, obj)
	{
		$('#cuti_klaim-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cuti_klaimconfirmdelete3(delid, obj));
	}

function cuti_klaimconfirmdelete2(delid, obj)
	{
		$( "#cuti_klaim-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cuti_klaimcalldeletefn('cuti_klaimdelete', delid, 'cuti_klaimlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_klaim-dialog-confirm').html('');
	}
	
	function cuti_klaimconfirmdelete3(delid, obj)
	{
		$( "#cuti_klaim-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					cuti_klaimcalldeletefn3('cuti_klaimdelete', delid, 'cuti_klaimlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_klaim-dialog-confirm').html('');
	}

function cuti_klaimcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function cuti_klaimcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="cuti_klaim-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Cuti Klaim</h3>

<?=form_hidden("cuti_klaim_id", $cuti_klaim_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$cutiklaim__date;?></td></tr><tr class='basic'>
<td>Total Cuti Diambil</td><td><?=number_format($cutiklaim__totalcutiklaimed, 2);?></td></tr><tr class='basic'>
<td>Atasan</td><td><?=isset($users_opt[$cutiklaim__users_id])?$users_opt[$cutiklaim__users_id]:'';?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$cutiklaim__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$cutiklaim__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$cutiklaim__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$cutiklaim__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$cutiklaim__createdby;?></td></tr>

</table>

<br>
<div id="cuti_klaimbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cuti_klaimedit/index/".$cuti_klaim_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="cuti_klaimconfirmdelete(<?=$cuti_klaim_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="cuti_klaimchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cuti_klaimlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
