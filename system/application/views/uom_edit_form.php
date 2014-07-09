<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#uomoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#uomeditform').click(function(){$('#uomeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Uom</h3>

<p>
<div id="uomoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/uomedit/submit" id="uomeditform" class="editform">

<?=form_hidden("uom_id", $uom_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'uom__name', 'value' => $uom__name, 'id' => 'uom__name'));?></td></tr><tr class='basic'>
<td>Multiplier</td><td><?=form_input(array('name' => 'uom__multiplier', 'value' => $uom__multiplier, 'id' => 'uom__multiplier'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/uomlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


