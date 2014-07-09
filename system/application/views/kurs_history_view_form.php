<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#kurs_historychildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function kurs_historyconfirmdelete(delid, obj)
	{
		$('#kurs_history-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', kurs_historyconfirmdelete3(delid, obj));
	}

function kurs_historyconfirmdelete2(delid, obj)
	{
		$( "#kurs_history-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					kurs_historycalldeletefn('kurs_historydelete', delid, 'kurs_historylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#kurs_history-dialog-confirm').html('');
	}
	
	function kurs_historyconfirmdelete3(delid, obj)
	{
		$( "#kurs_history-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					kurs_historycalldeletefn3('kurs_historydelete', delid, 'kurs_historylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#kurs_history-dialog-confirm').html('');
	}

function kurs_historycalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function kurs_historycalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="kurs_history-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Kurs History</h3>

<?=form_hidden("kurs_history_id", $kurs_history_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$kurshistory__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$kurshistory__date;?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$kurshistory__currency_id])?$currency_opt[$kurshistory__currency_id]:'';?></td></tr><tr class='basic'>
<td>Value</td><td><?=number_format($kurshistory__value, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$kurshistory__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$kurshistory__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$kurshistory__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$kurshistory__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$kurshistory__createdby;?></td></tr>

</table>

<br>
<div id="kurs_historybuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/kurs_historyedit/index/".$kurs_history_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="kurs_historyconfirmdelete(<?=$kurs_history_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="kurs_historychildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/kurs_historylist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
