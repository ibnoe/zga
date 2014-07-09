<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#other_itemchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View other_item</h3>

<?=form_hidden("other_item_id", $other_item_id);?>

<table width="100%">


</table>

<br>
<div id="other_itembuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/other_itemedit/index/".$other_item_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="other_itemchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/other_itemlist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
