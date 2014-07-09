<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#credit_note_outchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function credit_note_outconfirmdelete(delid, obj)
	{
		$('#credit_note_out-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', credit_note_outconfirmdelete3(delid, obj));
	}

function credit_note_outconfirmdelete2(delid, obj)
	{
		$( "#credit_note_out-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					credit_note_outcalldeletefn('credit_note_outdelete', delid, 'credit_note_outlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#credit_note_out-dialog-confirm').html('');
	}
	
	function credit_note_outconfirmdelete3(delid, obj)
	{
		$( "#credit_note_out-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					credit_note_outcalldeletefn3('credit_note_outdelete', delid, 'credit_note_outlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#credit_note_out-dialog-confirm').html('');
	}

function credit_note_outcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function credit_note_outcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="credit_note_out-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Credit Note Out</h3>

<?=form_hidden("credit_note_out_id", $credit_note_out_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>CN ID</td><td><?=$creditnoteout__creditnoteoutid;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$creditnoteout__date;?></td></tr><tr class='basic'>
<td>Expiry Date</td><td><?=$creditnoteout__expirydate;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$creditnoteout__customer_id])?$customer_opt[$creditnoteout__customer_id]:'';?></td></tr><tr class='basic'>
<td>Account</td><td><?=isset($coa_opt[$creditnoteout__coa_id])?$coa_opt[$creditnoteout__coa_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$creditnoteout__currency_id])?$currency_opt[$creditnoteout__currency_id]:'';?></td></tr><tr class='basic'>
<td>Amount</td><td><?=number_format($creditnoteout__amount, 2);?></td></tr><tr class='basic'>
<td>Amount Used</td><td><?=number_format($creditnoteout__amountused, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$creditnoteout__notes;?></td></tr><tr class='basic'>
<td>Used</td><td><?=$creditnoteout__usedflag;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$creditnoteout__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$creditnoteout__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$creditnoteout__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$creditnoteout__createdby;?></td></tr>

</table>

<br>
<div id="credit_note_outbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/credit_note_outedit/index/".$credit_note_out_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="credit_note_outconfirmdelete(<?=$credit_note_out_id;?>, this);"></td>
<td class="print"><input class="button" type="button" value="Print" onclick="location.href='<?=site_url()."/printing/index/credit_note_out/".$credit_note_out_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="credit_note_outchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/credit_note_outlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
