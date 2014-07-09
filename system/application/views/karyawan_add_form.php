<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#karyawanoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/karyawanview/index/' },
		}; 
		
		$('#karyawanform').click(function(){$('#karyawanform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Karyawan</h3>

<p>
<div id="karyawanoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/karyawanadd/submit" id="karyawanform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>NIK *</td>
<td><?=form_input(array('name' => 'karyawan__idstring', 'value' => $karyawan__idstring, 'class' => 'basic', 'id' => 'karyawan__idstring'));?></td></tr>
<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'karyawan__name', 'value' => $karyawan__name, 'class' => 'basic', 'id' => 'karyawan__name'));?></td></tr>
<tr class='basic'>
<td>Gender</td><script type="text/javascript">$(document).ready(function() {$('#karyawan__gender').change(function() { $('.male').attr('disabled', 'disabled');$('.male').hide();$('.female').attr('disabled', 'disabled');$('.female').hide();var s = $("#karyawan__gender option:selected").text();if (s == 'Male') {$('.male').attr('disabled', '');$('.male').show();}if (s == 'Female') {$('.female').attr('disabled', '');$('.female').show();}});$('.male').attr('disabled', 'disabled');$('.male').hide();$('.female').attr('disabled', 'disabled');$('.female').hide();var s = $("#karyawan__gender option:selected").text();if (s == 'Male') {$('.male').attr('disabled', '');$('.male').show();}if (s == 'Female') {$('.female').attr('disabled', '');$('.female').show();}});</script>
<td><?=form_dropdown('karyawan__gender', array('Male' => 'Male', 'Female' => 'Female', ), $karyawan__gender, 'id="karyawan__gender" class="basic"');?></td></tr>
<tr class='basic'>
<td>Address</td>
<td><?=form_textarea(array('name' => 'karyawan__address', 'value' => $karyawan__address, 'class' => 'basic', 'id' => 'karyawan__address'));?></td></tr>
<tr class='basic'>
<td>Phone 1</td>
<td><?=form_input(array('name' => 'karyawan__phone1', 'value' => $karyawan__phone1, 'class' => 'basic', 'id' => 'karyawan__phone1'));?></td></tr>
<tr class='basic'>
<td>Phone 2</td>
<td><?=form_input(array('name' => 'karyawan__phone2', 'value' => $karyawan__phone2, 'class' => 'basic', 'id' => 'karyawan__phone2'));?></td></tr>
<tr class='basic'>
<td>DOB *</td><script type="text/javascript">$(document).ready(function() {$(".karyawan__dobbasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'karyawan__dob', 'value' => $karyawan__dob, 'class' => 'karyawan__dobbasic'));?></td></tr>
<tr class='basic'>
<td>Pendidikan</td>
<td><?=form_input(array('name' => 'karyawan__education', 'value' => $karyawan__education, 'class' => 'basic', 'id' => 'karyawan__education'));?></td></tr>
<tr class='basic'>
<td>Agama</td>
<td><?=form_input(array('name' => 'karyawan__religion', 'value' => $karyawan__religion, 'class' => 'basic', 'id' => 'karyawan__religion'));?></td></tr>
<tr class='basic'>
<td>Join Date *</td><script type="text/javascript">$(document).ready(function() {$(".karyawan__joindatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'karyawan__joindate', 'value' => $karyawan__joindate, 'class' => 'karyawan__joindatebasic'));?></td></tr>
<tr class='basic'>
<td>Department</td>
<td><?=form_input(array('name' => 'karyawan__department', 'value' => $karyawan__department, 'class' => 'basic', 'id' => 'karyawan__department'));?></td></tr>
<tr class='basic'>
<td>Gol</td>
<td><?=form_input(array('name' => 'karyawan__gol', 'value' => $karyawan__gol, 'class' => 'basic', 'id' => 'karyawan__gol'));?></td></tr>
<tr class='basic'>
<td>End Probation Date *</td><script type="text/javascript">$(document).ready(function() {$(".karyawan__endprobationdatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'karyawan__endprobationdate', 'value' => $karyawan__endprobationdate, 'class' => 'karyawan__endprobationdatebasic'));?></td></tr>
<tr class='basic'>
<td>Rek BCA</td>
<td><?=form_input(array('name' => 'karyawan__rekbca', 'value' => $karyawan__rekbca, 'class' => 'basic', 'id' => 'karyawan__rekbca'));?></td></tr>
<tr class='basic'>
<td>Cab BCA</td>
<td><?=form_input(array('name' => 'karyawan__cabbca', 'value' => $karyawan__cabbca, 'class' => 'basic', 'id' => 'karyawan__cabbca'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'karyawan__notes', 'value' => $karyawan__notes, 'class' => 'basic', 'id' => 'karyawan__notes'));?></td></tr>
<tr class='basic'>
<td>Status</td><script type="text/javascript">$(document).ready(function() {$('#karyawan__status').change(function() { $('.probation').attr('disabled', 'disabled');$('.probation').hide();$('.tetap').attr('disabled', 'disabled');$('.tetap').hide();$('.non_karyawan').attr('disabled', 'disabled');$('.non_karyawan').hide();var s = $("#karyawan__status option:selected").text();if (s == 'Probation') {$('.probation').attr('disabled', '');$('.probation').show();}if (s == 'Tetap') {$('.tetap').attr('disabled', '');$('.tetap').show();}if (s == 'Non Karyawan') {$('.non_karyawan').attr('disabled', '');$('.non_karyawan').show();}});$('.probation').attr('disabled', 'disabled');$('.probation').hide();$('.tetap').attr('disabled', 'disabled');$('.tetap').hide();$('.non_karyawan').attr('disabled', 'disabled');$('.non_karyawan').hide();var s = $("#karyawan__status option:selected").text();if (s == 'Probation') {$('.probation').attr('disabled', '');$('.probation').show();}if (s == 'Tetap') {$('.tetap').attr('disabled', '');$('.tetap').show();}if (s == 'Non Karyawan') {$('.non_karyawan').attr('disabled', '');$('.non_karyawan').show();}});</script>
<td><?=form_dropdown('karyawan__status', array('Probation' => 'Probation', 'Tetap' => 'Tetap', 'Non Karyawan' => 'Non Karyawan', ), $karyawan__status, 'id="karyawan__status" class="basic"');?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/karyawanlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
