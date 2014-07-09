<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_order_quote_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_order_quote_lineconfirmdelete(delid, obj)
	{
		$('#sales_order_quote_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_order_quote_lineconfirmdelete3(delid, obj));
	}

function sales_order_quote_lineconfirmdelete2(delid, obj)
	{
		$( "#sales_order_quote_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_order_quote_linecalldeletefn('sales_order_quote_linedelete', delid, 'sales_order_quote_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order_quote_line-dialog-confirm').html('');
	}
	
	function sales_order_quote_lineconfirmdelete3(delid, obj)
	{
		$( "#sales_order_quote_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_order_quote_linecalldeletefn3('sales_order_quote_linedelete', delid, 'sales_order_quote_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order_quote_line-dialog-confirm').html('');
	}

function sales_order_quote_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_order_quote_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_order_quote_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Order Quote Line</h3>

<?=form_hidden("sales_order_quote_line_id", $sales_order_quote_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.item').attr('disabled', 'disabled');$('.item').hide();var s = $("#salesorderline__type option:selected").text();if (s == 'Item') {$('.item').attr('disabled', '');$('.item').show();}});</script>
<td>Type</td><td><?=$salesorderline__type;?></td></tr><tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$salesorderline__item_id])?$item_opt[$salesorderline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($salesorderline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$salesorderline__uom_id])?$uom_opt[$salesorderline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Price</td><td><?=number_format($salesorderline__price, 2);?></td></tr><tr class='basic'>
<td>Disc %</td><td><?=number_format($salesorderline__pdisc, 2);?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=number_format($salesorderline__subtotal, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesorderline__createdby;?></td></tr>

</table>

<br>
<div id="sales_order_quote_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_order_quote_lineedit/index/".$sales_order_quote_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_order_quote_lineconfirmdelete(<?=$sales_order_quote_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_order_quote_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_order_quote_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
