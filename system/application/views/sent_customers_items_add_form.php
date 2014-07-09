<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sent_customers_itemsoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sent_customers_itemsview/index/' },
		}; 
		
		$('#sent_customers_itemsform').click(function(){$('#sent_customers_itemsform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sent Customers Items</h3>

<p>
<div id="sent_customers_itemsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sent_customers_itemsadd/submit" id="sent_customers_itemsform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sent_customers_itemslist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
