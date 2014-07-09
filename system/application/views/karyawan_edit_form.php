<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#karyawanoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#karyawaneditform').click(function(){$('#karyawaneditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Karyawan</h3>

<p>
<div id="karyawanoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/karyawanedit/submit" id="karyawaneditform" class="editform">

<?=form_hidden("karyawan_id", $karyawan_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>NIK *</td><td><?=form_input(array('name' => 'karyawan__idstring', 'value' => $karyawan__idstring, 'id' => 'karyawan__idstring'));?></td></tr><tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'karyawan__name', 'value' => $karyawan__name, 'id' => 'karyawan__name'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#karyawan__gender').change(function() { $('.male').attr('disabled', 'disabled');$('.male').hide();$('.female').attr('disabled', 'disabled');$('.female').hide();var s = $("#karyawan__gender option:selected").text();if (s == 'Male') {$('.male').attr('disabled', '');$('.male').show();}if (s == 'Female') {$('.female').attr('disabled', '');$('.female').show();}});$('.male').attr('disabled', 'disabled');$('.male').hide();$('.female').attr('disabled', 'disabled');$('.female').hide();var s = $("#karyawan__gender option:selected").text();if (s == 'Male') {$('.male').attr('disabled', '');$('.male').show();}if (s == 'Female') {$('.female').attr('disabled', '');$('.female').show();}});</script>
<td>Gender</td><td><?=form_dropdown('karyawan__gender', array('Male' => 'Male', 'Female' => 'Female', ), $karyawan__gender, 'id="karyawan__gender" class="basic"');?></td></tr><tr class='basic'>
<td>Address</td><td><?=form_textarea(array('name' => 'karyawan__address', 'value' => $karyawan__address, 'id' => 'karyawan__address'));?></td></tr><tr class='basic'>
<td>Phone 1</td><td><?=form_input(array('name' => 'karyawan__phone1', 'value' => $karyawan__phone1, 'id' => 'karyawan__phone1'));?></td></tr><tr class='basic'>
<td>Phone 2</td><td><?=form_input(array('name' => 'karyawan__phone2', 'value' => $karyawan__phone2, 'id' => 'karyawan__phone2'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#karyawan__dob").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>DOB *</td><td><?=form_input(array('name' => 'karyawan__dob', 'value' => $karyawan__dob, 'class' => 'date', 'id' => 'karyawan__dob'));?></td></tr><tr class='basic'>
<td>Pendidikan</td><td><?=form_input(array('name' => 'karyawan__education', 'value' => $karyawan__education, 'id' => 'karyawan__education'));?></td></tr><tr class='basic'>
<td>Agama</td><td><?=form_input(array('name' => 'karyawan__religion', 'value' => $karyawan__religion, 'id' => 'karyawan__religion'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#karyawan__joindate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Join Date *</td><td><?=form_input(array('name' => 'karyawan__joindate', 'value' => $karyawan__joindate, 'class' => 'date', 'id' => 'karyawan__joindate'));?></td></tr><tr class='basic'>
<td>Department</td><td><?=form_input(array('name' => 'karyawan__department', 'value' => $karyawan__department, 'id' => 'karyawan__department'));?></td></tr><tr class='basic'>
<td>Gol</td><td><?=form_input(array('name' => 'karyawan__gol', 'value' => $karyawan__gol, 'id' => 'karyawan__gol'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#karyawan__endprobationdate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>End Probation Date *</td><td><?=form_input(array('name' => 'karyawan__endprobationdate', 'value' => $karyawan__endprobationdate, 'class' => 'date', 'id' => 'karyawan__endprobationdate'));?></td></tr><tr class='basic'>
<td>Rek BCA</td><td><?=form_input(array('name' => 'karyawan__rekbca', 'value' => $karyawan__rekbca, 'id' => 'karyawan__rekbca'));?></td></tr><tr class='basic'>
<td>Cab BCA</td><td><?=form_input(array('name' => 'karyawan__cabbca', 'value' => $karyawan__cabbca, 'id' => 'karyawan__cabbca'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'karyawan__notes', 'value' => $karyawan__notes, 'id' => 'karyawan__notes'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#karyawan__status').change(function() { $('.probation').attr('disabled', 'disabled');$('.probation').hide();$('.tetap').attr('disabled', 'disabled');$('.tetap').hide();$('.non_karyawan').attr('disabled', 'disabled');$('.non_karyawan').hide();var s = $("#karyawan__status option:selected").text();if (s == 'Probation') {$('.probation').attr('disabled', '');$('.probation').show();}if (s == 'Tetap') {$('.tetap').attr('disabled', '');$('.tetap').show();}if (s == 'Non Karyawan') {$('.non_karyawan').attr('disabled', '');$('.non_karyawan').show();}});$('.probation').attr('disabled', 'disabled');$('.probation').hide();$('.tetap').attr('disabled', 'disabled');$('.tetap').hide();$('.non_karyawan').attr('disabled', 'disabled');$('.non_karyawan').hide();var s = $("#karyawan__status option:selected").text();if (s == 'Probation') {$('.probation').attr('disabled', '');$('.probation').show();}if (s == 'Tetap') {$('.tetap').attr('disabled', '');$('.tetap').show();}if (s == 'Non Karyawan') {$('.non_karyawan').attr('disabled', '');$('.non_karyawan').show();}});</script>
<td>Status</td><td><?=form_dropdown('karyawan__status', array('Probation' => 'Probation', 'Tetap' => 'Tetap', 'Non Karyawan' => 'Non Karyawan', ), $karyawan__status, 'id="karyawan__status" class="basic"');?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/karyawanlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


