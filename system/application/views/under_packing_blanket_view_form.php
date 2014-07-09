<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#under_packing_blanketchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View under_packing_blanket</h3>

<?=form_hidden("under_packing_blanket_id", $under_packing_blanket_id);?>

<table width="100%">


</table>

<br>
<div id="under_packing_blanketbuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/under_packing_blanketedit/index/".$under_packing_blanket_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="under_packing_blanketchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/under_packing_blanketlist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
