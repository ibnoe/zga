<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#corechildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function coreconfirmdelete(delid, obj)
	{
		$('#core-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', coreconfirmdelete3(delid, obj));
	}

function coreconfirmdelete2(delid, obj)
	{
		$( "#core-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					corecalldeletefn('coredelete', delid, 'corelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#core-dialog-confirm').html('');
	}
	
	function coreconfirmdelete3(delid, obj)
	{
		$( "#core-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					corecalldeletefn3('coredelete', delid, 'corelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#core-dialog-confirm').html('');
	}

function corecalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function corecalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="core-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Core</h3>

<?=form_hidden("core_id", $core_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item ID</td><td><?=$item__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$item__name;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.used').attr('disabled', 'disabled');$('.used').hide();$('.new').attr('disabled', 'disabled');$('.new').hide();var s = $("#item__subcategory option:selected").text();if (s == 'Used') {$('.used').attr('disabled', '');$('.used').show();}if (s == 'New') {$('.new').attr('disabled', '');$('.new').show();}});</script>
<td>Category</td><td><?=$item__subcategory;?></td></tr><tr class='basic'>
<td>Core No</td><td><?=$item__coreno;?></td></tr><tr class='basic'>
<td>Press Type</td><td><?=$item__presstype;?></td></tr><tr class='basic'>
<td>Minimum Quantity</td><td><?=number_format($item__minquantity, 2);?></td></tr><tr class='basic'>
<td>Maximum Quantity</td><td><?=number_format($item__maxquantity, 2);?></td></tr><tr class='basic'>
<td>Buffer 3 Months</td><td><?=number_format($item__buffer3months, 2);?></td></tr><tr class='basic'>
<td>Is Purchasable?</td><td><?=$item__purchaseable;?></td></tr><tr class='basic'>
<td>Is Sellable?</td><td><?=$item__sellable;?></td></tr><tr class='basic'>
<td>Is Manufactured?</td><td><?=$item__manufactured;?></td></tr><tr class='basic'>
<td>Account Persediaan</td><td><?=isset($coa_opt[$item__persediaan_coa_id])?$coa_opt[$item__persediaan_coa_id]:'';?></td></tr><tr class='basic'>
<td>Account HPP</td><td><?=isset($coa_opt[$item__hpp_coa_id])?$coa_opt[$item__hpp_coa_id]:'';?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$item__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$item__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$item__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$item__createdby;?></td></tr>

</table>

<br>
<div id="corebuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/coreedit/index/".$core_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="coreconfirmdelete(<?=$core_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="corechildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/corelist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
