<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_return_for_invoicingchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_return_for_invoicingconfirmdelete(delid, obj)
	{
		$('#sales_return_for_invoicing-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_for_invoicingconfirmdelete3(delid, obj));
	}

function sales_return_for_invoicingconfirmdelete2(delid, obj)
	{
		$( "#sales_return_for_invoicing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_for_invoicingcalldeletefn('sales_return_for_invoicingdelete', delid, 'sales_return_for_invoicinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_for_invoicing-dialog-confirm').html('');
	}
	
	function sales_return_for_invoicingconfirmdelete3(delid, obj)
	{
		$( "#sales_return_for_invoicing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_return_for_invoicingcalldeletefn3('sales_return_for_invoicingdelete', delid, 'sales_return_for_invoicinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_for_invoicing-dialog-confirm').html('');
	}

function sales_return_for_invoicingcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_return_for_invoicingcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_return_for_invoicing-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Return For Invoicing</h3>

<?=form_hidden("sales_return_for_invoicing_id", $sales_return_for_invoicing_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$salesreturnorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesreturnorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesreturnorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesreturnorderline__createdby;?></td></tr>

</table>

<br>
<div id="sales_return_for_invoicingbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_for_invoicingedit/index/".$sales_return_for_invoicing_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_for_invoicingconfirmdelete(<?=$sales_return_for_invoicing_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_return_for_invoicingchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_for_invoicinglist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
