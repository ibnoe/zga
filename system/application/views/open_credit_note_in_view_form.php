<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#open_credit_note_inchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function open_credit_note_inconfirmdelete(delid, obj)
	{
		$('#open_credit_note_in-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_credit_note_inconfirmdelete3(delid, obj));
	}

function open_credit_note_inconfirmdelete2(delid, obj)
	{
		$( "#open_credit_note_in-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_credit_note_incalldeletefn('open_credit_note_indelete', delid, 'open_credit_note_inlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_credit_note_in-dialog-confirm').html('');
	}
	
	function open_credit_note_inconfirmdelete3(delid, obj)
	{
		$( "#open_credit_note_in-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					open_credit_note_incalldeletefn3('open_credit_note_indelete', delid, 'open_credit_note_inlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_credit_note_in-dialog-confirm').html('');
	}

function open_credit_note_incalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function open_credit_note_incalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="open_credit_note_in-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Open Credit Note In</h3>

<?=form_hidden("open_credit_note_in_id", $open_credit_note_in_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$creditnotein__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$creditnotein__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$creditnotein__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$creditnotein__createdby;?></td></tr>

</table>

<br>
<div id="open_credit_note_inbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_credit_note_inedit/index/".$open_credit_note_in_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="open_credit_note_inconfirmdelete(<?=$open_credit_note_in_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="open_credit_note_inchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_credit_note_inlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
