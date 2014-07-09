<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#packing_unitchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function packing_unitconfirmdelete(delid, obj)
	{
		$('#packing_unit-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', packing_unitconfirmdelete3(delid, obj));
	}

function packing_unitconfirmdelete2(delid, obj)
	{
		$( "#packing_unit-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					packing_unitcalldeletefn('packing_unitdelete', delid, 'packing_unitlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#packing_unit-dialog-confirm').html('');
	}
	
	function packing_unitconfirmdelete3(delid, obj)
	{
		$( "#packing_unit-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					packing_unitcalldeletefn3('packing_unitdelete', delid, 'packing_unitlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#packing_unit-dialog-confirm').html('');
	}

function packing_unitcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function packing_unitcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="packing_unit-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Packing Unit</h3>

<?=form_hidden("packing_unit_id", $packing_unit_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Name</td><td><?=$packingunit__name;?></td></tr><tr class='basic'>
<td>Ratio</td><td><?=number_format($packingunit__ratio, 2);?></td></tr><tr class='basic'>
<td>Uom</td><td><?=isset($uom_opt[$packingunit__uom_id])?$uom_opt[$packingunit__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$packingunit__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$packingunit__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$packingunit__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$packingunit__createdby;?></td></tr>

</table>

<br>
<div id="packing_unitbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/packing_unitedit/index/".$packing_unit_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="packing_unitconfirmdelete(<?=$packing_unit_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="packing_unitchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/packing_unitlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
