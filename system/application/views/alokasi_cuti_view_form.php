<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#alokasi_cutichildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function alokasi_cuticonfirmdelete(delid, obj)
	{
		$('#alokasi_cuti-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', alokasi_cuticonfirmdelete3(delid, obj));
	}

function alokasi_cuticonfirmdelete2(delid, obj)
	{
		$( "#alokasi_cuti-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					alokasi_cuticalldeletefn('alokasi_cutidelete', delid, 'alokasi_cutilist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#alokasi_cuti-dialog-confirm').html('');
	}
	
	function alokasi_cuticonfirmdelete3(delid, obj)
	{
		$( "#alokasi_cuti-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					alokasi_cuticalldeletefn3('alokasi_cutidelete', delid, 'alokasi_cutilist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#alokasi_cuti-dialog-confirm').html('');
	}

function alokasi_cuticalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function alokasi_cuticalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="alokasi_cuti-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Alokasi Cuti</h3>

<?=form_hidden("alokasi_cuti_id", $alokasi_cuti_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Start Date</td><td><?=$cutiallowance__begindate;?></td></tr><tr class='basic'>
<td>Total Cuti</td><td><?=number_format($cutiallowance__totalcuti, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$cutiallowance__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$cutiallowance__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$cutiallowance__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$cutiallowance__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$cutiallowance__createdby;?></td></tr>

</table>

<br>
<div id="alokasi_cutibuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/alokasi_cutiedit/index/".$alokasi_cuti_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="alokasi_cuticonfirmdelete(<?=$alokasi_cuti_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="alokasi_cutichildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/alokasi_cutilist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
