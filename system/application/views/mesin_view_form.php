<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#mesinchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function mesinconfirmdelete(delid, obj)
	{
		$('#mesin-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', mesinconfirmdelete3(delid, obj));
	}

function mesinconfirmdelete2(delid, obj)
	{
		$( "#mesin-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					mesincalldeletefn('mesindelete', delid, 'mesinlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#mesin-dialog-confirm').html('');
	}
	
	function mesinconfirmdelete3(delid, obj)
	{
		$( "#mesin-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					mesincalldeletefn3('mesindelete', delid, 'mesinlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#mesin-dialog-confirm').html('');
	}

function mesincalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function mesincalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="mesin-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Mesin</h3>

<?=form_hidden("mesin_id", $mesin_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Kode Mesin</td><td><?=$mesin__idstring;?></td></tr><tr class='basic'>
<td>Tipe Mesin</td><td><?=$mesin__typename;?></td></tr><tr class='basic'>
<td>Merk Mesin</td><td><?=isset($merkmesin_opt[$mesin__merkmesin_id])?$merkmesin_opt[$mesin__merkmesin_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$mesin__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$mesin__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$mesin__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$mesin__createdby;?></td></tr>

</table>

<br>
<div id="mesinbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/mesinedit/index/".$mesin_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="mesinconfirmdelete(<?=$mesin_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="mesinchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/mesinlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
