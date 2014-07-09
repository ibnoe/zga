<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#received_suppliers_itemsoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#received_suppliers_itemseditform').click(function(){$('#received_suppliers_itemseditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Received Suppliers Items</h3>

<p>
<div id="received_suppliers_itemsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/received_suppliers_itemsedit/submit" id="received_suppliers_itemseditform" class="editform">

<?=form_hidden("received_suppliers_items_id", $received_suppliers_items_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/received_suppliers_itemslist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


