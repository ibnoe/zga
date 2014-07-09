<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#currencyoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/currencyview/index/' },
		}; 
		
		$('#currencyform').click(function(){$('#currencyform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Currency</h3>

<p>
<div id="currencyoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/currencyadd/submit" id="currencyform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'currency__idstring', 'value' => $currency__idstring, 'class' => 'basic', 'id' => 'currency__idstring'));?></td></tr>
<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'currency__name', 'value' => $currency__name, 'class' => 'basic', 'id' => 'currency__name'));?></td></tr>
<tr class='basic'>
<td>Rate</td>
<td><?=form_input(array('name' => 'currency__rate', 'value' => $currency__rate, 'class' => 'basic', 'id' => 'currency__rate'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/currencylist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
