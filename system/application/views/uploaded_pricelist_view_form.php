<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#uploaded_pricelistchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function uploaded_pricelistconfirmdelete(delid, obj)
	{
		$('#uploaded_pricelist-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', uploaded_pricelistconfirmdelete3(delid, obj));
	}

function uploaded_pricelistconfirmdelete2(delid, obj)
	{
		$( "#uploaded_pricelist-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					uploaded_pricelistcalldeletefn('uploaded_pricelistdelete', delid, 'uploaded_pricelistlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#uploaded_pricelist-dialog-confirm').html('');
	}
	
	function uploaded_pricelistconfirmdelete3(delid, obj)
	{
		$( "#uploaded_pricelist-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					uploaded_pricelistcalldeletefn3('uploaded_pricelistdelete', delid, 'uploaded_pricelistlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#uploaded_pricelist-dialog-confirm').html('');
	}

function uploaded_pricelistcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function uploaded_pricelistcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="uploaded_pricelist-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Uploaded Pricelist</h3>

<?=form_hidden("uploaded_pricelist_id", $uploaded_pricelist_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>File</td><td><a href='<?=base_url();?>upload/<?=$uploadedpricelist__name;?>'><?=$uploadedpricelist__name;?></a></td></tr><tr class='basic'>
<td>Notes</td><td><?=$uploadedpricelist__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$uploadedpricelist__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$uploadedpricelist__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$uploadedpricelist__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$uploadedpricelist__createdby;?></td></tr>

</table>

<br>
<div id="uploaded_pricelistbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/uploaded_pricelistedit/index/".$uploaded_pricelist_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="uploaded_pricelistconfirmdelete(<?=$uploaded_pricelist_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="uploaded_pricelistchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/uploaded_pricelistlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
