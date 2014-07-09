<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#forwarderchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function forwarderconfirmdelete(delid, obj)
	{
		$('#forwarder-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', forwarderconfirmdelete3(delid, obj));
	}

function forwarderconfirmdelete2(delid, obj)
	{
		$( "#forwarder-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					forwardercalldeletefn('forwarderdelete', delid, 'forwarderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#forwarder-dialog-confirm').html('');
	}
	
	function forwarderconfirmdelete3(delid, obj)
	{
		$( "#forwarder-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					forwardercalldeletefn3('forwarderdelete', delid, 'forwarderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#forwarder-dialog-confirm').html('');
	}

function forwardercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function forwardercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="forwarder-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Forwarder</h3>

<?=form_hidden("forwarder_id", $forwarder_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Name</td><td><?=$forwarder__name;?></td></tr><tr class='basic'>
<td>Address</td><td><?=$forwarder__address;?></td></tr><tr class='basic'>
<td>Rating</td><td><?=number_format($forwarder__rating, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$forwarder__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$forwarder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$forwarder__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$forwarder__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$forwarder__createdby;?></td></tr>

</table>

<br>
<div id="forwarderbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/forwarderedit/index/".$forwarder_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="forwarderconfirmdelete(<?=$forwarder_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="forwarderchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/forwarderlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
