<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#journalchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function journalconfirmdelete(delid, obj)
	{
		$('#journal-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', journalconfirmdelete3(delid, obj));
	}

function journalconfirmdelete2(delid, obj)
	{
		$( "#journal-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					journalcalldeletefn('journaldelete', delid, 'journallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#journal-dialog-confirm').html('');
	}
	
	function journalconfirmdelete3(delid, obj)
	{
		$( "#journal-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					journalcalldeletefn3('journaldelete', delid, 'journallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#journal-dialog-confirm').html('');
	}

function journalcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function journalcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="journal-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Journal</h3>

<?=form_hidden("journal_id", $journal_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$journal__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$journal__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$journal__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$journal__createdby;?></td></tr>

</table>

<br>
<div id="journalbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/journaledit/index/".$journal_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="journalconfirmdelete(<?=$journal_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="journalchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/journallist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
