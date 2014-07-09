<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#permintaan_stock_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function permintaan_stock_lineconfirmdelete(delid, obj)
	{
		$('#permintaan_stock_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', permintaan_stock_lineconfirmdelete3(delid, obj));
	}

function permintaan_stock_lineconfirmdelete2(delid, obj)
	{
		$( "#permintaan_stock_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					permintaan_stock_linecalldeletefn('permintaan_stock_linedelete', delid, 'permintaan_stock_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock_line-dialog-confirm').html('');
	}
	
	function permintaan_stock_lineconfirmdelete3(delid, obj)
	{
		$( "#permintaan_stock_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					permintaan_stock_linecalldeletefn3('permintaan_stock_linedelete', delid, 'permintaan_stock_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock_line-dialog-confirm').html('');
	}

function permintaan_stock_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function permintaan_stock_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="permintaan_stock_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Permintaan Stock Line</h3>

<?=form_hidden("permintaan_stock_line_id", $permintaan_stock_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$permintaanstockline__item_id])?$item_opt[$permintaanstockline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($permintaanstockline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$permintaanstockline__uom_id])?$uom_opt[$permintaanstockline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$permintaanstockline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$permintaanstockline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$permintaanstockline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$permintaanstockline__createdby;?></td></tr>

</table>

<br>
<div id="permintaan_stock_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/permintaan_stock_lineedit/index/".$permintaan_stock_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="permintaan_stock_lineconfirmdelete(<?=$permintaan_stock_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="permintaan_stock_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/permintaan_stock_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
