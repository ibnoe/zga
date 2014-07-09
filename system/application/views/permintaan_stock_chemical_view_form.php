<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#permintaan_stock_chemicalchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function permintaan_stock_chemicalconfirmdelete(delid, obj)
	{
		$('#permintaan_stock_chemical-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', permintaan_stock_chemicalconfirmdelete3(delid, obj));
	}

function permintaan_stock_chemicalconfirmdelete2(delid, obj)
	{
		$( "#permintaan_stock_chemical-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					permintaan_stock_chemicalcalldeletefn('permintaan_stock_chemicaldelete', delid, 'permintaan_stock_chemicallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock_chemical-dialog-confirm').html('');
	}
	
	function permintaan_stock_chemicalconfirmdelete3(delid, obj)
	{
		$( "#permintaan_stock_chemical-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					permintaan_stock_chemicalcalldeletefn3('permintaan_stock_chemicaldelete', delid, 'permintaan_stock_chemicallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock_chemical-dialog-confirm').html('');
	}

function permintaan_stock_chemicalcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function permintaan_stock_chemicalcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="permintaan_stock_chemical-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Permintaan Stock Chemical</h3>

<?=form_hidden("permintaan_stock_chemical_id", $permintaan_stock_chemical_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$permintaanstockchemical__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$permintaanstockchemical__date;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$permintaanstockchemical__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$permintaanstockchemical__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$permintaanstockchemical__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$permintaanstockchemical__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$permintaanstockchemical__createdby;?></td></tr>

</table>

<br>
<div id="permintaan_stock_chemicalbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/permintaan_stock_chemicaledit/index/".$permintaan_stock_chemical_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="permintaan_stock_chemicalconfirmdelete(<?=$permintaan_stock_chemical_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="permintaan_stock_chemicalchildtabs">
	
	<ul><li><a href='<?=site_url()."/permintaan_stock_chemical_linelist/index/".$permintaan_stock_chemical_id;?>'>Permintaan Stock Chemical Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/permintaan_stock_chemicallist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
