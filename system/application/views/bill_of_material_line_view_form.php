<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#bill_of_material_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function bill_of_material_lineconfirmdelete(delid, obj)
	{
		$('#bill_of_material_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', bill_of_material_lineconfirmdelete3(delid, obj));
	}

function bill_of_material_lineconfirmdelete2(delid, obj)
	{
		$( "#bill_of_material_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					bill_of_material_linecalldeletefn('bill_of_material_linedelete', delid, 'bill_of_material_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bill_of_material_line-dialog-confirm').html('');
	}
	
	function bill_of_material_lineconfirmdelete3(delid, obj)
	{
		$( "#bill_of_material_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					bill_of_material_linecalldeletefn3('bill_of_material_linedelete', delid, 'bill_of_material_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bill_of_material_line-dialog-confirm').html('');
	}

function bill_of_material_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function bill_of_material_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="bill_of_material_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Bill Of Material Line</h3>

<?=form_hidden("bill_of_material_line_id", $bill_of_material_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$bomline__item_id])?$item_opt[$bomline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($bomline__quantity, 5);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$bomline__uom_id])?$uom_opt[$bomline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$bomline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$bomline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$bomline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$bomline__createdby;?></td></tr>

</table>

<br>
<div id="bill_of_material_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/bill_of_material_lineedit/index/".$bill_of_material_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="bill_of_material_lineconfirmdelete(<?=$bill_of_material_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="bill_of_material_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bill_of_material_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
