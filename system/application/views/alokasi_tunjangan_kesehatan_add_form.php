<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#alokasi_tunjangan_kesehatanoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#alokasi_tunjangan_kesehatanform').click(function(){$('#alokasi_tunjangan_kesehatanform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Alokasi Tunjangan Kesehatan</h3>

<p>
<div id="alokasi_tunjangan_kesehatanoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/alokasi_tunjangan_kesehatanadd/submit" id="alokasi_tunjangan_kesehatanform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('karyawan_id', $karyawan_id);?>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".tunjangankesehatanallowance__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'tunjangankesehatanallowance__date', 'value' => $tunjangankesehatanallowance__date, 'class' => 'tunjangankesehatanallowance__datebasic'));?></td></tr>
<tr class='basic'>
<td>Description</td>
<td><?=form_input(array('name' => 'tunjangankesehatanallowance__description', 'value' => $tunjangankesehatanallowance__description, 'class' => 'basic', 'id' => 'tunjangankesehatanallowance__description'));?></td></tr>
<tr class='basic'>
<td>Amount</td>
<td><?=form_input(array('name' => 'tunjangankesehatanallowance__amount', 'value' => $tunjangankesehatanallowance__amount, 'class' => 'basic', 'id' => 'tunjangankesehatanallowance__amount'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'tunjangankesehatanallowance__notes', 'value' => $tunjangankesehatanallowance__notes, 'class' => 'basic', 'id' => 'tunjangankesehatanallowance__notes'));?></td></tr>
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
