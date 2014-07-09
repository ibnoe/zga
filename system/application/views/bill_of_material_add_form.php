<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#bill_of_materialoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/bill_of_materialview/index/' },
		}; 
		
		$('#bill_of_materialform').click(function(){$('#bill_of_materialform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Bill Of Material</h3>

<p>
<div id="bill_of_materialoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/bill_of_materialadd/submit" id="bill_of_materialform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Bill Name *</td>
<td><?=form_input(array('name' => 'bom__name', 'value' => $bom__name, 'class' => 'basic', 'id' => 'bom__name'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bill_of_materiallist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
