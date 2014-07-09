<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#permintaan_stock_chemical_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function permintaan_stock_chemical_lineconfirmdelete(delid, obj)
	{
		$('#permintaan_stock_chemical_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', permintaan_stock_chemical_lineconfirmdelete3(delid, obj));
	}

function permintaan_stock_chemical_lineconfirmdelete2(delid, obj)
	{
		$( "#permintaan_stock_chemical_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					permintaan_stock_chemical_linecalldeletefn('permintaan_stock_chemical_linedelete', delid, 'permintaan_stock_chemical_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock_chemical_line-dialog-confirm').html('');
	}
	
	function permintaan_stock_chemical_lineconfirmdelete3(delid, obj)
	{
		$( "#permintaan_stock_chemical_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					permintaan_stock_chemical_linecalldeletefn3('permintaan_stock_chemical_linedelete', delid, 'permintaan_stock_chemical_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock_chemical_line-dialog-confirm').html('');
	}

function permintaan_stock_chemical_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function permintaan_stock_chemical_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="permintaan_stock_chemical_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Permintaan Stock Chemical Line</h3>

<?=form_hidden("permintaan_stock_chemical_line_id", $permintaan_stock_chemical_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$permintaanstockchemicalline__item_id])?$item_opt[$permintaanstockchemicalline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($permintaanstockchemicalline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$permintaanstockchemicalline__uom_id])?$uom_opt[$permintaanstockchemicalline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$permintaanstockchemicalline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$permintaanstockchemicalline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$permintaanstockchemicalline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$permintaanstockchemicalline__createdby;?></td></tr>

</table>

<br>
<div id="permintaan_stock_chemical_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/permintaan_stock_chemical_lineedit/index/".$permintaan_stock_chemical_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="permintaan_stock_chemical_lineconfirmdelete(<?=$permintaan_stock_chemical_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="permintaan_stock_chemical_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/permintaan_stock_chemical_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
