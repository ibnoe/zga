<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#journal_manual_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function journal_manual_lineconfirmdelete(delid, obj)
	{
		$('#journal_manual_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', journal_manual_lineconfirmdelete3(delid, obj));
	}

function journal_manual_lineconfirmdelete2(delid, obj)
	{
		$( "#journal_manual_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					journal_manual_linecalldeletefn('journal_manual_linedelete', delid, 'journal_manual_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#journal_manual_line-dialog-confirm').html('');
	}
	
	function journal_manual_lineconfirmdelete3(delid, obj)
	{
		$( "#journal_manual_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					journal_manual_linecalldeletefn3('journal_manual_linedelete', delid, 'journal_manual_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#journal_manual_line-dialog-confirm').html('');
	}

function journal_manual_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function journal_manual_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="journal_manual_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Journal Manual Line</h3>

<?=form_hidden("journal_manual_line_id", $journal_manual_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Account</td><td><?=isset($coa_opt[$journal__coa_id])?$coa_opt[$journal__coa_id]:'';?></td></tr><tr class='basic'>
<td>Debit</td><td><?=number_format($journal__debit, 2);?></td></tr><tr class='basic'>
<td>Credit</td><td><?=number_format($journal__credit, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$journal__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$journal__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$journal__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$journal__createdby;?></td></tr>

</table>

<br>
<div id="journal_manual_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/journal_manual_lineedit/index/".$journal_manual_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="journal_manual_lineconfirmdelete(<?=$journal_manual_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="journal_manual_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/journal_manual_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
