<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#contact_personoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#contact_personeditform').click(function(){$('#contact_personeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Contact Person</h3>

<p>
<div id="contact_personoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/contact_personedit/submit" id="contact_personeditform" class="editform">

<?=form_hidden("contact_person_id", $contact_person_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'contactperson__idstring', 'value' => $contactperson__idstring, 'id' => 'contactperson__idstring'));?></td></tr><tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'contactperson__name', 'value' => $contactperson__name, 'id' => 'contactperson__name'));?></td></tr><tr class='basic'>
<td>Position</td><td><?=form_input(array('name' => 'contactperson__position', 'value' => $contactperson__position, 'id' => 'contactperson__position'));?></td></tr><tr class='basic'>
<td>Address</td><td><?=form_input(array('name' => 'contactperson__address', 'value' => $contactperson__address, 'id' => 'contactperson__address'));?></td></tr><tr class='basic'>
<td>Phone</td><td><?=form_input(array('name' => 'contactperson__phone', 'value' => $contactperson__phone, 'id' => 'contactperson__phone'));?></td></tr><tr class='basic'>
<td>Fax</td><td><?=form_input(array('name' => 'contactperson__fax', 'value' => $contactperson__fax, 'id' => 'contactperson__fax'));?></td></tr><tr class='basic'>
<td>Mobile</td><td><?=form_input(array('name' => 'contactperson__mobile', 'value' => $contactperson__mobile, 'id' => 'contactperson__mobile'));?></td></tr><tr class='basic'>
<td>Email</td><td><?=form_input(array('name' => 'contactperson__email', 'value' => $contactperson__email, 'id' => 'contactperson__email'));?></td></tr><tr class='basic'>
<td>Bank</td><td><?=form_input(array('name' => 'contactperson__bank', 'value' => $contactperson__bank, 'id' => 'contactperson__bank'));?></td></tr><tr class='basic'>
<td>Bank Acc No</td><td><?=form_input(array('name' => 'contactperson__bankaccno', 'value' => $contactperson__bankaccno, 'id' => 'contactperson__bankaccno'));?></td></tr><tr class='basic'>
<td>Bank Branch</td><td><?=form_input(array('name' => 'contactperson__bankbranch', 'value' => $contactperson__bankbranch, 'id' => 'contactperson__bankbranch'));?></td></tr><tr class='basic'>
<td>Martial Status</td><td><?=form_input(array('name' => 'contactperson__status', 'value' => $contactperson__status, 'id' => 'contactperson__status'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#contactperson__dob").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date Of Birth *</td><td><?=form_input(array('name' => 'contactperson__dob', 'value' => $contactperson__dob, 'class' => 'date', 'id' => 'contactperson__dob'));?></td></tr><tr class='basic'>
<td>Children</td><td><?=form_input(array('name' => 'contactperson__children', 'value' => $contactperson__children, 'id' => 'contactperson__children'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/contact_personlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


