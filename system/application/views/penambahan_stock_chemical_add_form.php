<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#penambahan_stock_chemicaloutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/penambahan_stock_chemicalview/index/' },
		}; 
		
		$('#penambahan_stock_chemicalform').click(function(){$('#penambahan_stock_chemicalform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Penambahan Stock Chemical</h3>

<p>
<div id="penambahan_stock_chemicaloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/penambahan_stock_chemicaladd/submit" id="penambahan_stock_chemicalform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'penambahanstockchemical__idstring', 'value' => $penambahanstockchemical__idstring, 'class' => 'basic', 'id' => 'penambahanstockchemical__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".penambahanstockchemical__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'penambahanstockchemical__date', 'value' => $penambahanstockchemical__date, 'class' => 'penambahanstockchemical__datebasic'));?></td></tr>
<tr class='basic'>
<td>Product Name *</td>
<td><?=form_input(array('name' => 'penambahanstockchemical__name', 'value' => $penambahanstockchemical__name, 'class' => 'basic', 'id' => 'penambahanstockchemical__name'));?></td></tr>
<tr class='basic'>
<td>Job Order No</td>
<td><?=form_input(array('name' => 'penambahanstockchemical__joborderno', 'value' => $penambahanstockchemical__joborderno, 'class' => 'basic', 'id' => 'penambahanstockchemical__joborderno'));?></td></tr>
<tr class='basic'>
<td>Batch No</td>
<td><?=form_input(array('name' => 'penambahanstockchemical__batchno', 'value' => $penambahanstockchemical__batchno, 'class' => 'basic', 'id' => 'penambahanstockchemical__batchno'));?></td></tr>
<tr class='basic'>
<td>Packing</td>
<td><?=form_input(array('name' => 'penambahanstockchemical__packing', 'value' => $penambahanstockchemical__packing, 'class' => 'basic', 'id' => 'penambahanstockchemical__packing'));?></td></tr>
<tr class='basic'>
<td>Quantity (Liter/Kg)</td>
<td><?=form_input(array('name' => 'penambahanstockchemical__qtyliterkg', 'value' => $penambahanstockchemical__qtyliterkg, 'class' => 'basic', 'id' => 'penambahanstockchemical__qtyliterkg'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'penambahanstockchemical__notes', 'value' => $penambahanstockchemical__notes, 'class' => 'basic', 'id' => 'penambahanstockchemical__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penambahan_stock_chemicallist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
