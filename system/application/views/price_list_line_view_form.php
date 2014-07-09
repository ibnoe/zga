<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#price_list_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function price_list_lineconfirmdelete(delid, obj)
	{
		$('#price_list_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', price_list_lineconfirmdelete3(delid, obj));
	}

function price_list_lineconfirmdelete2(delid, obj)
	{
		$( "#price_list_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					price_list_linecalldeletefn('price_list_linedelete', delid, 'price_list_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#price_list_line-dialog-confirm').html('');
	}
	
	function price_list_lineconfirmdelete3(delid, obj)
	{
		$( "#price_list_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					price_list_linecalldeletefn3('price_list_linedelete', delid, 'price_list_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#price_list_line-dialog-confirm').html('');
	}

function price_list_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function price_list_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="price_list_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Price List Line</h3>

<?=form_hidden("price_list_line_id", $price_list_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$pricelistline__item_id])?$item_opt[$pricelistline__item_id]:'';?></td></tr><tr class='basic'>
<td>Discount</td><td><?=number_format($pricelistline__pdisc, 2);?></td></tr><tr class='basic'>
<td>Price</td><td><?=number_format($pricelistline__price, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$pricelistline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$pricelistline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$pricelistline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$pricelistline__createdby;?></td></tr>

</table>

<br>
<div id="price_list_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/price_list_lineedit/index/".$price_list_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="price_list_lineconfirmdelete(<?=$price_list_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="price_list_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/price_list_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
