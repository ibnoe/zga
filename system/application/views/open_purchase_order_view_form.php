<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#open_purchase_orderchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View open_purchase_order</h3>

<?=form_hidden("open_purchase_order_id", $open_purchase_order_id);?>

<table width="100%">


</table>

<br>
<div id="open_purchase_orderbuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_purchase_orderedit/index/".$open_purchase_order_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="open_purchase_orderchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/open_purchase_orderlist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
