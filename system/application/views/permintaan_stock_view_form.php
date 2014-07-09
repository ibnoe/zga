<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#permintaan_stockchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function permintaan_stockconfirmdelete(delid, obj)
	{
		$('#permintaan_stock-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', permintaan_stockconfirmdelete3(delid, obj));
	}

function permintaan_stockconfirmdelete2(delid, obj)
	{
		$( "#permintaan_stock-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					permintaan_stockcalldeletefn('permintaan_stockdelete', delid, 'permintaan_stocklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock-dialog-confirm').html('');
	}
	
	function permintaan_stockconfirmdelete3(delid, obj)
	{
		$( "#permintaan_stock-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					permintaan_stockcalldeletefn3('permintaan_stockdelete', delid, 'permintaan_stocklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock-dialog-confirm').html('');
	}

function permintaan_stockcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function permintaan_stockcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="permintaan_stock-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Permintaan Stock</h3>

<?=form_hidden("permintaan_stock_id", $permintaan_stock_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$permintaanstock__idstring;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$permintaanstock__date;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$permintaanstock__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$permintaanstock__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$permintaanstock__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$permintaanstock__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$permintaanstock__createdby;?></td></tr>

</table>

<br>
<div id="permintaan_stockbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/permintaan_stockedit/index/".$permintaan_stock_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="permintaan_stockconfirmdelete(<?=$permintaan_stock_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="permintaan_stockchildtabs">
	
	<ul><li><a href='<?=site_url()."/permintaan_stock_linelist/index/".$permintaan_stock_id;?>'>Permintaan Stock Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/permintaan_stocklist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
