<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#accountschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function accountsconfirmdelete(delid, obj)
	{
		$('#accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', accountsconfirmdelete3(delid, obj));
	}

function accountsconfirmdelete2(delid, obj)
	{
		$( "#accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					accountscalldeletefn('accountsdelete', delid, 'accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#accounts-dialog-confirm').html('');
	}
	
	function accountsconfirmdelete3(delid, obj)
	{
		$( "#accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					accountscalldeletefn3('accountsdelete', delid, 'accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#accounts-dialog-confirm').html('');
	}

function accountscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function accountscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="accounts-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Accounts</h3>

<?=form_hidden("accounts_id", $accounts_id);?>

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
<div id="accountsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/accountsedit/index/".$accounts_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="accountsconfirmdelete(<?=$accounts_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="accountschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/accountslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
