<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#chemical_work_instructionchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function chemical_work_instructionconfirmdelete(delid, obj)
	{
		$('#chemical_work_instruction-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', chemical_work_instructionconfirmdelete3(delid, obj));
	}

function chemical_work_instructionconfirmdelete2(delid, obj)
	{
		$( "#chemical_work_instruction-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					chemical_work_instructioncalldeletefn('chemical_work_instructiondelete', delid, 'chemical_work_instructionlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#chemical_work_instruction-dialog-confirm').html('');
	}
	
	function chemical_work_instructionconfirmdelete3(delid, obj)
	{
		$( "#chemical_work_instruction-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					chemical_work_instructioncalldeletefn3('chemical_work_instructiondelete', delid, 'chemical_work_instructionlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#chemical_work_instruction-dialog-confirm').html('');
	}

function chemical_work_instructioncalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function chemical_work_instructioncalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="chemical_work_instruction-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Chemical Work Instruction</h3>

<?=form_hidden("chemical_work_instruction_id", $chemical_work_instruction_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$chemicalworkinstruction__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$chemicalworkinstruction__date;?></td></tr><tr class='basic'>
<td>Product Name</td><td><?=$chemicalworkinstruction__name;?></td></tr><tr class='basic'>
<td>Job Order No</td><td><?=$chemicalworkinstruction__joborderno;?></td></tr><tr class='basic'>
<td>Packing</td><td><?=$chemicalworkinstruction__packing;?></td></tr><tr class='basic'>
<td>Quantity (Liter/Kg)</td><td><?=$chemicalworkinstruction__qtyliterkg;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$chemicalworkinstruction__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$chemicalworkinstruction__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$chemicalworkinstruction__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$chemicalworkinstruction__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$chemicalworkinstruction__createdby;?></td></tr>

</table>

<br>
<div id="chemical_work_instructionbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/chemical_work_instructionedit/index/".$chemical_work_instruction_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="chemical_work_instructionconfirmdelete(<?=$chemical_work_instruction_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="chemical_work_instructionchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/chemical_work_instructionlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
