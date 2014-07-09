<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (true): ?>
$('#customerchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function customerconfirmdelete(delid, obj)
	{
		$('#customer-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', customerconfirmdelete3(delid, obj));
	}

function customerconfirmdelete2(delid, obj)
	{
		$( "#customer-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					customercalldeletefn('customerdelete', delid, 'customerlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#customer-dialog-confirm').html('');
	}
	
	function customerconfirmdelete3(delid, obj)
	{
		$( "#customer-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					customercalldeletefn3('customerdelete', delid, 'customerlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#customer-dialog-confirm').html('');
	}

function customercalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function customercalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="customer-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Customer</h3>

<?=form_hidden("customer_id", $customer_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Customer ID</td><td><?=$customer__idstring;?></td></tr><tr class='basic'>
<td>First Name</td><td><?=$customer__firstname;?></td></tr><tr class='basic'>
<td>Last Name</td><td><?=$customer__lastname;?></td></tr><tr class='basic'>
<td>Address</td><td><?=$customer__address;?></td></tr><tr class='basic'>
<td>Default Delivery Recipient</td><td><?=$customer__deliveryrecipient;?></td></tr><tr class='basic'>
<td>Default Delivery Address</td><td><?=$customer__deliveryaddress;?></td></tr><tr class='basic'>
<td>Default VAT(%)</td><td><?=number_format($customer__tax_rate, 2);?></td></tr><tr class='basic'>
<td>Default Disc(%)</td><td><?=number_format($customer__discount, 2);?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#customer__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});</script>
<td>Default Payment Term</td><td><?=$customer__top;?></td></tr><tr class='basic'>
<td>Phone</td><td><?=$customer__phone;?></td></tr><tr class='basic'>
<td>Fax</td><td><?=$customer__fax;?></td></tr><tr class='basic'>
<td>NPWP</td><td><?=$customer__npwp;?></td></tr><tr class='basic'>
<td>Email</td><td><?=$customer__email;?></td></tr><tr class='basic'>
<td>Website</td><td><?=$customer__website;?></td></tr><tr class='basic'>
<td>Default Currency</td><td><?=isset($currency_opt[$customer__currency_id])?$currency_opt[$customer__currency_id]:'';?></td></tr><tr class='basic'>
<td>Company Group</td><td><?=isset($customergroup_opt[$customer__customergroup_id])?$customergroup_opt[$customer__customergroup_id]:'';?></td></tr><tr class='basic'>
<td>Marketing Officer</td><td><?=isset($marketingofficer_opt[$customer__marketingofficer_id])?$marketingofficer_opt[$customer__marketingofficer_id]:'';?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.agen').attr('disabled', 'disabled');$('.agen').hide();$('.cabang').attr('disabled', 'disabled');$('.cabang').hide();$('.dalam_kota').attr('disabled', 'disabled');$('.dalam_kota').hide();$('.luar_kota').attr('disabled', 'disabled');$('.luar_kota').hide();$('.luar_negeri').attr('disabled', 'disabled');$('.luar_negeri').hide();var s = $("#customer__status option:selected").text();if (s == 'Agen') {$('.agen').attr('disabled', '');$('.agen').show();}if (s == 'Cabang') {$('.cabang').attr('disabled', '');$('.cabang').show();}if (s == 'Dalam Kota') {$('.dalam_kota').attr('disabled', '');$('.dalam_kota').show();}if (s == 'Luar Kota') {$('.luar_kota').attr('disabled', '');$('.luar_kota').show();}if (s == 'Luar Negeri') {$('.luar_negeri').attr('disabled', '');$('.luar_negeri').show();}});</script>
<td>Status Customer</td><td><?=$customer__status;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.small').attr('disabled', 'disabled');$('.small').hide();$('.medium').attr('disabled', 'disabled');$('.medium').hide();$('.big').attr('disabled', 'disabled');$('.big').hide();var s = $("#customer__rating option:selected").text();if (s == 'Small') {$('.small').attr('disabled', '');$('.small').show();}if (s == 'Medium') {$('.medium').attr('disabled', '');$('.medium').show();}if (s == 'Big') {$('.big').attr('disabled', '');$('.big').show();}});</script>
<td>Company Rating</td><td><?=$customer__rating;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$customer__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$customer__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$customer__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$customer__createdby;?></td></tr>

</table>

<br>
<div id="customerbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/customeredit/index/".$customer_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="customerconfirmdelete(<?=$customer_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="customerchildtabs">
	
	<ul><li><a href='<?=site_url()."/contact_personlist/index/".$customer_id;?>'>Contact Person</a></li><li><a href='<?=site_url()."/customermesinlist/index/".$customer_id;?>'>CustomerMesin</a></li><li><a href='<?=site_url()."/price_listlist/index/".$customer_id;?>'>Price List</a></li></ul>

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/customerlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
