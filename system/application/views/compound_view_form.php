<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#compoundchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function compoundconfirmdelete(delid, obj)
	{
		$('#compound-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', compoundconfirmdelete3(delid, obj));
	}

function compoundconfirmdelete2(delid, obj)
	{
		$( "#compound-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					compoundcalldeletefn('compounddelete', delid, 'compoundlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#compound-dialog-confirm').html('');
	}
	
	function compoundconfirmdelete3(delid, obj)
	{
		$( "#compound-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					compoundcalldeletefn3('compounddelete', delid, 'compoundlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#compound-dialog-confirm').html('');
	}

function compoundcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function compoundcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="compound-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Compound</h3>

<?=form_hidden("compound_id", $compound_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item ID</td><td><?=$item__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$item__name;?></td></tr><tr class='basic'>
<td>Compound Category</td><td><?=$item__subcategory;?></td></tr><tr class='dimensions'>
<td>Expiry Duration</td><td><?=number_format($item__expiryduration, 2);?></td></tr><tr class='dimensions'>
<td>Expiry Date</td><td><?=$item__expirydate;?></td></tr><tr class='basic'>
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
<div id="compoundbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/compoundedit/index/".$compound_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="compoundconfirmdelete(<?=$compound_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="compoundchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/compoundlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
