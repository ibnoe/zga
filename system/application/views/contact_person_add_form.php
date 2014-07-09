<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#contact_personoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#contact_personform').click(function(){$('#contact_personform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Contact Person</h3>

<p>
<div id="contact_personoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/contact_personadd/submit" id="contact_personform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('customer_id', $customer_id);?>
<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'contactperson__idstring', 'value' => $contactperson__idstring, 'class' => 'basic', 'id' => 'contactperson__idstring'));?></td></tr>
<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'contactperson__name', 'value' => $contactperson__name, 'class' => 'basic', 'id' => 'contactperson__name'));?></td></tr>
<tr class='basic'>
<td>Position</td>
<td><?=form_input(array('name' => 'contactperson__position', 'value' => $contactperson__position, 'class' => 'basic', 'id' => 'contactperson__position'));?></td></tr>
<tr class='basic'>
<td>Address</td>
<td><?=form_input(array('name' => 'contactperson__address', 'value' => $contactperson__address, 'class' => 'basic', 'id' => 'contactperson__address'));?></td></tr>
<tr class='basic'>
<td>Phone</td>
<td><?=form_input(array('name' => 'contactperson__phone', 'value' => $contactperson__phone, 'class' => 'basic', 'id' => 'contactperson__phone'));?></td></tr>
<tr class='basic'>
<td>Fax</td>
<td><?=form_input(array('name' => 'contactperson__fax', 'value' => $contactperson__fax, 'class' => 'basic', 'id' => 'contactperson__fax'));?></td></tr>
<tr class='basic'>
<td>Mobile</td>
<td><?=form_input(array('name' => 'contactperson__mobile', 'value' => $contactperson__mobile, 'class' => 'basic', 'id' => 'contactperson__mobile'));?></td></tr>
<tr class='basic'>
<td>Email</td>
<td><?=form_input(array('name' => 'contactperson__email', 'value' => $contactperson__email, 'class' => 'basic', 'id' => 'contactperson__email'));?></td></tr>
<tr class='basic'>
<td>Bank</td>
<td><?=form_input(array('name' => 'contactperson__bank', 'value' => $contactperson__bank, 'class' => 'basic', 'id' => 'contactperson__bank'));?></td></tr>
<tr class='basic'>
<td>Bank Acc No</td>
<td><?=form_input(array('name' => 'contactperson__bankaccno', 'value' => $contactperson__bankaccno, 'class' => 'basic', 'id' => 'contactperson__bankaccno'));?></td></tr>
<tr class='basic'>
<td>Bank Branch</td>
<td><?=form_input(array('name' => 'contactperson__bankbranch', 'value' => $contactperson__bankbranch, 'class' => 'basic', 'id' => 'contactperson__bankbranch'));?></td></tr>
<tr class='basic'>
<td>Martial Status</td>
<td><?=form_input(array('name' => 'contactperson__status', 'value' => $contactperson__status, 'class' => 'basic', 'id' => 'contactperson__status'));?></td></tr>
<tr class='basic'>
<td>Date Of Birth *</td><script type="text/javascript">$(document).ready(function() {$(".contactperson__dobbasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'contactperson__dob', 'value' => $contactperson__dob, 'class' => 'contactperson__dobbasic'));?></td></tr>
<tr class='basic'>
<td>Children</td>
<td><?=form_input(array('name' => 'contactperson__children', 'value' => $contactperson__children, 'class' => 'basic', 'id' => 'contactperson__children'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=$_SERVER['HTTP_REFERER'];?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
