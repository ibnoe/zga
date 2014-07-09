<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#stock_adjustment_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function stock_adjustment_lineconfirmdelete(delid, obj)
	{
		$('#stock_adjustment_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', stock_adjustment_lineconfirmdelete3(delid, obj));
	}

function stock_adjustment_lineconfirmdelete2(delid, obj)
	{
		$( "#stock_adjustment_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					stock_adjustment_linecalldeletefn('stock_adjustment_linedelete', delid, 'stock_adjustment_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_adjustment_line-dialog-confirm').html('');
	}
	
	function stock_adjustment_lineconfirmdelete3(delid, obj)
	{
		$( "#stock_adjustment_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					stock_adjustment_linecalldeletefn3('stock_adjustment_linedelete', delid, 'stock_adjustment_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_adjustment_line-dialog-confirm').html('');
	}

function stock_adjustment_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function stock_adjustment_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="stock_adjustment_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Stock Adjustment Line</h3>

<?=form_hidden("stock_adjustment_line_id", $stock_adjustment_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Account</td><td><?=isset($coa_opt[$stockadjustmentline__coa_id])?$coa_opt[$stockadjustmentline__coa_id]:'';?></td></tr><tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$stockadjustmentline__item_id])?$item_opt[$stockadjustmentline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($stockadjustmentline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$stockadjustmentline__uom_id])?$uom_opt[$stockadjustmentline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$stockadjustmentline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$stockadjustmentline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$stockadjustmentline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$stockadjustmentline__createdby;?></td></tr>

</table>

<br>
<div id="stock_adjustment_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/stock_adjustment_lineedit/index/".$stock_adjustment_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="stock_adjustment_lineconfirmdelete(<?=$stock_adjustment_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="stock_adjustment_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/stock_adjustment_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
