<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#spp_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function spp_lineconfirmdelete(delid, obj)
	{
		$('#spp_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', spp_lineconfirmdelete3(delid, obj));
	}

function spp_lineconfirmdelete2(delid, obj)
	{
		$( "#spp_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					spp_linecalldeletefn('spp_linedelete', delid, 'spp_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#spp_line-dialog-confirm').html('');
	}
	
	function spp_lineconfirmdelete3(delid, obj)
	{
		$( "#spp_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					spp_linecalldeletefn3('spp_linedelete', delid, 'spp_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#spp_line-dialog-confirm').html('');
	}

function spp_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function spp_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="spp_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View SPP Line</h3>

<?=form_hidden("spp_line_id", $spp_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item</td><td><?=isset($item_opt[$suratpermintaanpembelianline__item_id])?$item_opt[$suratpermintaanpembelianline__item_id]:'';?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($suratpermintaanpembelianline__quantity, 2);?></td></tr><tr class='basic'>
<td>Unit</td><td><?=isset($uom_opt[$suratpermintaanpembelianline__uom_id])?$uom_opt[$suratpermintaanpembelianline__uom_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$suratpermintaanpembelianline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$suratpermintaanpembelianline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$suratpermintaanpembelianline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$suratpermintaanpembelianline__createdby;?></td></tr>

</table>

<br>
<div id="spp_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/spp_lineedit/index/".$spp_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="spp_lineconfirmdelete(<?=$spp_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="spp_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/spp_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
