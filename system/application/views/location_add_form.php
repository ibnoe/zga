<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#locationoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#locationform').click(function(){$('#locationform').ajaxForm(options);});
	
  });
  </script>

<h3>New location</h3>

<p>
<div id="locationoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/locationadd/submit" id="locationform">

<table width="100%">

<tr class='basic'><td>Name *</td><td><?=form_input(array('name' => 'contact__firstname', 'value' => $contact__firstname, 'class' => 'basic', 'id' => 'contact__firstname'));?></td></tr>
<tr class='basic'><td>Address</td><td><?=form_input(array('name' => 'contact__address', 'value' => $contact__address, 'class' => 'basic', 'id' => 'contact__address'));?></td></tr>
<tr class='basic'><td>Phone</td><td><?=form_input(array('name' => 'contact__phone', 'value' => $contact__phone, 'class' => 'basic', 'id' => 'contact__phone'));?></td></tr>
<tr class='basic'><td>Fax</td><td><?=form_input(array('name' => 'contact__fax', 'value' => $contact__fax, 'class' => 'basic', 'id' => 'contact__fax'));?></td></tr>
<tr class='basic'><td>Email</td><td><?=form_input(array('name' => 'contact__email', 'value' => $contact__email, 'class' => 'basic', 'id' => 'contact__email'));?></td></tr>
<tr class='basic'><td>Is Customer?</td><td><?=form_input(array('name' => 'contact__iscustomer', 'value' => $contact__iscustomer, 'class' => 'basic', 'id' => 'contact__iscustomer'));?></td></tr>
<tr class='basic'><td>Is Supplier?</td><td><?=form_input(array('name' => 'contact__issupplier', 'value' => $contact__issupplier, 'class' => 'basic', 'id' => 'contact__issupplier'));?></td></tr>
<tr class='basic'><td>Is Warehouse?</td><td><?=form_input(array('name' => 'contact__iswarehouse', 'value' => $contact__iswarehouse, 'class' => 'basic', 'id' => 'contact__iswarehouse'));?></td></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/locationlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

<?php include 'footer.php'; ?>
