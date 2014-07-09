<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#filter_vacuumchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View filter_vacuum</h3>

<?=form_hidden("filter_vacuum_id", $filter_vacuum_id);?>

<table width="100%">


</table>

<br>
<div id="filter_vacuumbuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/filter_vacuumedit/index/".$filter_vacuum_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="filter_vacuumchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/filter_vacuumlist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
