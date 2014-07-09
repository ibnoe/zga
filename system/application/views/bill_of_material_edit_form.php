<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#bill_of_materialoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#bill_of_materialeditform').click(function(){$('#bill_of_materialeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Bill Of Material</h3>

<p>
<div id="bill_of_materialoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/bill_of_materialedit/submit" id="bill_of_materialeditform" class="editform">

<?=form_hidden("bill_of_material_id", $bill_of_material_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Bill Name *</td><td><?=form_input(array('name' => 'bom__name', 'value' => $bom__name, 'id' => 'bom__name'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bill_of_materiallist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


