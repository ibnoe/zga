<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#account_typeoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/account_typeview/index/' },
		}; 
		
		$('#account_typeform').click(function(){$('#account_typeform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Account Type</h3>

<p>
<div id="account_typeoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/account_typeadd/submit" id="account_typeform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Account Class</td>
<td><?=form_input(array('name' => 'coatype__classtype', 'value' => $coatype__classtype, 'class' => 'basic', 'id' => 'coatype__classtype'));?></td></tr>
<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'coatype__name', 'value' => $coatype__name, 'class' => 'basic', 'id' => 'coatype__name'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/account_typelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
