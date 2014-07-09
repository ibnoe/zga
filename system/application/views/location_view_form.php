<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#locationchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View location</h3>

<?=form_hidden("location_id", $location_id);?>

<table width="100%">


</table>

<br>
<div id="locationbuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/locationedit/index/".$location_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="locationchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/locationlist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
