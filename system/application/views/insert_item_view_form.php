<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#insert_itemchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function insert_itemconfirmdelete(delid, obj)
	{
		$('#insert_item-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', insert_itemconfirmdelete3(delid, obj));
	}

function insert_itemconfirmdelete2(delid, obj)
	{
		$( "#insert_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					insert_itemcalldeletefn('insert_itemdelete', delid, 'insert_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#insert_item-dialog-confirm').html('');
	}
	
	function insert_itemconfirmdelete3(delid, obj)
	{
		$( "#insert_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					insert_itemcalldeletefn3('insert_itemdelete', delid, 'insert_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#insert_item-dialog-confirm').html('');
	}

function insert_itemcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function insert_itemcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="insert_item-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Insert Item</h3>

<?=form_hidden("insert_item_id", $insert_item_id);?>

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
<div id="insert_itembuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/insert_itemedit/index/".$insert_item_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="insert_itemconfirmdelete(<?=$insert_item_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="insert_itemchildtabs">
	
	<ul><li><a href='<?=site_url()."/insert_item_linelist/index/".$insert_item_id;?>'>Insert Item Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/insert_itemlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
