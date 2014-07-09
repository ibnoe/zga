<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#rifchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function rifconfirmdelete(delid, obj)
	{
		$('#rif-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', rifconfirmdelete3(delid, obj));
	}

function rifconfirmdelete2(delid, obj)
	{
		$( "#rif-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					rifcalldeletefn('rifdelete', delid, 'riflist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rif-dialog-confirm').html('');
	}
	
	function rifconfirmdelete3(delid, obj)
	{
		$( "#rif-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					rifcalldeletefn3('rifdelete', delid, 'riflist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rif-dialog-confirm').html('');
	}

function rifcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function rifcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="rif-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View RIF</h3>

<?=form_hidden("rif_id", $rif_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>No RIF</td><td><?=$rcn__norif;?></td></tr><tr class='basic'>
<td>Date of Incoming Roll</td><td><?=$rcn__incomingrolldate;?></td></tr><tr class='basic'>
<td>Time of Incoming Roll</td><td><?=$rcn__incomingrolltime;?></td></tr><tr class='basic'>
<td>Date of Identification</td><td><?=$rcn__identificationdate;?></td></tr><tr class='basic'>
<td>Time of Identification</td><td><?=$rcn__identificationtime;?></td></tr><tr class='basic'>
<td>Press</td><td><?=$rcn__press;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$rcn__customer_id])?$customer_opt[$rcn__customer_id]:'';?></td></tr><tr class='basic'>
<td>No Diss</td><td><?=$rcn__nodiss;?></td></tr><tr class='basic'>
<td>Date RCN</td><td><?=$rcn__datercn;?></td></tr><tr class='basic'>
<td>Total Rollers Collected</td><td><?=number_format($rcn__totalrollerscollected, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$rcn__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$rcn__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$rcn__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$rcn__createdby;?></td></tr>

</table>

<br>
<div id="rifbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/rifedit/index/".$rif_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="rifconfirmdelete(<?=$rif_id;?>, this);"></td>
<td class="print"><input class="button" type="button" value="Print" onclick="location.href='<?=site_url()."/printing/index/rif/".$rif_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="rifchildtabs">
	
	<ul><li><a href='<?=site_url()."/rif_linelist/index/".$rif_id;?>'>RIF Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/riflist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
