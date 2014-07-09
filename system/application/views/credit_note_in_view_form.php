<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#credit_note_inchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function credit_note_inconfirmdelete(delid, obj)
	{
		$('#credit_note_in-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', credit_note_inconfirmdelete3(delid, obj));
	}

function credit_note_inconfirmdelete2(delid, obj)
	{
		$( "#credit_note_in-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					credit_note_incalldeletefn('credit_note_indelete', delid, 'credit_note_inlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#credit_note_in-dialog-confirm').html('');
	}
	
	function credit_note_inconfirmdelete3(delid, obj)
	{
		$( "#credit_note_in-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					credit_note_incalldeletefn3('credit_note_indelete', delid, 'credit_note_inlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#credit_note_in-dialog-confirm').html('');
	}

function credit_note_incalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function credit_note_incalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="credit_note_in-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Credit Note In</h3>

<?=form_hidden("credit_note_in_id", $credit_note_in_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>CN ID</td><td><?=$creditnotein__creditnoteinid;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$creditnotein__date;?></td></tr><tr class='basic'>
<td>Expiry Date</td><td><?=$creditnotein__expirydate;?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=isset($supplier_opt[$creditnotein__supplier_id])?$supplier_opt[$creditnotein__supplier_id]:'';?></td></tr><tr class='basic'>
<td>Account</td><td><?=isset($coa_opt[$creditnotein__coa_id])?$coa_opt[$creditnotein__coa_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$creditnotein__currency_id])?$currency_opt[$creditnotein__currency_id]:'';?></td></tr><tr class='basic'>
<td>Amount</td><td><?=number_format($creditnotein__amount, 2);?></td></tr><tr class='basic'>
<td>Amount Used</td><td><?=number_format($creditnotein__amountused, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$creditnotein__notes;?></td></tr><tr class='basic'>
<td>Used</td><td><?=$creditnotein__usedflag;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$creditnotein__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$creditnotein__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$creditnotein__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$creditnotein__createdby;?></td></tr>

</table>

<br>
<div id="credit_note_inbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/credit_note_inedit/index/".$credit_note_in_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="credit_note_inconfirmdelete(<?=$credit_note_in_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="credit_note_inchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/credit_note_inlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
