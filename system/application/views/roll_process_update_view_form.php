<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#roll_process_updatechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function roll_process_updateconfirmdelete(delid, obj)
	{
		$('#roll_process_update-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', roll_process_updateconfirmdelete3(delid, obj));
	}

function roll_process_updateconfirmdelete2(delid, obj)
	{
		$( "#roll_process_update-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					roll_process_updatecalldeletefn('roll_process_updatedelete', delid, 'roll_process_updatelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roll_process_update-dialog-confirm').html('');
	}
	
	function roll_process_updateconfirmdelete3(delid, obj)
	{
		$( "#roll_process_update-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					roll_process_updatecalldeletefn3('roll_process_updatedelete', delid, 'roll_process_updatelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roll_process_update-dialog-confirm').html('');
	}

function roll_process_updatecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function roll_process_updatecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="roll_process_update-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Roll Process Update</h3>

<?=form_hidden("roll_process_update_id", $roll_process_update_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>No</td><td><?=$rollprocessupdate__idstring;?></td></tr><tr class='basic'>
<td>No Order And Customer</td><td><?=$rollprocessupdate__noorderandcustomer;?></td></tr><tr class='basic'>
<td>Incoming Date</td><td><?=$rollprocessupdate__date;?></td></tr><tr class='basic'>
<td>Incoming Quantity</td><td><?=$rollprocessupdate__qty1;?></td></tr><tr class='basic'>
<td>Machine Type Roll</td><td><?=$rollprocessupdate__machinetyperoll;?></td></tr><tr class='basic'>
<td>Compound</td><td><?=$rollprocessupdate__compound;?></td></tr><tr class='basic'>
<td>RD</td><td><?=$rollprocessupdate__rd;?></td></tr><tr class='basic'>
<td>WL</td><td><?=$rollprocessupdate__wl;?></td></tr><tr class='basic'>
<td>TL</td><td><?=$rollprocessupdate__tl;?></td></tr><tr class='basic'>
<td>Qty</td><td><?=$rollprocessupdate__qty2;?></td></tr><tr class='basic'>
<td>Shipping</td><td><?=$rollprocessupdate__shipping;?></td></tr><tr class='basic'>
<td>Wrapping</td><td><?=$rollprocessupdate__wrapping;?></td></tr><tr class='basic'>
<td>Vulcanizing</td><td><?=$rollprocessupdate__vulcanizing;?></td></tr><tr class='basic'>
<td>Face Off</td><td><?=$rollprocessupdate__faceoff;?></td></tr><tr class='basic'>
<td>Grinding</td><td><?=$rollprocessupdate__grinding;?></td></tr><tr class='basic'>
<td>Polishing</td><td><?=$rollprocessupdate__polishing;?></td></tr><tr class='basic'>
<td>Max Date</td><td><?=$rollprocessupdate__maxdate;?></td></tr><tr class='basic'>
<td>Deadline Date</td><td><?=$rollprocessupdate__deadlinedate;?></td></tr><tr class='basic'>
<td>Description</td><td><?=$rollprocessupdate__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$rollprocessupdate__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$rollprocessupdate__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$rollprocessupdate__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$rollprocessupdate__createdby;?></td></tr>

</table>

<br>
<div id="roll_process_updatebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/roll_process_updateedit/index/".$roll_process_update_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="roll_process_updateconfirmdelete(<?=$roll_process_update_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="roll_process_updatechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/roll_process_updatelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
