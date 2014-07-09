<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#purchase_returnchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View purchase_return</h3>

<?=form_hidden("purchase_return_id", $purchase_return_id);?>

<table width="100%">


</table>

<br>
<div id="purchase_returnbuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_returnedit/index/".$purchase_return_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="purchase_returnchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_returnlist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
