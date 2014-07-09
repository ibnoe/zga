<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#open_move_orderoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/open_move_orderview/index/' },
		}; 
		
		$('#open_move_orderform').click(function(){$('#open_move_orderform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Open Move Order</h3>

<p>
<div id="open_move_orderoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/open_move_orderadd/submit" id="open_move_orderform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_move_orderlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
