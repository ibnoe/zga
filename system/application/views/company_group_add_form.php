<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#company_groupoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/company_groupview/index/' },
		}; 
		
		$('#company_groupform').click(function(){$('#company_groupform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Company Group</h3>

<p>
<div id="company_groupoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/company_groupadd/submit" id="company_groupform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'customergroup__idstring', 'value' => $customergroup__idstring, 'class' => 'basic', 'id' => 'customergroup__idstring'));?></td></tr>
<tr class='basic'>
<td>Group Name *</td>
<td><?=form_input(array('name' => 'customergroup__name', 'value' => $customergroup__name, 'class' => 'basic', 'id' => 'customergroup__name'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'customergroup__notes', 'value' => $customergroup__notes, 'class' => 'basic', 'id' => 'customergroup__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/company_grouplist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
