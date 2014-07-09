<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#penambahan_stock_chemicaloutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#penambahan_stock_chemicaleditform').click(function(){$('#penambahan_stock_chemicaleditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Penambahan Stock Chemical</h3>

<p>
<div id="penambahan_stock_chemicaloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/penambahan_stock_chemicaledit/submit" id="penambahan_stock_chemicaleditform" class="editform">

<?=form_hidden("penambahan_stock_chemical_id", $penambahan_stock_chemical_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'penambahanstockchemical__idstring', 'value' => $penambahanstockchemical__idstring, 'id' => 'penambahanstockchemical__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#penambahanstockchemical__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'penambahanstockchemical__date', 'value' => $penambahanstockchemical__date, 'class' => 'date', 'id' => 'penambahanstockchemical__date'));?></td></tr><tr class='basic'>
<td>Product Name *</td><td><?=form_input(array('name' => 'penambahanstockchemical__name', 'value' => $penambahanstockchemical__name, 'id' => 'penambahanstockchemical__name'));?></td></tr><tr class='basic'>
<td>Job Order No</td><td><?=form_input(array('name' => 'penambahanstockchemical__joborderno', 'value' => $penambahanstockchemical__joborderno, 'id' => 'penambahanstockchemical__joborderno'));?></td></tr><tr class='basic'>
<td>Batch No</td><td><?=form_input(array('name' => 'penambahanstockchemical__batchno', 'value' => $penambahanstockchemical__batchno, 'id' => 'penambahanstockchemical__batchno'));?></td></tr><tr class='basic'>
<td>Packing</td><td><?=form_input(array('name' => 'penambahanstockchemical__packing', 'value' => $penambahanstockchemical__packing, 'id' => 'penambahanstockchemical__packing'));?></td></tr><tr class='basic'>
<td>Quantity (Liter/Kg)</td><td><?=form_input(array('name' => 'penambahanstockchemical__qtyliterkg', 'value' => $penambahanstockchemical__qtyliterkg, 'id' => 'penambahanstockchemical__qtyliterkg'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'penambahanstockchemical__notes', 'value' => $penambahanstockchemical__notes, 'id' => 'penambahanstockchemical__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penambahan_stock_chemicallist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


