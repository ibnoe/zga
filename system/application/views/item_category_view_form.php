<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#item_categorychildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function item_categoryconfirmdelete(delid, obj)
	{
		$('#item_category-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', item_categoryconfirmdelete3(delid, obj));
	}

function item_categoryconfirmdelete2(delid, obj)
	{
		$( "#item_category-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					item_categorycalldeletefn('item_categorydelete', delid, 'item_categorylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#item_category-dialog-confirm').html('');
	}
	
	function item_categoryconfirmdelete3(delid, obj)
	{
		$( "#item_category-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					item_categorycalldeletefn3('item_categorydelete', delid, 'item_categorylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#item_category-dialog-confirm').html('');
	}

function item_categorycalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function item_categorycalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="item_category-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Item Category</h3>

<?=form_hidden("item_category_id", $item_category_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Name</td><td><?=$itemcategory__name;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$itemcategory__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$itemcategory__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$itemcategory__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$itemcategory__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$itemcategory__createdby;?></td></tr>

</table>

<br>
<div id="item_categorybuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/item_categoryedit/index/".$item_category_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="item_categoryconfirmdelete(<?=$item_category_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="item_categorychildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/item_categorylist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
