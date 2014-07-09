<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#chemicalchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function chemicalconfirmdelete(delid, obj)
	{
		$('#chemical-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', chemicalconfirmdelete3(delid, obj));
	}

function chemicalconfirmdelete2(delid, obj)
	{
		$( "#chemical-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					chemicalcalldeletefn('chemicaldelete', delid, 'chemicallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#chemical-dialog-confirm').html('');
	}
	
	function chemicalconfirmdelete3(delid, obj)
	{
		$( "#chemical-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					chemicalcalldeletefn3('chemicaldelete', delid, 'chemicallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#chemical-dialog-confirm').html('');
	}

function chemicalcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function chemicalcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="chemical-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Chemical</h3>

<?=form_hidden("chemical_id", $chemical_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item ID</td><td><?=$item__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$item__name;?></td></tr><tr class='basic'>
<td>Product Code</td><td><?=$item__chemicalcode;?></td></tr><tr class='basic'>
<td>Product Classification</td><td><?=$item__chemicaltype;?></td></tr><tr class='basic'>
<td>Packing Size</td><td><?=$item__packingsize;?></td></tr><tr class='basic'>
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
<div id="chemicalbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/chemicaledit/index/".$chemical_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="chemicalconfirmdelete(<?=$chemical_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="chemicalchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/chemicallist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
