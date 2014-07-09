<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#under_packingchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function under_packingconfirmdelete(delid, obj)
	{
		$('#under_packing-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', under_packingconfirmdelete3(delid, obj));
	}

function under_packingconfirmdelete2(delid, obj)
	{
		$( "#under_packing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					under_packingcalldeletefn('under_packingdelete', delid, 'under_packinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#under_packing-dialog-confirm').html('');
	}
	
	function under_packingconfirmdelete3(delid, obj)
	{
		$( "#under_packing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					under_packingcalldeletefn3('under_packingdelete', delid, 'under_packinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#under_packing-dialog-confirm').html('');
	}

function under_packingcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function under_packingcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="under_packing-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Under Packing</h3>

<?=form_hidden("under_packing_id", $under_packing_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item ID</td><td><?=$item__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$item__name;?></td></tr><tr class='basic'>
<td>Category</td><td><?=$item__category;?></td></tr><tr class='basic'>
<td>Color</td><td><?=$item__color;?></td></tr><tr class='basic'>
<td>Press Type</td><td><?=$item__presstype;?></td></tr><tr class='dimensions'>
<td>AC</td><td><?=number_format($item__ac, 2);?></td></tr><tr class='dimensions'>
<td>AR</td><td><?=number_format($item__ar, 2);?></td></tr><tr class='dimensions'>
<td>Thickness</td><td><?=number_format($item__thickness, 2);?></td></tr><tr class='basic'>
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
<div id="under_packingbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/under_packingedit/index/".$under_packing_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="under_packingconfirmdelete(<?=$under_packing_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="under_packingchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/under_packinglist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
