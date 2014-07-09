<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#cash_bankchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function cash_bankconfirmdelete(delid, obj)
	{
		$('#cash_bank-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cash_bankconfirmdelete3(delid, obj));
	}

function cash_bankconfirmdelete2(delid, obj)
	{
		$( "#cash_bank-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cash_bankcalldeletefn('cash_bankdelete', delid, 'cash_banklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cash_bank-dialog-confirm').html('');
	}
	
	function cash_bankconfirmdelete3(delid, obj)
	{
		$( "#cash_bank-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					cash_bankcalldeletefn3('cash_bankdelete', delid, 'cash_banklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cash_bank-dialog-confirm').html('');
	}

function cash_bankcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function cash_bankcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="cash_bank-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Cash Bank</h3>

<?=form_hidden("cash_bank_id", $cash_bank_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Name</td><td><?=$cashbank__name;?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$cashbank__currency_id])?$currency_opt[$cashbank__currency_id]:'';?></td></tr><tr class='basic'>
<td>Account</td><td><?=isset($coa_opt[$cashbank__coa_id])?$coa_opt[$cashbank__coa_id]:'';?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$cashbank__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$cashbank__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$cashbank__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$cashbank__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$cashbank__createdby;?></td></tr>

</table>

<br>
<div id="cash_bankbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cash_bankedit/index/".$cash_bank_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="cash_bankconfirmdelete(<?=$cash_bank_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="cash_bankchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cash_banklist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
