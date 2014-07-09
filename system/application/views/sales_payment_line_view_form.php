<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_payment_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_payment_lineconfirmdelete(delid, obj)
	{
		$('#sales_payment_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_payment_lineconfirmdelete3(delid, obj));
	}

function sales_payment_lineconfirmdelete2(delid, obj)
	{
		$( "#sales_payment_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_payment_linecalldeletefn('sales_payment_linedelete', delid, 'sales_payment_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_payment_line-dialog-confirm').html('');
	}
	
	function sales_payment_lineconfirmdelete3(delid, obj)
	{
		$( "#sales_payment_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_payment_linecalldeletefn3('sales_payment_linedelete', delid, 'sales_payment_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_payment_line-dialog-confirm').html('');
	}

function sales_payment_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_payment_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_payment_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Payment Line</h3>

<?=form_hidden("sales_payment_line_id", $sales_payment_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Sales Invoice</td><td><?=isset($salesinvoice_opt[$salespaymentline__salesinvoice_id])?$salesinvoice_opt[$salespaymentline__salesinvoice_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salespaymentline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salespaymentline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salespaymentline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salespaymentline__createdby;?></td></tr>

</table>

<br>
<div id="sales_payment_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_payment_lineedit/index/".$sales_payment_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_payment_lineconfirmdelete(<?=$sales_payment_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_payment_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_payment_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
