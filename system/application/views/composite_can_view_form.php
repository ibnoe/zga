<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#composite_canchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View composite_can</h3>

<?=form_hidden("composite_can_id", $composite_can_id);?>

<table width="100%">


</table>

<br>
<div id="composite_canbuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/composite_canedit/index/".$composite_can_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="composite_canchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/composite_canlist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
