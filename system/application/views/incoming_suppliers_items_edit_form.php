<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#incoming_suppliers_itemsoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#incoming_suppliers_itemseditform').click(function(){$('#incoming_suppliers_itemseditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Incoming Suppliers Items</h3>

<p>
<div id="incoming_suppliers_itemsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/incoming_suppliers_itemsedit/submit" id="incoming_suppliers_itemseditform" class="editform">

<?=form_hidden("incoming_suppliers_items_id", $incoming_suppliers_items_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/incoming_suppliers_itemslist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


