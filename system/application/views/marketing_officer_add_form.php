<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#marketing_officeroutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/marketing_officerview/index/' },
		}; 
		
		$('#marketing_officerform').click(function(){$('#marketing_officerform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Marketing Officer</h3>

<p>
<div id="marketing_officeroutput"></div>
</p>

<form method="post" action="<?=site_url();?>/marketing_officeradd/submit" id="marketing_officerform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'marketingofficer__idstring', 'value' => $marketingofficer__idstring, 'class' => 'basic', 'id' => 'marketingofficer__idstring'));?></td></tr>
<tr class='basic'>
<td>Officer Name *</td>
<td><?=form_input(array('name' => 'marketingofficer__name', 'value' => $marketingofficer__name, 'class' => 'basic', 'id' => 'marketingofficer__name'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'marketingofficer__notes', 'value' => $marketingofficer__notes, 'class' => 'basic', 'id' => 'marketingofficer__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/marketing_officerlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
