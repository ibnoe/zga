<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#chemical_inspection_sheetchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function chemical_inspection_sheetconfirmdelete(delid, obj)
	{
		$('#chemical_inspection_sheet-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', chemical_inspection_sheetconfirmdelete3(delid, obj));
	}

function chemical_inspection_sheetconfirmdelete2(delid, obj)
	{
		$( "#chemical_inspection_sheet-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					chemical_inspection_sheetcalldeletefn('chemical_inspection_sheetdelete', delid, 'chemical_inspection_sheetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#chemical_inspection_sheet-dialog-confirm').html('');
	}
	
	function chemical_inspection_sheetconfirmdelete3(delid, obj)
	{
		$( "#chemical_inspection_sheet-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					chemical_inspection_sheetcalldeletefn3('chemical_inspection_sheetdelete', delid, 'chemical_inspection_sheetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#chemical_inspection_sheet-dialog-confirm').html('');
	}

function chemical_inspection_sheetcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function chemical_inspection_sheetcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="chemical_inspection_sheet-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Chemical Inspection Sheet</h3>

<?=form_hidden("chemical_inspection_sheet_id", $chemical_inspection_sheet_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$chemicalinspectionsheet__date;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$chemicalinspectionsheet__customer_id])?$customer_opt[$chemicalinspectionsheet__customer_id]:'';?></td></tr><tr class='basic'>
<td>Product Name</td><td><?=$chemicalinspectionsheet__productname;?></td></tr><tr class='basic'>
<td>Batch No</td><td><?=$chemicalinspectionsheet__batchno;?></td></tr><tr class='basic'>
<td>Chemical Type</td><td><?=$chemicalinspectionsheet__chemicaltype;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$chemicalinspectionsheet__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$chemicalinspectionsheet__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$chemicalinspectionsheet__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$chemicalinspectionsheet__createdby;?></td></tr>

</table>

<br>
<div id="chemical_inspection_sheetbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/chemical_inspection_sheetedit/index/".$chemical_inspection_sheet_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="chemical_inspection_sheetconfirmdelete(<?=$chemical_inspection_sheet_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="chemical_inspection_sheetchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/chemical_inspection_sheetlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
