<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_order_for_invoicingoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_return_order_for_invoicingview/index/' },
		}; 
		
		$('#purchase_return_order_for_invoicingform').click(function(){$('#purchase_return_order_for_invoicingform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Order For Invoicing</h3>

<p>
<div id="purchase_return_order_for_invoicingoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_order_for_invoicingadd/submit" id="purchase_return_order_for_invoicingform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_order_for_invoicinglist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
