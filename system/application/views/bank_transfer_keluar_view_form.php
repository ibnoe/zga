<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#bank_transfer_keluarchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function bank_transfer_keluarconfirmdelete(delid, obj)
	{
		$('#bank_transfer_keluar-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', bank_transfer_keluarconfirmdelete3(delid, obj));
	}

function bank_transfer_keluarconfirmdelete2(delid, obj)
	{
		$( "#bank_transfer_keluar-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					bank_transfer_keluarcalldeletefn('bank_transfer_keluardelete', delid, 'bank_transfer_keluarlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bank_transfer_keluar-dialog-confirm').html('');
	}
	
	function bank_transfer_keluarconfirmdelete3(delid, obj)
	{
		$( "#bank_transfer_keluar-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					bank_transfer_keluarcalldeletefn3('bank_transfer_keluardelete', delid, 'bank_transfer_keluarlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bank_transfer_keluar-dialog-confirm').html('');
	}

function bank_transfer_keluarcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function bank_transfer_keluarcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="bank_transfer_keluar-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Bank Transfer Keluar</h3>

<?=form_hidden("bank_transfer_keluar_id", $bank_transfer_keluar_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$banktransferkeluar__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$banktransferkeluar__date;?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$banktransferkeluar__currency_id])?$currency_opt[$banktransferkeluar__currency_id]:'';?></td></tr><tr class='basic'>
<td>Amount</td><td><?=number_format($banktransferkeluar__amount, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$banktransferkeluar__notes;?></td></tr><tr class='basic'>
<td>Transferred</td><td><?=$banktransferkeluar__transferedflag;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$banktransferkeluar__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$banktransferkeluar__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$banktransferkeluar__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$banktransferkeluar__createdby;?></td></tr>

</table>

<br>
<div id="bank_transfer_keluarbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/bank_transfer_keluaredit/index/".$bank_transfer_keluar_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="bank_transfer_keluarconfirmdelete(<?=$bank_transfer_keluar_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="bank_transfer_keluarchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bank_transfer_keluarlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
