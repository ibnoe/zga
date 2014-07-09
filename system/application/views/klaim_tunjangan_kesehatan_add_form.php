<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#klaim_tunjangan_kesehatanoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#klaim_tunjangan_kesehatanform').click(function(){$('#klaim_tunjangan_kesehatanform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Klaim Tunjangan Kesehatan</h3>

<p>
<div id="klaim_tunjangan_kesehatanoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/klaim_tunjangan_kesehatanadd/submit" id="klaim_tunjangan_kesehatanform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('karyawan_id', $karyawan_id);?>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".tunjangankesehatanusage__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'tunjangankesehatanusage__date', 'value' => $tunjangankesehatanusage__date, 'class' => 'tunjangankesehatanusage__datebasic'));?></td></tr>
<tr class='basic'>
<td>Receipt From</td>
<td><?=form_input(array('name' => 'tunjangankesehatanusage__description', 'value' => $tunjangankesehatanusage__description, 'class' => 'basic', 'id' => 'tunjangankesehatanusage__description'));?></td></tr>
<tr class='basic'>
<td>Total Receipt</td>
<td><?=form_input(array('name' => 'tunjangankesehatanusage__amount', 'value' => $tunjangankesehatanusage__amount, 'class' => 'basic', 'id' => 'tunjangankesehatanusage__amount'));?></td></tr>
<tr class='basic'>
<td>Company Paid</td>
<td><?=form_input(array('name' => 'tunjangankesehatanusage__amountpaid', 'value' => $tunjangankesehatanusage__amountpaid, 'class' => 'basic', 'id' => 'tunjangankesehatanusage__amountpaid'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'tunjangankesehatanusage__notes', 'value' => $tunjangankesehatanusage__notes, 'class' => 'basic', 'id' => 'tunjangankesehatanusage__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=$_SERVER['HTTP_REFERER'];?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
