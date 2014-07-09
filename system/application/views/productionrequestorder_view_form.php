<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#productionrequestorderchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function productionrequestorderconfirmdelete(delid, obj)
	{
		$('#productionrequestorder-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', productionrequestorderconfirmdelete3(delid, obj));
	}

function productionrequestorderconfirmdelete2(delid, obj)
	{
		$( "#productionrequestorder-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					productionrequestordercalldeletefn('productionrequestorderdelete', delid, 'productionrequestorderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#productionrequestorder-dialog-confirm').html('');
	}
	
	function productionrequestorderconfirmdelete3(delid, obj)
	{
		$( "#productionrequestorder-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					productionrequestordercalldeletefn3('productionrequestorderdelete', delid, 'productionrequestorderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#productionrequestorder-dialog-confirm').html('');
	}

function productionrequestordercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function productionrequestordercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="productionrequestorder-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View ProductionRequestOrder</h3>

<?=form_hidden("productionrequestorder_id", $productionrequestorder_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Order No</td><td><?=$productionrequestorder__idstring;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$productionrequestorder__customer_id])?$customer_opt[$productionrequestorder__customer_id]:'';?></td></tr><tr class='basic'>
<td>Order No</td><td><?=$productionrequestorder__idstring;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$productionrequestorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$productionrequestorder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$productionrequestorder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$productionrequestorder__createdby;?></td></tr>

</table>

<br>
<div id="productionrequestorderbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/productionrequestorderedit/index/".$productionrequestorder_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="productionrequestorderconfirmdelete(<?=$productionrequestorder_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="productionrequestorderchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/productionrequestorderlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
