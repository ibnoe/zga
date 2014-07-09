<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#uomchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function uomconfirmdelete(delid, obj)
	{
		$('#uom-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', uomconfirmdelete3(delid, obj));
	}

function uomconfirmdelete2(delid, obj)
	{
		$( "#uom-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					uomcalldeletefn('uomdelete', delid, 'uomlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#uom-dialog-confirm').html('');
	}
	
	function uomconfirmdelete3(delid, obj)
	{
		$( "#uom-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					uomcalldeletefn3('uomdelete', delid, 'uomlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#uom-dialog-confirm').html('');
	}

function uomcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function uomcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="uom-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Uom</h3>

<?=form_hidden("uom_id", $uom_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Name</td><td><?=$uom__name;?></td></tr><tr class='basic'>
<td>Multiplier</td><td><?=number_format($uom__multiplier, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$uom__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$uom__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$uom__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$uom__createdby;?></td></tr>

</table>

<br>
<div id="uombuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/uomedit/index/".$uom_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="uomconfirmdelete(<?=$uom_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="uomchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/uomlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
