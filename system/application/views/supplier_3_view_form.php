<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#supplier_3childtabs').tabs({ selected: 0});
<?php endif; ?>
});


function supplier_3confirmdelete(delid, obj)
	{
		$('#supplier_3-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', supplier_3confirmdelete3(delid, obj));
	}

function supplier_3confirmdelete2(delid, obj)
	{
		$( "#supplier_3-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					supplier_3calldeletefn('supplier_3delete', delid, 'supplier_3list');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#supplier_3-dialog-confirm').html('');
	}
	
	function supplier_3confirmdelete3(delid, obj)
	{
		$( "#supplier_3-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					supplier_3calldeletefn3('supplier_3delete', delid, 'supplier_3list');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#supplier_3-dialog-confirm').html('');
	}

function supplier_3calldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function supplier_3calldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="supplier_3-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Supplier 3</h3>

<?=form_hidden("supplier_3_id", $supplier_3_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Supplier ID</td><td><?=$supplier__idstring;?></td></tr><tr class='basic'>
<td>First Name</td><td><?=$supplier__firstname;?></td></tr><tr class='basic'>
<td>Last Name</td><td><?=$supplier__lastname;?></td></tr><tr class='basic'>
<td>Address</td><td><?=$supplier__address;?></td></tr><tr class='basic'>
<td>Phone</td><td><?=$supplier__phone;?></td></tr><tr class='basic'>
<td>Fax</td><td><?=$supplier__fax;?></td></tr><tr class='basic'>
<td>NPWP</td><td><?=$supplier__npwp;?></td></tr><tr class='basic'>
<td>Email</td><td><?=$supplier__email;?></td></tr><tr class='basic'>
<td>Firm Type</td><td><?=$supplier__firmtype;?></td></tr><tr class='basic'>
<td>Contact Person</td><td><?=$supplier__contactperson;?></td></tr><tr class='basic'>
<td>HP Contact Person</td><td><?=$supplier__hpcontactperson;?></td></tr><tr class='basic'>
<td>Barang</td><td><?=$supplier__barang;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#supplier__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});</script>
<td>Default Payment Term</td><td><?=$supplier__top;?></td></tr><tr class='basic'>
<td>Default Currency</td><td><?=isset($currency_opt[$supplier__currency_id])?$currency_opt[$supplier__currency_id]:'';?></td></tr><tr class='basic'>
<td>Company Rating</td><td><?=$supplier__rating;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$supplier__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$supplier__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$supplier__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$supplier__createdby;?></td></tr>

</table>

<br>
<div id="supplier_3buttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/supplier_3edit/index/".$supplier_3_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="supplier_3confirmdelete(<?=$supplier_3_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="supplier_3childtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/supplier_3list";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
