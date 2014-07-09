<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#depreciation_accountschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function depreciation_accountsconfirmdelete(delid, obj)
	{
		$('#depreciation_accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', depreciation_accountsconfirmdelete3(delid, obj));
	}

function depreciation_accountsconfirmdelete2(delid, obj)
	{
		$( "#depreciation_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					depreciation_accountscalldeletefn('depreciation_accountsdelete', delid, 'depreciation_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#depreciation_accounts-dialog-confirm').html('');
	}
	
	function depreciation_accountsconfirmdelete3(delid, obj)
	{
		$( "#depreciation_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					depreciation_accountscalldeletefn3('depreciation_accountsdelete', delid, 'depreciation_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#depreciation_accounts-dialog-confirm').html('');
	}

function depreciation_accountscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function depreciation_accountscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="depreciation_accounts-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Depreciation Accounts</h3>

<?=form_hidden("depreciation_accounts_id", $depreciation_accounts_id);?>

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
<div id="depreciation_accountsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/depreciation_accountsedit/index/".$depreciation_accounts_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="depreciation_accountsconfirmdelete(<?=$depreciation_accounts_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="depreciation_accountschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/depreciation_accountslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
