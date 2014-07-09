<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#rcnchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function rcnconfirmdelete(delid, obj)
	{
		$('#rcn-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', rcnconfirmdelete3(delid, obj));
	}

function rcnconfirmdelete2(delid, obj)
	{
		$( "#rcn-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					rcncalldeletefn('rcndelete', delid, 'rcnlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rcn-dialog-confirm').html('');
	}
	
	function rcnconfirmdelete3(delid, obj)
	{
		$( "#rcn-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					rcncalldeletefn3('rcndelete', delid, 'rcnlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rcn-dialog-confirm').html('');
	}

function rcncalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function rcncalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="rcn-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View RCN</h3>

<?=form_hidden("rcn_id", $rcn_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>No RIF</td><td><?=$rcn__norif;?></td></tr><tr class='basic'>
<td>No RCN</td><td><?=$rcn__norcn;?></td></tr><tr class='basic'>
<td>No PO</td><td><?=$rcn__customerponumber;?></td></tr><tr class='basic'>
<td>Date</td><td><?=$rcn__datercn;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$rcn__customer_id])?$customer_opt[$rcn__customer_id]:'';?></td></tr><tr class='basic'>
<td>Roller to Recover</td><td><?=$rcn__reqtorecover;?></td></tr><tr class='basic'>
<td>Exchange Core to Return</td><td><?=$rcn__reqcoretoreturn;?></td></tr><tr class='basic'>
<td>Roller Return Unused</td><td><?=$rcn__reqreturnunused;?></td></tr><tr class='basic'>
<td>Roller Returned Faulty</td><td><?=$rcn__reqreturnfaulty;?></td></tr><tr class='basic'>
<td>Others</td><td><?=$rcn__reqothers;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$rcn__notes;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.approved_by_marketing').attr('disabled', 'disabled');$('.approved_by_marketing').hide();$('.rejected_by_marketing').attr('disabled', 'disabled');$('.rejected_by_marketing').hide();$('.waiting_for_marketing_approval').attr('disabled', 'disabled');$('.waiting_for_marketing_approval').hide();$('.approved_by_customer').attr('disabled', 'disabled');$('.approved_by_customer').hide();$('.rejected_by_customer').attr('disabled', 'disabled');$('.rejected_by_customer').hide();$('.waiting_for_customer_approval').attr('disabled', 'disabled');$('.waiting_for_customer_approval').hide();var s = $("#rcn__status option:selected").text();if (s == 'Approved by Marketing') {$('.approved_by_marketing').attr('disabled', '');$('.approved_by_marketing').show();}if (s == 'Rejected by Marketing') {$('.rejected_by_marketing').attr('disabled', '');$('.rejected_by_marketing').show();}if (s == 'Waiting For Marketing Approval') {$('.waiting_for_marketing_approval').attr('disabled', '');$('.waiting_for_marketing_approval').show();}if (s == 'Approved by Customer') {$('.approved_by_customer').attr('disabled', '');$('.approved_by_customer').show();}if (s == 'Rejected by Customer') {$('.rejected_by_customer').attr('disabled', '');$('.rejected_by_customer').show();}if (s == 'Waiting For Customer Approval') {$('.waiting_for_customer_approval').attr('disabled', '');$('.waiting_for_customer_approval').show();}});</script>
<td>Status</td><td><?=$rcn__status;?></td></tr><tr class='basic'>
<td>Total Rollers Collected</td><td><?=number_format($rcn__totalrollerscollected, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$rcn__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$rcn__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$rcn__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$rcn__createdby;?></td></tr>

</table>

<br>
<div id="rcnbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/rcnedit/index/".$rcn_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="rcnconfirmdelete(<?=$rcn_id;?>, this);"></td>
<td class="print"><input class="button" type="button" value="Print" onclick="location.href='<?=site_url()."/printing/index/rcn/".$rcn_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="rcnchildtabs">
	
	<ul><li><a href='<?=site_url()."/rcn_linelist/index/".$rcn_id;?>'>RCN Line</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/rcnlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
