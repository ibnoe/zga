<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#supplierchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function supplierconfirmdelete(delid, obj)
	{
		$('#supplier-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', supplierconfirmdelete3(delid, obj));
	}

function supplierconfirmdelete2(delid, obj)
	{
		$( "#supplier-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					suppliercalldeletefn('supplierdelete', delid, 'supplierlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#supplier-dialog-confirm').html('');
	}
	
	function supplierconfirmdelete3(delid, obj)
	{
		$( "#supplier-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					suppliercalldeletefn3('supplierdelete', delid, 'supplierlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#supplier-dialog-confirm').html('');
	}

function suppliercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function suppliercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="supplier-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Supplier</h3>

<?=form_hidden("supplier_id", $supplier_id);?>

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
<div id="supplierbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/supplieredit/index/".$supplier_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="supplierconfirmdelete(<?=$supplier_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="supplierchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/supplierlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
