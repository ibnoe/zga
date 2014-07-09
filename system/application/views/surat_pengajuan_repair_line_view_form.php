<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#surat_pengajuan_repair_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function surat_pengajuan_repair_lineconfirmdelete(delid, obj)
	{
		$('#surat_pengajuan_repair_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', surat_pengajuan_repair_lineconfirmdelete3(delid, obj));
	}

function surat_pengajuan_repair_lineconfirmdelete2(delid, obj)
	{
		$( "#surat_pengajuan_repair_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					surat_pengajuan_repair_linecalldeletefn('surat_pengajuan_repair_linedelete', delid, 'surat_pengajuan_repair_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#surat_pengajuan_repair_line-dialog-confirm').html('');
	}
	
	function surat_pengajuan_repair_lineconfirmdelete3(delid, obj)
	{
		$( "#surat_pengajuan_repair_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					surat_pengajuan_repair_linecalldeletefn3('surat_pengajuan_repair_linedelete', delid, 'surat_pengajuan_repair_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#surat_pengajuan_repair_line-dialog-confirm').html('');
	}

function surat_pengajuan_repair_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function surat_pengajuan_repair_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="surat_pengajuan_repair_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Surat Pengajuan Repair Line</h3>

<?=form_hidden("surat_pengajuan_repair_line_id", $surat_pengajuan_repair_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>No Diss</td><td><?=$suratpengajuanrepairline__nodiss;?></td></tr><tr class='basic'>
<td>Barang</td><td><?=isset($item_opt[$suratpengajuanrepairline__item_id])?$item_opt[$suratpengajuanrepairline__item_id]:'';?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$suratpengajuanrepairline__customer_id])?$customer_opt[$suratpengajuanrepairline__customer_id]:'';?></td></tr><tr class='basic'>
<td>Mesin</td><td><?=isset($mesin_opt[$suratpengajuanrepairline__mesin_id])?$mesin_opt[$suratpengajuanrepairline__mesin_id]:'';?></td></tr><tr class='basic'>
<td>Tipe Core</td><td><?=$suratpengajuanrepairline__tipecore;?></td></tr><tr class='basic'>
<td>Roll Diameter</td><td><?=number_format($suratpengajuanrepairline__rolldiameter, 2);?></td></tr><tr class='basic'>
<td>Bearing Seat Diameter</td><td><?=number_format($suratpengajuanrepairline__bearingseatdiameter, 2);?></td></tr><tr class='basic'>
<td>Total Length (TL)</td><td><?=number_format($suratpengajuanrepairline__totallength, 2);?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($suratpengajuanrepairline__quantity, 2);?></td></tr><tr class='basic'>
<td>Jenis Repair</td><td><?=$suratpengajuanrepairline__jenisrepair;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$suratpengajuanrepairline__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$suratpengajuanrepairline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$suratpengajuanrepairline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$suratpengajuanrepairline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$suratpengajuanrepairline__createdby;?></td></tr>

</table>

<br>
<div id="surat_pengajuan_repair_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/surat_pengajuan_repair_lineedit/index/".$surat_pengajuan_repair_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="surat_pengajuan_repair_lineconfirmdelete(<?=$surat_pengajuan_repair_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="surat_pengajuan_repair_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/surat_pengajuan_repair_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
