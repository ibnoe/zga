<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#klaim_tunjangan_kesehatanchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function klaim_tunjangan_kesehatanconfirmdelete(delid, obj)
	{
		$('#klaim_tunjangan_kesehatan-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', klaim_tunjangan_kesehatanconfirmdelete3(delid, obj));
	}

function klaim_tunjangan_kesehatanconfirmdelete2(delid, obj)
	{
		$( "#klaim_tunjangan_kesehatan-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					klaim_tunjangan_kesehatancalldeletefn('klaim_tunjangan_kesehatandelete', delid, 'klaim_tunjangan_kesehatanlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#klaim_tunjangan_kesehatan-dialog-confirm').html('');
	}
	
	function klaim_tunjangan_kesehatanconfirmdelete3(delid, obj)
	{
		$( "#klaim_tunjangan_kesehatan-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					klaim_tunjangan_kesehatancalldeletefn3('klaim_tunjangan_kesehatandelete', delid, 'klaim_tunjangan_kesehatanlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#klaim_tunjangan_kesehatan-dialog-confirm').html('');
	}

function klaim_tunjangan_kesehatancalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function klaim_tunjangan_kesehatancalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="klaim_tunjangan_kesehatan-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Klaim Tunjangan Kesehatan</h3>

<?=form_hidden("klaim_tunjangan_kesehatan_id", $klaim_tunjangan_kesehatan_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$tunjangankesehatanusage__date;?></td></tr><tr class='basic'>
<td>Receipt From</td><td><?=$tunjangankesehatanusage__description;?></td></tr><tr class='basic'>
<td>Total Receipt</td><td><?=number_format($tunjangankesehatanusage__amount, 2);?></td></tr><tr class='basic'>
<td>Company Paid</td><td><?=number_format($tunjangankesehatanusage__amountpaid, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$tunjangankesehatanusage__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$tunjangankesehatanusage__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$tunjangankesehatanusage__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$tunjangankesehatanusage__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$tunjangankesehatanusage__createdby;?></td></tr>

</table>

<br>
<div id="klaim_tunjangan_kesehatanbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/klaim_tunjangan_kesehatanedit/index/".$klaim_tunjangan_kesehatan_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="klaim_tunjangan_kesehatanconfirmdelete(<?=$klaim_tunjangan_kesehatan_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="klaim_tunjangan_kesehatanchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/klaim_tunjangan_kesehatanlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
