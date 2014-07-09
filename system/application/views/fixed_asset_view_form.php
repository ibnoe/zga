<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#fixed_assetchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function fixed_assetconfirmdelete(delid, obj)
	{
		$('#fixed_asset-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', fixed_assetconfirmdelete3(delid, obj));
	}

function fixed_assetconfirmdelete2(delid, obj)
	{
		$( "#fixed_asset-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					fixed_assetcalldeletefn('fixed_assetdelete', delid, 'fixed_assetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#fixed_asset-dialog-confirm').html('');
	}
	
	function fixed_assetconfirmdelete3(delid, obj)
	{
		$( "#fixed_asset-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					fixed_assetcalldeletefn3('fixed_assetdelete', delid, 'fixed_assetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#fixed_asset-dialog-confirm').html('');
	}

function fixed_assetcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function fixed_assetcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="fixed_asset-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Fixed Asset</h3>

<?=form_hidden("fixed_asset_id", $fixed_asset_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Name</td><td><?=$fixedasset__name;?></td></tr><tr class='basic'>
<td>Date Buy</td><td><?=$fixedasset__datebought;?></td></tr><tr class='basic'>
<td>Fixed Asset Account</td><td><?=isset($coa_opt[$fixedasset__coa_id])?$coa_opt[$fixedasset__coa_id]:'';?></td></tr><tr class='basic'>
<td>Pay Account</td><td><?=isset($coa_opt[$fixedasset__paidusing_coa_id])?$coa_opt[$fixedasset__paidusing_coa_id]:'';?></td></tr><tr class='basic'>
<td>Depreciation Account</td><td><?=isset($coa_opt[$fixedasset__depreciation_coa_id])?$coa_opt[$fixedasset__depreciation_coa_id]:'';?></td></tr><tr class='basic'>
<td>Accumulated Account</td><td><?=isset($coa_opt[$fixedasset__accumulated_coa_id])?$coa_opt[$fixedasset__accumulated_coa_id]:'';?></td></tr><tr class='basic'>
<td>Est Lifetime</td><td><?=number_format($fixedasset__estlifetime, 2);?></td></tr><tr class='basic'>
<td>Cost</td><td><?=number_format($fixedasset__cost, 2);?></td></tr><tr class='basic'>
<td>Salvage</td><td><?=number_format($fixedasset__salvage, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$fixedasset__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$fixedasset__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$fixedasset__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$fixedasset__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$fixedasset__createdby;?></td></tr>

</table>

<br>
<div id="fixed_assetbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/fixed_assetedit/index/".$fixed_asset_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="fixed_assetconfirmdelete(<?=$fixed_asset_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="fixed_assetchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/fixed_assetlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
