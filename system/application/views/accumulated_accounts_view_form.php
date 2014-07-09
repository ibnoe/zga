<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#accumulated_accountschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function accumulated_accountsconfirmdelete(delid, obj)
	{
		$('#accumulated_accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', accumulated_accountsconfirmdelete3(delid, obj));
	}

function accumulated_accountsconfirmdelete2(delid, obj)
	{
		$( "#accumulated_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					accumulated_accountscalldeletefn('accumulated_accountsdelete', delid, 'accumulated_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#accumulated_accounts-dialog-confirm').html('');
	}
	
	function accumulated_accountsconfirmdelete3(delid, obj)
	{
		$( "#accumulated_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					accumulated_accountscalldeletefn3('accumulated_accountsdelete', delid, 'accumulated_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#accumulated_accounts-dialog-confirm').html('');
	}

function accumulated_accountscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function accumulated_accountscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="accumulated_accounts-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Accumulated Accounts</h3>

<?=form_hidden("accumulated_accounts_id", $accumulated_accounts_id);?>

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
<div id="accumulated_accountsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/accumulated_accountsedit/index/".$accumulated_accounts_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="accumulated_accountsconfirmdelete(<?=$accumulated_accounts_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="accumulated_accountschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/accumulated_accountslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
