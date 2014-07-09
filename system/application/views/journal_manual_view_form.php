<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#journal_manualchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function journal_manualconfirmdelete(delid, obj)
	{
		$('#journal_manual-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', journal_manualconfirmdelete3(delid, obj));
	}

function journal_manualconfirmdelete2(delid, obj)
	{
		$( "#journal_manual-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					journal_manualcalldeletefn('journal_manualdelete', delid, 'journal_manuallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#journal_manual-dialog-confirm').html('');
	}
	
	function journal_manualconfirmdelete3(delid, obj)
	{
		$( "#journal_manual-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					journal_manualcalldeletefn3('journal_manualdelete', delid, 'journal_manuallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#journal_manual-dialog-confirm').html('');
	}

function journal_manualcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function journal_manualcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="journal_manual-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Journal Manual</h3>

<?=form_hidden("journal_manual_id", $journal_manual_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Reference</td><td><?=$journalmanual__reference;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$journalmanual__date;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$journalmanual__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$journalmanual__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$journalmanual__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$journalmanual__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$journalmanual__createdby;?></td></tr>

</table>

<br>
<div id="journal_manualbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/journal_manualedit/index/".$journal_manual_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="journal_manualconfirmdelete(<?=$journal_manual_id;?>, this);"></td>
<td class="print"><input class="button" type="button" value="Print" onclick="location.href='<?=site_url()."/printing/index/journal_manual/".$journal_manual_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="journal_manualchildtabs">
	
	<ul><li><a href='<?=site_url()."/journal_manual_linelist/index/".$journal_manual_id;?>'>Journal Manual Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/journal_manuallist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
