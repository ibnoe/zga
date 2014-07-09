<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#permintaan_stock_chemicaloutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#permintaan_stock_chemicaleditform').click(function(){$('#permintaan_stock_chemicaleditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Permintaan Stock Chemical</h3>

<p>
<div id="permintaan_stock_chemicaloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/permintaan_stock_chemicaledit/submit" id="permintaan_stock_chemicaleditform" class="editform">

<?=form_hidden("permintaan_stock_chemical_id", $permintaan_stock_chemical_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'permintaanstockchemical__idstring', 'value' => $permintaanstockchemical__idstring, 'id' => 'permintaanstockchemical__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#permintaanstockchemical__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'permintaanstockchemical__date', 'value' => $permintaanstockchemical__date, 'class' => 'date', 'id' => 'permintaanstockchemical__date'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'permintaanstockchemical__notes', 'value' => $permintaanstockchemical__notes, 'id' => 'permintaanstockchemical__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/permintaan_stock_chemicallist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


