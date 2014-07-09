<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#currencychildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function currencyconfirmdelete(delid, obj)
	{
		$('#currency-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', currencyconfirmdelete3(delid, obj));
	}

function currencyconfirmdelete2(delid, obj)
	{
		$( "#currency-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					currencycalldeletefn('currencydelete', delid, 'currencylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#currency-dialog-confirm').html('');
	}
	
	function currencyconfirmdelete3(delid, obj)
	{
		$( "#currency-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					currencycalldeletefn3('currencydelete', delid, 'currencylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#currency-dialog-confirm').html('');
	}

function currencycalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function currencycalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="currency-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Currency</h3>

<?=form_hidden("currency_id", $currency_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$currency__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$currency__name;?></td></tr><tr class='basic'>
<td>Rate</td><td><?=number_format($currency__rate, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$currency__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$currency__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$currency__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$currency__createdby;?></td></tr>

</table>

<br>
<div id="currencybuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/currencyedit/index/".$currency_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="currencyconfirmdelete(<?=$currency_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="currencychildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/currencylist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
