<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#open_credit_note_inoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/open_credit_note_inview/index/' },
		}; 
		
		$('#open_credit_note_inform').click(function(){$('#open_credit_note_inform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Open Credit Note In</h3>

<p>
<div id="open_credit_note_inoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/open_credit_note_inadd/submit" id="open_credit_note_inform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_credit_note_inlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
