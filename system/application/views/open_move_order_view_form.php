<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#open_move_orderchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function open_move_orderconfirmdelete(delid, obj)
	{
		$('#open_move_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_move_orderconfirmdelete3(delid, obj));
	}

function open_move_orderconfirmdelete2(delid, obj)
	{
		$( "#open_move_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_move_ordercalldeletefn('open_move_orderdelete', delid, 'open_move_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_move_order-dialog-confirm').html('');
	}
	
	function open_move_orderconfirmdelete3(delid, obj)
	{
		$( "#open_move_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					open_move_ordercalldeletefn3('open_move_orderdelete', delid, 'open_move_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_move_order-dialog-confirm').html('');
	}

function open_move_ordercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function open_move_ordercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="open_move_order-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Open Move Order</h3>

<?=form_hidden("open_move_order_id", $open_move_order_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Last Update</td><td><?=$moveorderline__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$moveorderline__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$moveorderline__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$moveorderline__createdby;?></td></tr>

</table>

<br>
<div id="open_move_orderbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_move_orderedit/index/".$open_move_order_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="open_move_orderconfirmdelete(<?=$open_move_order_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="open_move_orderchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_move_orderlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
