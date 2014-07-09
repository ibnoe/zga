<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#bill_of_materialchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function bill_of_materialconfirmdelete(delid, obj)
	{
		$('#bill_of_material-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', bill_of_materialconfirmdelete3(delid, obj));
	}

function bill_of_materialconfirmdelete2(delid, obj)
	{
		$( "#bill_of_material-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					bill_of_materialcalldeletefn('bill_of_materialdelete', delid, 'bill_of_materiallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bill_of_material-dialog-confirm').html('');
	}
	
	function bill_of_materialconfirmdelete3(delid, obj)
	{
		$( "#bill_of_material-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					bill_of_materialcalldeletefn3('bill_of_materialdelete', delid, 'bill_of_materiallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bill_of_material-dialog-confirm').html('');
	}

function bill_of_materialcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function bill_of_materialcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="bill_of_material-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Bill Of Material</h3>

<?=form_hidden("bill_of_material_id", $bill_of_material_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Bill Name</td><td><?=$bom__name;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$bom__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$bom__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$bom__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$bom__createdby;?></td></tr>

</table>

<br>
<div id="bill_of_materialbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/bill_of_materialedit/index/".$bill_of_material_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="bill_of_materialconfirmdelete(<?=$bill_of_material_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="bill_of_materialchildtabs">
	
	<ul><li><a href='<?=site_url()."/bill_of_material_linelist/index/".$bill_of_material_id;?>'>Bill Of Material Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bill_of_materiallist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
