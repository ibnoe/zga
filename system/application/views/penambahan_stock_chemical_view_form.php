<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#penambahan_stock_chemicalchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function penambahan_stock_chemicalconfirmdelete(delid, obj)
	{
		$('#penambahan_stock_chemical-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', penambahan_stock_chemicalconfirmdelete3(delid, obj));
	}

function penambahan_stock_chemicalconfirmdelete2(delid, obj)
	{
		$( "#penambahan_stock_chemical-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					penambahan_stock_chemicalcalldeletefn('penambahan_stock_chemicaldelete', delid, 'penambahan_stock_chemicallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penambahan_stock_chemical-dialog-confirm').html('');
	}
	
	function penambahan_stock_chemicalconfirmdelete3(delid, obj)
	{
		$( "#penambahan_stock_chemical-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					penambahan_stock_chemicalcalldeletefn3('penambahan_stock_chemicaldelete', delid, 'penambahan_stock_chemicallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penambahan_stock_chemical-dialog-confirm').html('');
	}

function penambahan_stock_chemicalcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function penambahan_stock_chemicalcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="penambahan_stock_chemical-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Penambahan Stock Chemical</h3>

<?=form_hidden("penambahan_stock_chemical_id", $penambahan_stock_chemical_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$penambahanstockchemical__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$penambahanstockchemical__date;?></td></tr><tr class='basic'>
<td>Product Name</td><td><?=$penambahanstockchemical__name;?></td></tr><tr class='basic'>
<td>Job Order No</td><td><?=$penambahanstockchemical__joborderno;?></td></tr><tr class='basic'>
<td>Batch No</td><td><?=$penambahanstockchemical__batchno;?></td></tr><tr class='basic'>
<td>Packing</td><td><?=$penambahanstockchemical__packing;?></td></tr><tr class='basic'>
<td>Quantity (Liter/Kg)</td><td><?=$penambahanstockchemical__qtyliterkg;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$penambahanstockchemical__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$penambahanstockchemical__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$penambahanstockchemical__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$penambahanstockchemical__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$penambahanstockchemical__createdby;?></td></tr>

</table>

<br>
<div id="penambahan_stock_chemicalbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/penambahan_stock_chemicaledit/index/".$penambahan_stock_chemical_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="penambahan_stock_chemicalconfirmdelete(<?=$penambahan_stock_chemical_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="penambahan_stock_chemicalchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penambahan_stock_chemicallist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
