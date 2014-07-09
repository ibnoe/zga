<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#rcn_linechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function rcn_lineconfirmdelete(delid, obj)
	{
		$('#rcn_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', rcn_lineconfirmdelete3(delid, obj));
	}

function rcn_lineconfirmdelete2(delid, obj)
	{
		$( "#rcn_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					rcn_linecalldeletefn('rcn_linedelete', delid, 'rcn_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rcn_line-dialog-confirm').html('');
	}
	
	function rcn_lineconfirmdelete3(delid, obj)
	{
		$( "#rcn_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					rcn_linecalldeletefn3('rcn_linedelete', delid, 'rcn_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rcn_line-dialog-confirm').html('');
	}

function rcn_linecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function rcn_linecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="rcn_line-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View RCN Line</h3>

<?=form_hidden("rcn_line_id", $rcn_line_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>No Identification</td><td><?=$rcnline__noiden;?></td></tr><tr class='basic'>
<td>Quantity</td><td><?=number_format($rcnline__quantity, 2);?></td></tr><tr class='basic'>
<td>Pos</td><td><?=$rcnline__pos;?></td></tr><tr class='basic'>
<td>Rubber Diameter (RD)</td><td><?=number_format($rcnline__rd, 2);?></td></tr><tr class='basic'>
<td>Core Diameter (CD)</td><td><?=number_format($rcnline__cd, 2);?></td></tr><tr class='basic'>
<td>Rubber Length (RL)</td><td><?=number_format($rcnline__rl, 2);?></td></tr><tr class='basic'>
<td>Working Length (WL)</td><td><?=number_format($rcnline__wl, 2);?></td></tr><tr class='basic'>
<td>Total Length (TL)</td><td><?=number_format($rcnline__tl, 2);?></td></tr><tr class='basic'>
<td>Compound</td><td><?=isset($item_opt[$rcnline__compound_id])?$item_opt[$rcnline__compound_id]:'';?></td></tr><tr class='basic'>
<td>Acc Fitted</td><td><?=$rcnline__accfitted;?></td></tr><tr class='basic'>
<td>Press Type</td><td><?=isset($mesin_opt[$rcnline__mesin_id])?$mesin_opt[$rcnline__mesin_id]:'';?></td></tr><tr class='basic'>
<td>Roller Type</td><td><?=isset($item_opt[$rcnline__core_id])?$item_opt[$rcnline__core_id]:'';?></td></tr><tr class='basic'>
<td>Item No</td><td><?=$rcnline__itemno;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$rcnline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$rcnline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$rcnline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$rcnline__createdby;?></td></tr>

</table>

<br>
<div id="rcn_linebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/rcn_lineedit/index/".$rcn_line_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="rcn_lineconfirmdelete(<?=$rcn_line_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="rcn_linechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/rcn_linelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
