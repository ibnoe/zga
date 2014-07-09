<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#price_listchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function price_listconfirmdelete(delid, obj)
	{
		$('#price_list-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', price_listconfirmdelete3(delid, obj));
	}

function price_listconfirmdelete2(delid, obj)
	{
		$( "#price_list-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					price_listcalldeletefn('price_listdelete', delid, 'price_listlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#price_list-dialog-confirm').html('');
	}
	
	function price_listconfirmdelete3(delid, obj)
	{
		$( "#price_list-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					price_listcalldeletefn3('price_listdelete', delid, 'price_listlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#price_list-dialog-confirm').html('');
	}

function price_listcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function price_listcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="price_list-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Price List</h3>

<?=form_hidden("price_list_id", $price_list_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Pricelist ID</td><td><?=$pricelist__idstring;?></td></tr><tr class='basic'>
<td>Pricelist Name</td><td><?=$pricelist__name;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$pricelist__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$pricelist__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$pricelist__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$pricelist__createdby;?></td></tr>

</table>

<br>
<div id="price_listbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/price_listedit/index/".$price_list_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="price_listconfirmdelete(<?=$price_list_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="price_listchildtabs">
	
	<ul><li><a href='<?=site_url()."/price_list_linelist/index/".$price_list_id;?>'>Price List Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/price_listlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
