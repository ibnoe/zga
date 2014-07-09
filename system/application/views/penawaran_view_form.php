<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#penawaranchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function penawaranconfirmdelete(delid, obj)
	{
		$('#penawaran-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', penawaranconfirmdelete3(delid, obj));
	}

function penawaranconfirmdelete2(delid, obj)
	{
		$( "#penawaran-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					penawarancalldeletefn('penawarandelete', delid, 'penawaranlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penawaran-dialog-confirm').html('');
	}
	
	function penawaranconfirmdelete3(delid, obj)
	{
		$( "#penawaran-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					penawarancalldeletefn3('penawarandelete', delid, 'penawaranlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penawaran-dialog-confirm').html('');
	}

function penawarancalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function penawarancalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="penawaran-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Penawaran</h3>

<?=form_hidden("penawaran_id", $penawaran_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>No Penawaran</td><td><?=$salesorderquote__nopenawaran;?></td></tr><tr class='basic'>
<td>No PO</td><td><?=$salesorderquote__customerponumber;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$salesorderquote__date;?></td></tr><tr class='basic'>
<td>Description</td><td><?=$salesorderquote__notes;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$salesorderquote__customer_id])?$customer_opt[$salesorderquote__customer_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$salesorderquote__currency_id])?$currency_opt[$salesorderquote__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($salesorderquote__currencyrate, 2);?></td></tr><tr class='basic'>
<td>Marketing Officer</td><td><?=isset($marketingofficer_opt[$salesorderquote__marketingofficer_id])?$marketingofficer_opt[$salesorderquote__marketingofficer_id]:'';?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#salesorderquote__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});</script>
<td>Status</td><td><?=$salesorderquote__status;?></td></tr><tr class='approved'>
<td>SO ID</td><td><?=$salesorderquote__orderid;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesorderquote__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesorderquote__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesorderquote__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesorderquote__createdby;?></td></tr>

</table>

<br>
<div id="penawaranbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/penawaranedit/index/".$penawaran_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="penawaranconfirmdelete(<?=$penawaran_id;?>, this);"></td>
<td class="print"><input class="button" type="button" value="Print" onclick="location.href='<?=site_url()."/printing/index/penawaran/".$penawaran_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="penawaranchildtabs">
	
	<ul><li><a href='<?=site_url()."/penawaran_linelist/index/".$penawaran_id;?>'>Penawaran Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penawaranlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
