<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#locationoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#locationeditform').click(function(){$('#locationeditform').ajaxForm(options);});
	});
</script>

<h3>Edit location</h3>

<p>
<div id="locationoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/locationedit/submit" id="locationeditform">

<?=form_hidden("location_id", $location_id);?>

<table width="100%">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'contact__firstname', 'value' => $contact__firstname, 'id' => 'contact__firstname'));?></td></tr><tr class='basic'>
<td>Address</td><td><?=form_input(array('name' => 'contact__address', 'value' => $contact__address, 'id' => 'contact__address'));?></td></tr><tr class='basic'>
<td>Phone</td><td><?=form_input(array('name' => 'contact__phone', 'value' => $contact__phone, 'id' => 'contact__phone'));?></td></tr><tr class='basic'>
<td>Fax</td><td><?=form_input(array('name' => 'contact__fax', 'value' => $contact__fax, 'id' => 'contact__fax'));?></td></tr><tr class='basic'>
<td>Email</td><td><?=form_input(array('name' => 'contact__email', 'value' => $contact__email, 'id' => 'contact__email'));?></td></tr><tr class='basic'>
<td>Is Customer?</td><td><?=form_input(array('name' => 'contact__iscustomer', 'value' => $contact__iscustomer, 'id' => 'contact__iscustomer'));?></td></tr><tr class='basic'>
<td>Is Supplier?</td><td><?=form_input(array('name' => 'contact__issupplier', 'value' => $contact__issupplier, 'id' => 'contact__issupplier'));?></td></tr><tr class='basic'>
<td>Is Warehouse?</td><td><?=form_input(array('name' => 'contact__iswarehouse', 'value' => $contact__iswarehouse, 'id' => 'contact__iswarehouse'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/locationlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>


