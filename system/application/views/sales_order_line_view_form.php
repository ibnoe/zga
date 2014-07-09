<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_order_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_order_lineconfirmdelete(delid, obj)
	{
		$('#sales_order_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_order_lineconfirmdelete3(delid, obj));
	}

function sales_order_lineconfirmdelete2(delid, obj)
	{
		$( "#sales_order_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_order_linecalldeletefn('sales_order_linedelete', delid, 'sales_order_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order_line-dialog-confirm').html('');
	}
	
	function sales_order_lineconfirmdelete3(delid, obj)
	{
		$( "#sales_order_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_order_linecalldeletefn3('sales_order_linedelete', delid, 'sales_order_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order_line-dialog-confirm').html('');
	}

function sales_order_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_order_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_order_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Order Line</h3>

<?=form_hidden("sales_order_line_id", $sales_order_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.item').attr('disabled', 'disabled');$('.item').hide();$('.service').attr('disabled', 'disabled');$('.service').hide();var s = $("#salesorderline__type option:selected").text();if (s == 'Item') {$('.item').attr('disabled', '');$('.item').show();}if (s == 'Service') {$('.service').attr('disabled', '');$('.service').show();}});</script>
<td>Type</td><td><?=$salesorderline__type;?></td></tr><tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$salesorderline__item_id])?$item_opt[$salesorderline__item_id]:'';?></td></tr><tr class='basic'>
<td>Ship From Location</td><td><?=isset($warehouse_opt[$salesorderline__warehouse_id])?$warehouse_opt[$salesorderline__warehouse_id]:'';?></td></tr><tr class='service'>
<td>RCN</td><td><?=isset($rcn_opt[$salesorderline__rcn_id])?$rcn_opt[$salesorderline__rcn_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($salesorderline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$salesorderline__uom_id])?$uom_opt[$salesorderline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Price</td><td><?=number_format($salesorderline__price, 2);?></td></tr><tr class='basic'>
<td>Disc %</td><td><?=number_format($salesorderline__pdisc, 2);?></td></tr><tr class='basic'>
<td>PPN?</td><td><?=$salesorderline__hasppn;?></td></tr><tr class='basic'>
<td>PPH %</td><td><?=number_format($salesorderline__pph, 2);?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=number_format($salesorderline__subtotal, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesorderline__createdby;?></td></tr>

</table>

<br>
<div id="sales_order_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_order_lineedit/index/".$sales_order_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_order_lineconfirmdelete(<?=$sales_order_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_order_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_order_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
