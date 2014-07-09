<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#sppchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sppconfirmdelete(delid, obj)
	{
		$('#spp-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sppconfirmdelete3(delid, obj));
	}

function sppconfirmdelete2(delid, obj)
	{
		$( "#spp-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sppcalldeletefn('sppdelete', delid, 'spplist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#spp-dialog-confirm').html('');
	}
	
	function sppconfirmdelete3(delid, obj)
	{
		$( "#spp-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sppcalldeletefn3('sppdelete', delid, 'spplist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#spp-dialog-confirm').html('');
	}

function sppcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sppcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="spp-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View SPP</h3>

<?=form_hidden("spp_id", $spp_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>No SPP</td><td><?=$suratpermintaanpembelian__orderid;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$suratpermintaanpembelian__date;?></td></tr><tr class='basic'>
<td>Requester</td><td><?=$suratpermintaanpembelian__requester;?></td></tr><tr class='basic'>
<td>Divisi</td><td><?=$suratpermintaanpembelian__divisi;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.lokal').attr('disabled', 'disabled');$('.lokal').hide();$('.import').attr('disabled', 'disabled');$('.import').hide();var s = $("#suratpermintaanpembelian__buysource option:selected").text();if (s == 'Lokal') {$('.lokal').attr('disabled', '');$('.lokal').show();}if (s == 'Import') {$('.import').attr('disabled', '');$('.import').show();}});</script>
<td>Buy Source</td><td><?=$suratpermintaanpembelian__buysource;?></td></tr><tr class='basic'>
<td>Description</td><td><?=$suratpermintaanpembelian__notes;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.cancelled').attr('disabled', 'disabled');$('.cancelled').hide();var s = $("#suratpermintaanpembelian__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Cancelled') {$('.cancelled').attr('disabled', '');$('.cancelled').show();}});</script>
<td>Status</td><td><?=$suratpermintaanpembelian__status;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$suratpermintaanpembelian__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$suratpermintaanpembelian__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$suratpermintaanpembelian__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$suratpermintaanpembelian__createdby;?></td></tr>

</table>

<br>
<div id="sppbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sppedit/index/".$spp_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sppconfirmdelete(<?=$spp_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sppchildtabs">
	
	<ul><li><a href='<?=site_url()."/spp_linelist/index/".$spp_id;?>'>SPP Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/spplist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
