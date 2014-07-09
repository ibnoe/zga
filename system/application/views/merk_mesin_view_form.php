<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#merk_mesinchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function merk_mesinconfirmdelete(delid, obj)
	{
		$('#merk_mesin-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', merk_mesinconfirmdelete3(delid, obj));
	}

function merk_mesinconfirmdelete2(delid, obj)
	{
		$( "#merk_mesin-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					merk_mesincalldeletefn('merk_mesindelete', delid, 'merk_mesinlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#merk_mesin-dialog-confirm').html('');
	}
	
	function merk_mesinconfirmdelete3(delid, obj)
	{
		$( "#merk_mesin-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					merk_mesincalldeletefn3('merk_mesindelete', delid, 'merk_mesinlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#merk_mesin-dialog-confirm').html('');
	}

function merk_mesincalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function merk_mesincalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="merk_mesin-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Merk Mesin</h3>

<?=form_hidden("merk_mesin_id", $merk_mesin_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Kode Merk Mesin</td><td><?=$merkmesin__idstring;?></td></tr><tr class='basic'>
<td>Merk Mesin</td><td><?=$merkmesin__name;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$merkmesin__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$merkmesin__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$merkmesin__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$merkmesin__createdby;?></td></tr>

</table>

<br>
<div id="merk_mesinbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/merk_mesinedit/index/".$merk_mesin_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="merk_mesinconfirmdelete(<?=$merk_mesin_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="merk_mesinchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/merk_mesinlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
