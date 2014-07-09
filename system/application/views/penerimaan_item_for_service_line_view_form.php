<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#penerimaan_item_for_service_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function penerimaan_item_for_service_lineconfirmdelete(delid, obj)
	{
		$('#penerimaan_item_for_service_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', penerimaan_item_for_service_lineconfirmdelete3(delid, obj));
	}

function penerimaan_item_for_service_lineconfirmdelete2(delid, obj)
	{
		$( "#penerimaan_item_for_service_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					penerimaan_item_for_service_linecalldeletefn('penerimaan_item_for_service_linedelete', delid, 'penerimaan_item_for_service_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penerimaan_item_for_service_line-dialog-confirm').html('');
	}
	
	function penerimaan_item_for_service_lineconfirmdelete3(delid, obj)
	{
		$( "#penerimaan_item_for_service_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					penerimaan_item_for_service_linecalldeletefn3('penerimaan_item_for_service_linedelete', delid, 'penerimaan_item_for_service_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penerimaan_item_for_service_line-dialog-confirm').html('');
	}

function penerimaan_item_for_service_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function penerimaan_item_for_service_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="penerimaan_item_for_service_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Penerimaan Item For Service Line</h3>

<?=form_hidden("penerimaan_item_for_service_line_id", $penerimaan_item_for_service_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Location</td><td><?=isset($warehouse_opt[$insertitemline__warehouse_id])?$warehouse_opt[$insertitemline__warehouse_id]:'';?></td></tr><tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$insertitemline__item_id])?$item_opt[$insertitemline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($insertitemline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$insertitemline__uom_id])?$uom_opt[$insertitemline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Value</td><td><?=number_format($insertitemline__price, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$insertitemline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$insertitemline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$insertitemline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$insertitemline__createdby;?></td></tr>

</table>

<br>
<div id="penerimaan_item_for_service_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/penerimaan_item_for_service_lineedit/index/".$penerimaan_item_for_service_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="penerimaan_item_for_service_lineconfirmdelete(<?=$penerimaan_item_for_service_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="penerimaan_item_for_service_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penerimaan_item_for_service_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
