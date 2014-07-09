<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#inking_unit_foilchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


	
</script>

<h3>View inking_unit_foil</h3>

<?=form_hidden("inking_unit_foil_id", $inking_unit_foil_id);?>

<table width="100%">


</table>

<br>
<div id="inking_unit_foilbuttons">
<table align="center">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/inking_unit_foiledit/index/".$inking_unit_foil_id;?>'"></td>
</tr>
</table>
</div>
<br>

<div id="inking_unit_foilchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/inking_unit_foillist";?>'"></input>
<?php endif; ?>
</p>

<?php include 'footer.php'; ?>
