<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#karyawan_probationchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function karyawan_probationconfirmdelete(delid, obj)
	{
		$('#karyawan_probation-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', karyawan_probationconfirmdelete3(delid, obj));
	}

function karyawan_probationconfirmdelete2(delid, obj)
	{
		$( "#karyawan_probation-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					karyawan_probationcalldeletefn('karyawan_probationdelete', delid, 'karyawan_probationlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#karyawan_probation-dialog-confirm').html('');
	}
	
	function karyawan_probationconfirmdelete3(delid, obj)
	{
		$( "#karyawan_probation-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					karyawan_probationcalldeletefn3('karyawan_probationdelete', delid, 'karyawan_probationlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#karyawan_probation-dialog-confirm').html('');
	}

function karyawan_probationcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function karyawan_probationcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="karyawan_probation-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Karyawan Probation</h3>

<?=form_hidden("karyawan_probation_id", $karyawan_probation_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>NIK</td><td><?=$karyawan__idstring;?></td></tr><tr class='basic'>
<td>Name</td><td><?=$karyawan__name;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.male').attr('disabled', 'disabled');$('.male').hide();$('.female').attr('disabled', 'disabled');$('.female').hide();var s = $("#karyawan__gender option:selected").text();if (s == 'Male') {$('.male').attr('disabled', '');$('.male').show();}if (s == 'Female') {$('.female').attr('disabled', '');$('.female').show();}});</script>
<td>Gender</td><td><?=$karyawan__gender;?></td></tr><tr class='basic'>
<td>Address</td><td><?=$karyawan__address;?></td></tr><tr class='basic'>
<td>Phone 1</td><td><?=$karyawan__phone1;?></td></tr><tr class='basic'>
<td>Phone 2</td><td><?=$karyawan__phone2;?></td></tr><tr class='basic'>
<td>DOB</td><td><?=$karyawan__dob;?></td></tr><tr class='basic'>
<td>Pendidikan</td><td><?=$karyawan__education;?></td></tr><tr class='basic'>
<td>Agama</td><td><?=$karyawan__religion;?></td></tr><tr class='basic'>
<td>Join Date</td><td><?=$karyawan__joindate;?></td></tr><tr class='basic'>
<td>Department</td><td><?=$karyawan__department;?></td></tr><tr class='basic'>
<td>Gol</td><td><?=$karyawan__gol;?></td></tr><tr class='basic'>
<td>End Probation Date</td><td><?=$karyawan__endprobationdate;?></td></tr><tr class='basic'>
<td>Rek BCA</td><td><?=$karyawan__rekbca;?></td></tr><tr class='basic'>
<td>Cab BCA</td><td><?=$karyawan__cabbca;?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$karyawan__notes;?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('.probation').attr('disabled', 'disabled');$('.probation').hide();$('.tetap').attr('disabled', 'disabled');$('.tetap').hide();$('.non_karyawan').attr('disabled', 'disabled');$('.non_karyawan').hide();var s = $("#karyawan__status option:selected").text();if (s == 'Probation') {$('.probation').attr('disabled', '');$('.probation').show();}if (s == 'Tetap') {$('.tetap').attr('disabled', '');$('.tetap').show();}if (s == 'Non Karyawan') {$('.non_karyawan').attr('disabled', '');$('.non_karyawan').show();}});</script>
<td>Status</td><td><?=$karyawan__status;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$karyawan__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$karyawan__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$karyawan__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$karyawan__createdby;?></td></tr>

</table>

<br>
<div id="karyawan_probationbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/karyawan_probationedit/index/".$karyawan_probation_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="karyawan_probationconfirmdelete(<?=$karyawan_probation_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="karyawan_probationchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/karyawan_probationlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
