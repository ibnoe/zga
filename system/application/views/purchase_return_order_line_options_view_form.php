<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_return_order_line_optionschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_return_order_line_optionsconfirmdelete(delid, obj)
	{
		$('#purchase_return_order_line_options-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_return_order_line_optionsconfirmdelete3(delid, obj));
	}

function purchase_return_order_line_optionsconfirmdelete2(delid, obj)
	{
		$( "#purchase_return_order_line_options-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_return_order_line_optionscalldeletefn('purchase_return_order_line_optionsdelete', delid, 'purchase_return_order_line_optionslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_order_line_options-dialog-confirm').html('');
	}
	
	function purchase_return_order_line_optionsconfirmdelete3(delid, obj)
	{
		$( "#purchase_return_order_line_options-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_return_order_line_optionscalldeletefn3('purchase_return_order_line_optionsdelete', delid, 'purchase_return_order_line_optionslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return_order_line_options-dialog-confirm').html('');
	}

function purchase_return_order_line_optionscalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_return_order_line_optionscalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_return_order_line_options-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Return Order Line Options</h3>

<?=form_hidden("purchase_return_order_line_options_id", $purchase_return_order_line_options_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$purchasereturnorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchasereturnorderline__created;?></td></tr>

</table>

<br>
<div id="purchase_return_order_line_optionsbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_return_order_line_optionsedit/index/".$purchase_return_order_line_options_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_return_order_line_optionsconfirmdelete(<?=$purchase_return_order_line_options_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_return_order_line_optionschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_order_line_optionslist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
