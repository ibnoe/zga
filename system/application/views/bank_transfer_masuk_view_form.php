<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#bank_transfer_masukchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function bank_transfer_masukconfirmdelete(delid, obj)
	{
		$('#bank_transfer_masuk-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', bank_transfer_masukconfirmdelete3(delid, obj));
	}

function bank_transfer_masukconfirmdelete2(delid, obj)
	{
		$( "#bank_transfer_masuk-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					bank_transfer_masukcalldeletefn('bank_transfer_masukdelete', delid, 'bank_transfer_masuklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bank_transfer_masuk-dialog-confirm').html('');
	}
	
	function bank_transfer_masukconfirmdelete3(delid, obj)
	{
		$( "#bank_transfer_masuk-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					bank_transfer_masukcalldeletefn3('bank_transfer_masukdelete', delid, 'bank_transfer_masuklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bank_transfer_masuk-dialog-confirm').html('');
	}

function bank_transfer_masukcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function bank_transfer_masukcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="bank_transfer_masuk-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Bank Transfer Masuk</h3>

<?=form_hidden("bank_transfer_masuk_id", $bank_transfer_masuk_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$banktransfermasuk__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$banktransfermasuk__date;?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$banktransfermasuk__currency_id])?$currency_opt[$banktransfermasuk__currency_id]:'';?></td></tr><tr class='basic'>
<td>Amount</td><td><?=number_format($banktransfermasuk__amount, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$banktransfermasuk__notes;?></td></tr><tr class='basic'>
<td>Transferred</td><td><?=$banktransfermasuk__transferedflag;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$banktransfermasuk__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$banktransfermasuk__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$banktransfermasuk__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$banktransfermasuk__createdby;?></td></tr>

</table>

<br>
<div id="bank_transfer_masukbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/bank_transfer_masukedit/index/".$bank_transfer_masuk_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="bank_transfer_masukconfirmdelete(<?=$bank_transfer_masuk_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="bank_transfer_masukchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bank_transfer_masuklist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
