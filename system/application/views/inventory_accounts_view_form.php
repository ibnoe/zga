<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#inventory_accountschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function inventory_accountsconfirmdelete(delid, obj)
	{
		$('#inventory_accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', inventory_accountsconfirmdelete3(delid, obj));
	}

function inventory_accountsconfirmdelete2(delid, obj)
	{
		$( "#inventory_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					inventory_accountscalldeletefn('inventory_accountsdelete', delid, 'inventory_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#inventory_accounts-dialog-confirm').html('');
	}
	
	function inventory_accountsconfirmdelete3(delid, obj)
	{
		$( "#inventory_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					inventory_accountscalldeletefn3('inventory_accountsdelete', delid, 'inventory_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#inventory_accounts-dialog-confirm').html('');
	}

function inventory_accountscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function inventory_accountscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="inventory_accounts-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Inventory Accounts</h3>

<?=form_hidden("inventory_accounts_id", $inventory_accounts_id);?>

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
<div id="inventory_accountsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/inventory_accountsedit/index/".$inventory_accounts_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="inventory_accountsconfirmdelete(<?=$inventory_accounts_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="inventory_accountschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/inventory_accountslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
