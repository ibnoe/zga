<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#journaloutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/journalview/index/' },
		}; 
		
		$('#journalform').click(function(){$('#journalform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Journal</h3>

<p>
<div id="journaloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/journaladd/submit" id="journalform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/journallist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
