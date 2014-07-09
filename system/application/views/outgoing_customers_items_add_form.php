<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#outgoing_customers_itemsoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/outgoing_customers_itemsview/index/' },
		}; 
		
		$('#outgoing_customers_itemsform').click(function(){$('#outgoing_customers_itemsform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Outgoing Customers Items</h3>

<p>
<div id="outgoing_customers_itemsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/outgoing_customers_itemsadd/submit" id="outgoing_customers_itemsform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/outgoing_customers_itemslist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
