<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#giro_outchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function giro_outconfirmdelete(delid, obj)
	{
		$('#giro_out-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_outconfirmdelete3(delid, obj));
	}

function giro_outconfirmdelete2(delid, obj)
	{
		$( "#giro_out-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_outcalldeletefn('giro_outdelete', delid, 'giro_outlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out-dialog-confirm').html('');
	}
	
	function giro_outconfirmdelete3(delid, obj)
	{
		$( "#giro_out-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					giro_outcalldeletefn3('giro_outdelete', delid, 'giro_outlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out-dialog-confirm').html('');
	}

function giro_outcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function giro_outcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="giro_out-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Giro Out</h3>

<?=form_hidden("giro_out_id", $giro_out_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Giro ID</td><td><?=$giroout__girooutid;?></td></tr><tr class='basic'>
<td>Creation Date</td><td><?=$giroout__createdate;?></td></tr><tr class='basic'>
<td>Supplier</td><td><?=isset($supplier_opt[$giroout__supplier_id])?$supplier_opt[$giroout__supplier_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$giroout__currency_id])?$currency_opt[$giroout__currency_id]:'';?></td></tr><tr class='basic'>
<td>Amount</td><td><?=number_format($giroout__amount, 2);?></td></tr><tr class='basic'>
<td>Amount Used</td><td><?=number_format($giroout__amountused, 2);?></td></tr><tr class='basic'>
<td>Account</td><td><?=isset($coa_opt[$giroout__coa_id])?$coa_opt[$giroout__coa_id]:'';?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$giroout__notes;?></td></tr><tr class='basic'>
<td>Used</td><td><?=$giroout__usedflag;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$giroout__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$giroout__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$giroout__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$giroout__createdby;?></td></tr>

</table>

<br>
<div id="giro_outbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_outedit/index/".$giro_out_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_outconfirmdelete(<?=$giro_out_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="giro_outchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_outlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
