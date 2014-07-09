<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_return_order_line_optionschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_return_order_line_optionsconfirmdelete(delid, obj)
	{
		$('#sales_return_order_line_options-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_order_line_optionsconfirmdelete3(delid, obj));
	}

function sales_return_order_line_optionsconfirmdelete2(delid, obj)
	{
		$( "#sales_return_order_line_options-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_order_line_optionscalldeletefn('sales_return_order_line_optionsdelete', delid, 'sales_return_order_line_optionslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_order_line_options-dialog-confirm').html('');
	}
	
	function sales_return_order_line_optionsconfirmdelete3(delid, obj)
	{
		$( "#sales_return_order_line_options-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_return_order_line_optionscalldeletefn3('sales_return_order_line_optionsdelete', delid, 'sales_return_order_line_optionslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_order_line_options-dialog-confirm').html('');
	}

function sales_return_order_line_optionscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_return_order_line_optionscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_return_order_line_options-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Return Order Line Options</h3>

<?=form_hidden("sales_return_order_line_options_id", $sales_return_order_line_options_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$salesreturnorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesreturnorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$salesreturnorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$salesreturnorderline__createdby;?></td></tr>

</table>

<br>
<div id="sales_return_order_line_optionsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_order_line_optionsedit/index/".$sales_return_order_line_options_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_order_line_optionsconfirmdelete(<?=$sales_return_order_line_options_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_return_order_line_optionschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_order_line_optionslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
