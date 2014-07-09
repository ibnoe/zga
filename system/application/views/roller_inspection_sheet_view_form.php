<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#roller_inspection_sheetchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function roller_inspection_sheetconfirmdelete(delid, obj)
	{
		$('#roller_inspection_sheet-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', roller_inspection_sheetconfirmdelete3(delid, obj));
	}

function roller_inspection_sheetconfirmdelete2(delid, obj)
	{
		$( "#roller_inspection_sheet-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					roller_inspection_sheetcalldeletefn('roller_inspection_sheetdelete', delid, 'roller_inspection_sheetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roller_inspection_sheet-dialog-confirm').html('');
	}
	
	function roller_inspection_sheetconfirmdelete3(delid, obj)
	{
		$( "#roller_inspection_sheet-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					roller_inspection_sheetcalldeletefn3('roller_inspection_sheetdelete', delid, 'roller_inspection_sheetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roller_inspection_sheet-dialog-confirm').html('');
	}

function roller_inspection_sheetcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function roller_inspection_sheetcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="roller_inspection_sheet-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Roller Inspection Sheet</h3>

<?=form_hidden("roller_inspection_sheet_id", $roller_inspection_sheet_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$rollerinspectionsheet__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$rollerinspectionsheet__date;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$rollerinspectionsheet__customer_id])?$customer_opt[$rollerinspectionsheet__customer_id]:'';?></td></tr><tr class='basic'>
<td>Mesin</td><td><?=isset($mesin_opt[$rollerinspectionsheet__mesin_id])?$mesin_opt[$rollerinspectionsheet__mesin_id]:'';?></td></tr><tr class='basic'>
<td>Roll</td><td><?=isset($item_opt[$rollerinspectionsheet__roll_id])?$item_opt[$rollerinspectionsheet__roll_id]:'';?></td></tr><tr class='basic'>
<td>Order No</td><td><?=$rollerinspectionsheet__orderno;?></td></tr><tr class='basic'>
<td>Compound</td><td><?=isset($item_opt[$rollerinspectionsheet__compound_id])?$item_opt[$rollerinspectionsheet__compound_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$rollerinspectionsheet__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$rollerinspectionsheet__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$rollerinspectionsheet__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$rollerinspectionsheet__createdby;?></td></tr>

</table>

<br>
<div id="roller_inspection_sheetbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/roller_inspection_sheetedit/index/".$roller_inspection_sheet_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="roller_inspection_sheetconfirmdelete(<?=$roller_inspection_sheet_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="roller_inspection_sheetchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/roller_inspection_sheetlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
