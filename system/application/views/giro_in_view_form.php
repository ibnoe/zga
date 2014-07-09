<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#giro_inchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function giro_inconfirmdelete(delid, obj)
	{
		$('#giro_in-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_inconfirmdelete3(delid, obj));
	}

function giro_inconfirmdelete2(delid, obj)
	{
		$( "#giro_in-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_incalldeletefn('giro_indelete', delid, 'giro_inlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in-dialog-confirm').html('');
	}
	
	function giro_inconfirmdelete3(delid, obj)
	{
		$( "#giro_in-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					giro_incalldeletefn3('giro_indelete', delid, 'giro_inlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in-dialog-confirm').html('');
	}

function giro_incalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function giro_incalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="giro_in-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Giro In</h3>

<?=form_hidden("giro_in_id", $giro_in_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Giro ID</td><td><?=$giroin__giroinid;?></td></tr><tr class='basic'>
<td>Creation Date</td><td><?=$giroin__createdate;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$giroin__customer_id])?$customer_opt[$giroin__customer_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$giroin__currency_id])?$currency_opt[$giroin__currency_id]:'';?></td></tr><tr class='basic'>
<td>Amount</td><td><?=number_format($giroin__amount, 2);?></td></tr><tr class='basic'>
<td>Amount Used</td><td><?=number_format($giroin__amountused, 2);?></td></tr><tr class='basic'>
<td>Account</td><td><?=isset($coa_opt[$giroin__coa_id])?$coa_opt[$giroin__coa_id]:'';?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$giroin__notes;?></td></tr><tr class='basic'>
<td>Used</td><td><?=$giroin__usedflag;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$giroin__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$giroin__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$giroin__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$giroin__createdby;?></td></tr>

</table>

<br>
<div id="giro_inbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_inedit/index/".$giro_in_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_inconfirmdelete(<?=$giro_in_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="giro_inchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_inlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
