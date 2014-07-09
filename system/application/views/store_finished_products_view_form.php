<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#store_finished_productschildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View store_finished_products</h3>

<?=form_hidden("store_finished_products_id", $store_finished_products_id);?>

<table width="100%">


</table>

<br>
<div id="store_finished_productsbuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/store_finished_productsedit/index/".$store_finished_products_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="store_finished_productschildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/store_finished_productslist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
