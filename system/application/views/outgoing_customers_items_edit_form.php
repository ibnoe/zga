<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#outgoing_customers_itemsoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#outgoing_customers_itemseditform').click(function(){$('#outgoing_customers_itemseditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Outgoing Customers Items</h3>

<p>
<div id="outgoing_customers_itemsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/outgoing_customers_itemsedit/submit" id="outgoing_customers_itemseditform" class="editform">

<?=form_hidden("outgoing_customers_items_id", $outgoing_customers_items_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/outgoing_customers_itemslist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


