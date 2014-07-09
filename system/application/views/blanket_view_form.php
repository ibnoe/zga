<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#blanketchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function blanketconfirmdelete(delid, obj)
	{
		$('#blanket-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', blanketconfirmdelete3(delid, obj));
	}

function blanketconfirmdelete2(delid, obj)
	{
		$( "#blanket-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					blanketcalldeletefn('blanketdelete', delid, 'blanketlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket-dialog-confirm').html('');
	}
	
	function blanketconfirmdelete3(delid, obj)
	{
		$( "#blanket-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					blanketcalldeletefn3('blanketdelete', delid, 'blanketlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket-dialog-confirm').html('');
	}

function blanketcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function blanketcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="blanket-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Blanket</h3>

<?=form_hidden("blanket_id", $blanket_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item ID</td><td><?=$item__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$item__name;?></td></tr><tr class='basic'>
<td>Pallete No</td><td><?=$item__palleteno;?></td></tr><tr class='basic'>
<td>Code Baru</td><td><?=$item__codebaru;?></td></tr><tr class='basic'>
<td>Press & Type</td><td><?=$item__pressntype;?></td></tr><tr class='dimensions'>
<td>AC</td><td><?=number_format($item__ac, 2);?></td></tr><tr class='dimensions'>
<td>AR</td><td><?=number_format($item__ar, 2);?></td></tr><tr class='dimensions'>
<td>Thickness</td><td><?=number_format($item__thickness, 2);?></td></tr><tr class='basic'>
<td>Bar Type</td><td><?=$item__bartype;?></td></tr><tr class='basic'>
<td>Moving Speed</td><td><?=$item__movingspeed;?></td></tr><tr class='basic'>
<td>Minimum Stock</td><td><?=number_format($item__minquantity, 2);?></td></tr><tr class='basic'>
<td>Maximum Stock</td><td><?=number_format($item__maxquantity, 2);?></td></tr><tr class='basic'>
<td>Converting Place</td><td><?=$item__barorigin;?></td></tr><tr class='basic'>
<td>Bar/Non Bar</td><td><?=$item__barnonbar;?></td></tr><tr class='basic'>
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
<div id="blanketbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/blanketedit/index/".$blanket_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="blanketconfirmdelete(<?=$blanket_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="blanketchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/blanketlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
