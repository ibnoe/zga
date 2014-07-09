<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#blanket_identification_formchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function blanket_identification_formconfirmdelete(delid, obj)
	{
		$('#blanket_identification_form-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', blanket_identification_formconfirmdelete3(delid, obj));
	}

function blanket_identification_formconfirmdelete2(delid, obj)
	{
		$( "#blanket_identification_form-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					blanket_identification_formcalldeletefn('blanket_identification_formdelete', delid, 'blanket_identification_formlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket_identification_form-dialog-confirm').html('');
	}
	
	function blanket_identification_formconfirmdelete3(delid, obj)
	{
		$( "#blanket_identification_form-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					blanket_identification_formcalldeletefn3('blanket_identification_formdelete', delid, 'blanket_identification_formlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket_identification_form-dialog-confirm').html('');
	}

function blanket_identification_formcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function blanket_identification_formcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="blanket_identification_form-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Blanket Identification Form</h3>

<?=form_hidden("blanket_identification_form_id", $blanket_identification_form_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$bif__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$bif__date;?></td></tr><tr class='basic'>
<td>Marketing Officer</td><td><?=isset($marketingofficer_opt[$bif__marketingofficer_id])?$marketingofficer_opt[$bif__marketingofficer_id]:'';?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$bif__customer_id])?$customer_opt[$bif__customer_id]:'';?></td></tr><tr class='basic'>
<td>Press Model</td><td><?=$bif__pressmodel;?></td></tr><tr class='basic'>
<td>AC</td><td><?=$bif__ac;?></td></tr><tr class='basic'>
<td>AR</td><td><?=$bif__ar;?></td></tr><tr class='basic'>
<td>Thickness</td><td><?=$bif__thickness;?></td></tr><tr class='basic'>
<td>Type Bar 1</td><td><?=$bif__typebar1;?></td></tr><tr class='basic'>
<td>Length Bar 1</td><td><?=$bif__lengthbar1;?></td></tr><tr class='basic'>
<td>Position Bar 1</td><td><?=$bif__positionbar1;?></td></tr><tr class='basic'>
<td>Type Bar 2</td><td><?=$bif__typebar2;?></td></tr><tr class='basic'>
<td>Length Bar 2</td><td><?=$bif__lengthbar2;?></td></tr><tr class='basic'>
<td>Position Bar 2</td><td><?=$bif__positionbar2;?></td></tr><tr class='basic'>
<td>Corner</td><td><?=$bif__corner;?></td></tr><tr class='basic'>
<td>Needs</td><td><?=$bif__needs;?></td></tr><tr class='basic'>
<td>Drawing</td><td><a href='<?=base_url();?>upload/<?=$bif__drawingfile;?>'><?=$bif__drawingfile;?></a></td></tr><tr class='basic'>
<td>Notes</td><td><?=$bif__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$bif__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$bif__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$bif__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$bif__createdby;?></td></tr>

</table>

<br>
<div id="blanket_identification_formbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/blanket_identification_formedit/index/".$blanket_identification_form_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="blanket_identification_formconfirmdelete(<?=$blanket_identification_form_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="blanket_identification_formchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/blanket_identification_formlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
