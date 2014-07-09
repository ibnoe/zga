<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_returnchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View sales_return</h3>

<?=form_hidden("sales_return_id", $sales_return_id);?>

<table width="100%">


</table>

<br>
<div id="sales_returnbuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_returnedit/index/".$sales_return_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="sales_returnchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_returnlist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
