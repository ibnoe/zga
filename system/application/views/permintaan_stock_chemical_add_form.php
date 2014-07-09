<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#permintaan_stock_chemicaloutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/permintaan_stock_chemicalview/index/' },
		}; 
		
		$('#permintaan_stock_chemicalform').click(function(){$('#permintaan_stock_chemicalform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Permintaan Stock Chemical</h3>

<p>
<div id="permintaan_stock_chemicaloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/permintaan_stock_chemicaladd/submit" id="permintaan_stock_chemicalform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'permintaanstockchemical__idstring', 'value' => $permintaanstockchemical__idstring, 'class' => 'basic', 'id' => 'permintaanstockchemical__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".permintaanstockchemical__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'permintaanstockchemical__date', 'value' => $permintaanstockchemical__date, 'class' => 'permintaanstockchemical__datebasic'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'permintaanstockchemical__notes', 'value' => $permintaanstockchemical__notes, 'class' => 'basic', 'id' => 'permintaanstockchemical__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/permintaan_stock_chemicallist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
