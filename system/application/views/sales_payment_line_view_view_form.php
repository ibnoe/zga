<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_payment_line_viewchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_payment_line_viewconfirmdelete(delid, obj)
	{
		$('#sales_payment_line_view-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_payment_line_viewconfirmdelete3(delid, obj));
	}

function sales_payment_line_viewconfirmdelete2(delid, obj)
	{
		$( "#sales_payment_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_payment_line_viewcalldeletefn('sales_payment_line_viewdelete', delid, 'sales_payment_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_payment_line_view-dialog-confirm').html('');
	}
	
	function sales_payment_line_viewconfirmdelete3(delid, obj)
	{
		$( "#sales_payment_line_view-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_payment_line_viewcalldeletefn3('sales_payment_line_viewdelete', delid, 'sales_payment_line_viewlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_payment_line_view-dialog-confirm').html('');
	}

function sales_payment_line_viewcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_payment_line_viewcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_payment_line_view-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Payment Line View</h3>

<?=form_hidden("sales_payment_line_view_id", $sales_payment_line_view_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Sales Invoice</td><td><?=isset($salesinvoice_opt[$salespaymentline__salesinvoice_id])?$salesinvoice_opt[$salespaymentline__salesinvoice_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salespaymentline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salespaymentline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salespaymentline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salespaymentline__createdby;?></td></tr>

</table>

<br>
<div id="sales_payment_line_viewbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_payment_line_viewedit/index/".$sales_payment_line_view_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_payment_line_viewconfirmdelete(<?=$sales_payment_line_view_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_payment_line_viewchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_payment_line_viewlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
