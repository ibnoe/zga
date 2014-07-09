<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#cogs_accountschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function cogs_accountsconfirmdelete(delid, obj)
	{
		$('#cogs_accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cogs_accountsconfirmdelete3(delid, obj));
	}

function cogs_accountsconfirmdelete2(delid, obj)
	{
		$( "#cogs_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cogs_accountscalldeletefn('cogs_accountsdelete', delid, 'cogs_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cogs_accounts-dialog-confirm').html('');
	}
	
	function cogs_accountsconfirmdelete3(delid, obj)
	{
		$( "#cogs_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					cogs_accountscalldeletefn3('cogs_accountsdelete', delid, 'cogs_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cogs_accounts-dialog-confirm').html('');
	}

function cogs_accountscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function cogs_accountscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="cogs_accounts-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View COGS Accounts</h3>

<?=form_hidden("cogs_accounts_id", $cogs_accounts_id);?>

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
<div id="cogs_accountsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cogs_accountsedit/index/".$cogs_accounts_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="cogs_accountsconfirmdelete(<?=$cogs_accounts_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="cogs_accountschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cogs_accountslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
