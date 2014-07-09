<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#rollchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function rollconfirmdelete(delid, obj)
	{
		$('#roll-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', rollconfirmdelete3(delid, obj));
	}

function rollconfirmdelete2(delid, obj)
	{
		$( "#roll-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					rollcalldeletefn('rolldelete', delid, 'rolllist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roll-dialog-confirm').html('');
	}
	
	function rollconfirmdelete3(delid, obj)
	{
		$( "#roll-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					rollcalldeletefn3('rolldelete', delid, 'rolllist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roll-dialog-confirm').html('');
	}

function rollcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function rollcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="roll-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Roll</h3>

<?=form_hidden("roll_id", $roll_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Item ID</td><td><?=$item__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$item__name;?></td></tr><tr class='basic'>
<td>Roll No</td><td><?=$item__rollno;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.standard').attr('disabled', 'disabled');$('.standard').hide();$('.mix').attr('disabled', 'disabled');$('.mix').hide();$('.uv').attr('disabled', 'disabled');$('.uv').hide();var s = $("#item__inktype option:selected").text();if (s == 'Standard') {$('.standard').attr('disabled', '');$('.standard').show();}if (s == 'Mix') {$('.mix').attr('disabled', '');$('.mix').show();}if (s == 'UV') {$('.uv').attr('disabled', '');$('.uv').show();}});</script>
<td>Ink Type</td><td><?=$item__inktype;?></td></tr><tr class='basic'>
<td>Press Type</td><td><?=$item__machinetype;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.used').attr('disabled', 'disabled');$('.used').hide();$('.new').attr('disabled', 'disabled');$('.new').hide();var s = $("#item__core option:selected").text();if (s == 'Used') {$('.used').attr('disabled', '');$('.used').show();}if (s == 'New') {$('.new').attr('disabled', '');$('.new').show();}});</script>
<td>Core</td><td><?=$item__core;?></td></tr><tr class='dimensions'>
<td>Rubber Diameter (RD)</td><td><?=number_format($item__rd, 2);?></td></tr><tr class='dimensions'>
<td>Core Diameter (CD)</td><td><?=number_format($item__cd, 2);?></td></tr><tr class='dimensions'>
<td>Rubber Length (RL)</td><td><?=number_format($item__rl, 2);?></td></tr><tr class='dimensions'>
<td>Working Length (WL)</td><td><?=number_format($item__wl, 2);?></td></tr><tr class='dimensions'>
<td>Total Length (TL)</td><td><?=number_format($item__tl, 2);?></td></tr><tr class='basic'>
<td>Compound</td><td><?=$item__compound;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.recovering').attr('disabled', 'disabled');$('.recovering').hide();$('.exchange').attr('disabled', 'disabled');$('.exchange').hide();$('.brandnew').attr('disabled', 'disabled');$('.brandnew').hide();var s = $("#item__processscheme option:selected").text();if (s == 'Recovering') {$('.recovering').attr('disabled', '');$('.recovering').show();}if (s == 'Exchange') {$('.exchange').attr('disabled', '');$('.exchange').show();}if (s == 'BrandNew') {$('.brandnew').attr('disabled', '');$('.brandnew').show();}});</script>
<td>Process Scheme</td><td><?=$item__processscheme;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.ink_form').attr('disabled', 'disabled');$('.ink_form').hide();$('.dampenig_form').attr('disabled', 'disabled');$('.dampenig_form').hide();var s = $("#item__rollertype option:selected").text();if (s == 'Ink Form') {$('.ink_form').attr('disabled', '');$('.ink_form').show();}if (s == 'Dampenig Form') {$('.dampenig_form').attr('disabled', '');$('.dampenig_form').show();}});</script>
<td>Roller Type</td><td><?=$item__rollertype;?></td></tr><tr class='basic'>
<td>Is Accessories</td><td><?=$item__isaccessories;?></td></tr><tr class='basic'>
<td>Minimum Quantity</td><td><?=number_format($item__minquantity, 2);?></td></tr><tr class='basic'>
<td>Maximum Quantity</td><td><?=number_format($item__maxquantity, 2);?></td></tr><tr class='brandnew'>
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
<div id="rollbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/rolledit/index/".$roll_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="rollconfirmdelete(<?=$roll_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="rollchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/rolllist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
