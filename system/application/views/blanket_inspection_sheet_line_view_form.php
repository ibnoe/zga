<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#blanket_inspection_sheet_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function blanket_inspection_sheet_lineconfirmdelete(delid, obj)
	{
		$('#blanket_inspection_sheet_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', blanket_inspection_sheet_lineconfirmdelete3(delid, obj));
	}

function blanket_inspection_sheet_lineconfirmdelete2(delid, obj)
	{
		$( "#blanket_inspection_sheet_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					blanket_inspection_sheet_linecalldeletefn('blanket_inspection_sheet_linedelete', delid, 'blanket_inspection_sheet_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket_inspection_sheet_line-dialog-confirm').html('');
	}
	
	function blanket_inspection_sheet_lineconfirmdelete3(delid, obj)
	{
		$( "#blanket_inspection_sheet_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					blanket_inspection_sheet_linecalldeletefn3('blanket_inspection_sheet_linedelete', delid, 'blanket_inspection_sheet_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket_inspection_sheet_line-dialog-confirm').html('');
	}

function blanket_inspection_sheet_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function blanket_inspection_sheet_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="blanket_inspection_sheet_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Blanket Inspection Sheet Line</h3>

<?=form_hidden("blanket_inspection_sheet_line_id", $blanket_inspection_sheet_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>QC Code</td><td><?=$blanketinspectionsheetline__qccode;?></td></tr><tr class='basic'>
<td>AC 1</td><td><?=$blanketinspectionsheetline__ac1;?></td></tr><tr class='basic'>
<td>AC 2</td><td><?=$blanketinspectionsheetline__ac2;?></td></tr><tr class='basic'>
<td>AR 1</td><td><?=$blanketinspectionsheetline__ar1;?></td></tr><tr class='basic'>
<td>AR 2</td><td><?=$blanketinspectionsheetline__ar2;?></td></tr><tr class='basic'>
<td>Thickness</td><td><?=$blanketinspectionsheetline__thickness;?></td></tr><tr class='basic'>
<td>KS</td><td><?=$blanketinspectionsheetline__ks;?></td></tr><tr class='basic'>
<td>Roll No</td><td><?=$blanketinspectionsheetline__rollno;?></td></tr><tr class='basic'>
<td>Barring Date</td><td><?=$blanketinspectionsheetline__barringdate;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$blanketinspectionsheetline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$blanketinspectionsheetline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$blanketinspectionsheetline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$blanketinspectionsheetline__createdby;?></td></tr>

</table>

<br>
<div id="blanket_inspection_sheet_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/blanket_inspection_sheet_lineedit/index/".$blanket_inspection_sheet_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="blanket_inspection_sheet_lineconfirmdelete(<?=$blanket_inspection_sheet_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="blanket_inspection_sheet_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/blanket_inspection_sheet_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
