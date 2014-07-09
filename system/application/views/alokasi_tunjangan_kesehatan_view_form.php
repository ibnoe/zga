<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#alokasi_tunjangan_kesehatanchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function alokasi_tunjangan_kesehatanconfirmdelete(delid, obj)
	{
		$('#alokasi_tunjangan_kesehatan-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', alokasi_tunjangan_kesehatanconfirmdelete3(delid, obj));
	}

function alokasi_tunjangan_kesehatanconfirmdelete2(delid, obj)
	{
		$( "#alokasi_tunjangan_kesehatan-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					alokasi_tunjangan_kesehatancalldeletefn('alokasi_tunjangan_kesehatandelete', delid, 'alokasi_tunjangan_kesehatanlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#alokasi_tunjangan_kesehatan-dialog-confirm').html('');
	}
	
	function alokasi_tunjangan_kesehatanconfirmdelete3(delid, obj)
	{
		$( "#alokasi_tunjangan_kesehatan-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					alokasi_tunjangan_kesehatancalldeletefn3('alokasi_tunjangan_kesehatandelete', delid, 'alokasi_tunjangan_kesehatanlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#alokasi_tunjangan_kesehatan-dialog-confirm').html('');
	}

function alokasi_tunjangan_kesehatancalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function alokasi_tunjangan_kesehatancalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="alokasi_tunjangan_kesehatan-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Alokasi Tunjangan Kesehatan</h3>

<?=form_hidden("alokasi_tunjangan_kesehatan_id", $alokasi_tunjangan_kesehatan_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$tunjangankesehatanallowance__date;?></td></tr><tr class='basic'>
<td>Description</td><td><?=$tunjangankesehatanallowance__description;?></td></tr><tr class='basic'>
<td>Amount</td><td><?=number_format($tunjangankesehatanallowance__amount, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$tunjangankesehatanallowance__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$tunjangankesehatanallowance__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$tunjangankesehatanallowance__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$tunjangankesehatanallowance__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$tunjangankesehatanallowance__createdby;?></td></tr>

</table>

<br>
<div id="alokasi_tunjangan_kesehatanbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/alokasi_tunjangan_kesehatanedit/index/".$alokasi_tunjangan_kesehatan_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="alokasi_tunjangan_kesehatanconfirmdelete(<?=$alokasi_tunjangan_kesehatan_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="alokasi_tunjangan_kesehatanchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/alokasi_tunjangan_kesehatanlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
