<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#customermesinchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function customermesinconfirmdelete(delid, obj)
	{
		$('#customermesin-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', customermesinconfirmdelete3(delid, obj));
	}

function customermesinconfirmdelete2(delid, obj)
	{
		$( "#customermesin-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					customermesincalldeletefn('customermesindelete', delid, 'customermesinlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#customermesin-dialog-confirm').html('');
	}
	
	function customermesinconfirmdelete3(delid, obj)
	{
		$( "#customermesin-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					customermesincalldeletefn3('customermesindelete', delid, 'customermesinlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#customermesin-dialog-confirm').html('');
	}

function customermesincalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function customermesincalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="customermesin-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View CustomerMesin</h3>

<?=form_hidden("customermesin_id", $customermesin_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Mesin ID</td><td><?=isset($mesin_opt[$customermesin__mesin_id])?$mesin_opt[$customermesin__mesin_id]:'';?></td></tr><tr class='basic'>
<td>No Mesin</td><td><?=$customermesin__nomesin;?></td></tr><tr class='basic'>
<td>No Seri Mesin</td><td><?=$customermesin__noserimesin;?></td></tr><tr class='basic'>
<td>Tahun</td><td><?=$customermesin__tahun;?></td></tr><tr class='basic'>
<td>Konfigurasi</td><td><?=$customermesin__konfigurasi;?></td></tr><tr class='basic'>
<td>Jumlah Blanket</td><td><?=$customermesin__jumlahblanket;?></td></tr><tr class='basic'>
<td>Jumlah Roll</td><td><?=$customermesin__jumlahroll;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$customermesin__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$customermesin__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$customermesin__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$customermesin__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$customermesin__createdby;?></td></tr>

</table>

<br>
<div id="customermesinbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/customermesinedit/index/".$customermesin_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="customermesinconfirmdelete(<?=$customermesin_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="customermesinchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/customermesinlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
