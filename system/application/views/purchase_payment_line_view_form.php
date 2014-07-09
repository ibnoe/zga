<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_payment_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function purchase_payment_lineconfirmdelete(delid, obj)
	{
		$('#purchase_payment_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_payment_lineconfirmdelete3(delid, obj));
	}

function purchase_payment_lineconfirmdelete2(delid, obj)
	{
		$( "#purchase_payment_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_payment_linecalldeletefn('purchase_payment_linedelete', delid, 'purchase_payment_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_payment_line-dialog-confirm').html('');
	}
	
	function purchase_payment_lineconfirmdelete3(delid, obj)
	{
		$( "#purchase_payment_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					purchase_payment_linecalldeletefn3('purchase_payment_linedelete', delid, 'purchase_payment_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_payment_line-dialog-confirm').html('');
	}

function purchase_payment_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function purchase_payment_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="purchase_payment_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Purchase Payment Line</h3>

<?=form_hidden("purchase_payment_line_id", $purchase_payment_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Purchase Invoice</td><td><?=isset($purchaseinvoice_opt[$purchasepaymentline__purchaseinvoice_id])?$purchaseinvoice_opt[$purchasepaymentline__purchaseinvoice_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$purchasepaymentline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$purchasepaymentline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$purchasepaymentline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$purchasepaymentline__createdby;?></td></tr>

</table>

<br>
<div id="purchase_payment_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_payment_lineedit/index/".$purchase_payment_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_payment_lineconfirmdelete(<?=$purchase_payment_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="purchase_payment_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_payment_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
