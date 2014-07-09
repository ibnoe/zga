<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#pay_accountschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function pay_accountsconfirmdelete(delid, obj)
	{
		$('#pay_accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', pay_accountsconfirmdelete3(delid, obj));
	}

function pay_accountsconfirmdelete2(delid, obj)
	{
		$( "#pay_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					pay_accountscalldeletefn('pay_accountsdelete', delid, 'pay_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#pay_accounts-dialog-confirm').html('');
	}
	
	function pay_accountsconfirmdelete3(delid, obj)
	{
		$( "#pay_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					pay_accountscalldeletefn3('pay_accountsdelete', delid, 'pay_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#pay_accounts-dialog-confirm').html('');
	}

function pay_accountscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function pay_accountscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="pay_accounts-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Pay Accounts</h3>

<?=form_hidden("pay_accounts_id", $pay_accounts_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Acc No</td><td><?=$coa__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$coa__name;?></td></tr><tr class='basic'>
<td>Type</td><td><?=isset($coatype_opt[$coa__coatype_id])?$coatype_opt[$coa__coatype_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$coa__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$coa__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$coa__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$coa__createdby;?></td></tr>

</table>

<br>
<div id="pay_accountsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/pay_accountsedit/index/".$pay_accounts_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="pay_accountsconfirmdelete(<?=$pay_accounts_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="pay_accountschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/pay_accountslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
