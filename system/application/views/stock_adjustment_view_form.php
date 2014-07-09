<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#stock_adjustmentchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function stock_adjustmentconfirmdelete(delid, obj)
	{
		$('#stock_adjustment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', stock_adjustmentconfirmdelete3(delid, obj));
	}

function stock_adjustmentconfirmdelete2(delid, obj)
	{
		$( "#stock_adjustment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					stock_adjustmentcalldeletefn('stock_adjustmentdelete', delid, 'stock_adjustmentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_adjustment-dialog-confirm').html('');
	}
	
	function stock_adjustmentconfirmdelete3(delid, obj)
	{
		$( "#stock_adjustment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					stock_adjustmentcalldeletefn3('stock_adjustmentdelete', delid, 'stock_adjustmentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#stock_adjustment-dialog-confirm').html('');
	}

function stock_adjustmentcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function stock_adjustmentcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="stock_adjustment-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Stock Adjustment</h3>

<?=form_hidden("stock_adjustment_id", $stock_adjustment_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$stockadjustment__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$stockadjustment__date;?></td></tr><tr class='basic'>
<td>Description</td><td><?=$stockadjustment__notes;?></td></tr><tr class='basic'>
<td>Location</td><td><?=isset($warehouse_opt[$stockadjustment__warehouse_id])?$warehouse_opt[$stockadjustment__warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$stockadjustment__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$stockadjustment__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$stockadjustment__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$stockadjustment__createdby;?></td></tr>

</table>

<br>
<div id="stock_adjustmentbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/stock_adjustmentedit/index/".$stock_adjustment_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="stock_adjustmentconfirmdelete(<?=$stock_adjustment_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="stock_adjustmentchildtabs">
	
	<ul><li><a href='<?=site_url()."/stock_adjustment_linelist/index/".$stock_adjustment_id;?>'>Stock Adjustment Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/stock_adjustmentlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
