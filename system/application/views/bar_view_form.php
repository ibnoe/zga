<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#barchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function barconfirmdelete(delid, obj)
	{
		$('#bar-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', barconfirmdelete3(delid, obj));
	}

function barconfirmdelete2(delid, obj)
	{
		$( "#bar-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					barcalldeletefn('bardelete', delid, 'barlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bar-dialog-confirm').html('');
	}
	
	function barconfirmdelete3(delid, obj)
	{
		$( "#bar-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					barcalldeletefn3('bardelete', delid, 'barlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bar-dialog-confirm').html('');
	}

function barcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function barcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="bar-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Bar</h3>

<?=form_hidden("bar_id", $bar_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item ID</td><td><?=$item__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$item__name;?></td></tr><tr class='basic'>
<td>Bar Code</td><td><?=$item__barcode;?></td></tr><tr class='basic'>
<td>Length</td><td><?=number_format($item__length, 2);?></td></tr><tr class='basic'>
<td>Press Type</td><td><?=$item__pressmodel;?></td></tr><tr class='basic'>
<td>Minimum Quantity</td><td><?=number_format($item__minquantity, 2);?></td></tr><tr class='basic'>
<td>Maximum Quantity</td><td><?=number_format($item__maxquantity, 2);?></td></tr><tr class='basic'>
<td>Buffer 3 Months</td><td><?=number_format($item__buffer3months, 2);?></td></tr><tr class='basic'>
<td>Is Purchasable?</td><td><?=$item__purchaseable;?></td></tr><tr class='basic'>
<td>Is Sellable?</td><td><?=$item__sellable;?></td></tr><tr class='basic'>
<td>Is Manufactured?</td><td><?=$item__manufactured;?></td></tr><tr class='basic'>
<td>Account Persediaan</td><td><?=isset($coa_opt[$item__persediaan_coa_id])?$coa_opt[$item__persediaan_coa_id]:'';?></td></tr><tr class='basic'>
<td>Account HPP</td><td><?=isset($coa_opt[$item__hpp_coa_id])?$coa_opt[$item__hpp_coa_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$item__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$item__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$item__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$item__createdby;?></td></tr>

</table>

<br>
<div id="barbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/baredit/index/".$bar_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="barconfirmdelete(<?=$bar_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="barchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/barlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
