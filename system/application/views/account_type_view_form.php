<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#account_typechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function account_typeconfirmdelete(delid, obj)
	{
		$('#account_type-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', account_typeconfirmdelete3(delid, obj));
	}

function account_typeconfirmdelete2(delid, obj)
	{
		$( "#account_type-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					account_typecalldeletefn('account_typedelete', delid, 'account_typelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#account_type-dialog-confirm').html('');
	}
	
	function account_typeconfirmdelete3(delid, obj)
	{
		$( "#account_type-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					account_typecalldeletefn3('account_typedelete', delid, 'account_typelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#account_type-dialog-confirm').html('');
	}

function account_typecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function account_typecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="account_type-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Account Type</h3>

<?=form_hidden("account_type_id", $account_type_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Account Class</td><td><?=$coatype__classtype;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$coatype__name;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$coatype__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$coatype__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$coatype__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$coatype__createdby;?></td></tr>

</table>

<br>
<div id="account_typebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/account_typeedit/index/".$account_type_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="account_typeconfirmdelete(<?=$account_type_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="account_typechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/account_typelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
