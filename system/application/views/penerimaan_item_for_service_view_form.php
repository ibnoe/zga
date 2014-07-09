<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#penerimaan_item_for_servicechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function penerimaan_item_for_serviceconfirmdelete(delid, obj)
	{
		$('#penerimaan_item_for_service-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', penerimaan_item_for_serviceconfirmdelete3(delid, obj));
	}

function penerimaan_item_for_serviceconfirmdelete2(delid, obj)
	{
		$( "#penerimaan_item_for_service-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					penerimaan_item_for_servicecalldeletefn('penerimaan_item_for_servicedelete', delid, 'penerimaan_item_for_servicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penerimaan_item_for_service-dialog-confirm').html('');
	}
	
	function penerimaan_item_for_serviceconfirmdelete3(delid, obj)
	{
		$( "#penerimaan_item_for_service-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					penerimaan_item_for_servicecalldeletefn3('penerimaan_item_for_servicedelete', delid, 'penerimaan_item_for_servicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penerimaan_item_for_service-dialog-confirm').html('');
	}

function penerimaan_item_for_servicecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function penerimaan_item_for_servicecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="penerimaan_item_for_service-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Penerimaan Item For Service</h3>

<?=form_hidden("penerimaan_item_for_service_id", $penerimaan_item_for_service_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$insertitem__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$insertitem__date;?></td></tr><tr class='basic'>
<td>Description</td><td><?=$insertitem__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$insertitem__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$insertitem__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$insertitem__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$insertitem__createdby;?></td></tr>

</table>

<br>
<div id="penerimaan_item_for_servicebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/penerimaan_item_for_serviceedit/index/".$penerimaan_item_for_service_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="penerimaan_item_for_serviceconfirmdelete(<?=$penerimaan_item_for_service_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="penerimaan_item_for_servicechildtabs">
	
	<ul><li><a href='<?=site_url()."/penerimaan_item_for_service_linelist/index/".$penerimaan_item_for_service_id;?>'>Penerimaan Item For Service Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penerimaan_item_for_servicelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
