<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#open_sales_order_for_invoicingchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function open_sales_order_for_invoicingconfirmdelete(delid, obj)
	{
		$('#open_sales_order_for_invoicing-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_sales_order_for_invoicingconfirmdelete3(delid, obj));
	}

function open_sales_order_for_invoicingconfirmdelete2(delid, obj)
	{
		$( "#open_sales_order_for_invoicing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_sales_order_for_invoicingcalldeletefn('open_sales_order_for_invoicingdelete', delid, 'open_sales_order_for_invoicinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_sales_order_for_invoicing-dialog-confirm').html('');
	}
	
	function open_sales_order_for_invoicingconfirmdelete3(delid, obj)
	{
		$( "#open_sales_order_for_invoicing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					open_sales_order_for_invoicingcalldeletefn3('open_sales_order_for_invoicingdelete', delid, 'open_sales_order_for_invoicinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_sales_order_for_invoicing-dialog-confirm').html('');
	}

function open_sales_order_for_invoicingcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function open_sales_order_for_invoicingcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="open_sales_order_for_invoicing-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Open Sales Order For Invoicing</h3>

<?=form_hidden("open_sales_order_for_invoicing_id", $open_sales_order_for_invoicing_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$salesorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesorderline__createdby;?></td></tr>

</table>

<br>
<div id="open_sales_order_for_invoicingbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_sales_order_for_invoicingedit/index/".$open_sales_order_for_invoicing_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="open_sales_order_for_invoicingconfirmdelete(<?=$open_sales_order_for_invoicing_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="open_sales_order_for_invoicingchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_sales_order_for_invoicinglist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
