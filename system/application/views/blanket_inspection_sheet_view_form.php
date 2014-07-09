<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#blanket_inspection_sheetchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function blanket_inspection_sheetconfirmdelete(delid, obj)
	{
		$('#blanket_inspection_sheet-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', blanket_inspection_sheetconfirmdelete3(delid, obj));
	}

function blanket_inspection_sheetconfirmdelete2(delid, obj)
	{
		$( "#blanket_inspection_sheet-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					blanket_inspection_sheetcalldeletefn('blanket_inspection_sheetdelete', delid, 'blanket_inspection_sheetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket_inspection_sheet-dialog-confirm').html('');
	}
	
	function blanket_inspection_sheetconfirmdelete3(delid, obj)
	{
		$( "#blanket_inspection_sheet-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					blanket_inspection_sheetcalldeletefn3('blanket_inspection_sheetdelete', delid, 'blanket_inspection_sheetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket_inspection_sheet-dialog-confirm').html('');
	}

function blanket_inspection_sheetcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function blanket_inspection_sheetcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="blanket_inspection_sheet-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Blanket Inspection Sheet</h3>

<?=form_hidden("blanket_inspection_sheet_id", $blanket_inspection_sheet_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$blanketinspectionsheet__date;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$blanketinspectionsheet__customer_id])?$customer_opt[$blanketinspectionsheet__customer_id]:'';?></td></tr><tr class='basic'>
<td>Product Name</td><td><?=$blanketinspectionsheet__productname;?></td></tr><tr class='basic'>
<td>Press Type</td><td><?=$blanketinspectionsheet__presstype;?></td></tr><tr class='basic'>
<td>Bar Size</td><td><?=$blanketinspectionsheet__barsize;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$blanketinspectionsheet__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$blanketinspectionsheet__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$blanketinspectionsheet__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$blanketinspectionsheet__createdby;?></td></tr>

</table>

<br>
<div id="blanket_inspection_sheetbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/blanket_inspection_sheetedit/index/".$blanket_inspection_sheet_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="blanket_inspection_sheetconfirmdelete(<?=$blanket_inspection_sheet_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="blanket_inspection_sheetchildtabs">
	
	<ul><li><a href='<?=site_url()."/blanket_inspection_sheet_linelist/index/".$blanket_inspection_sheet_id;?>'>Blanket Inspection Sheet Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/blanket_inspection_sheetlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
