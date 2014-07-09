<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#alokasi_cutioutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#alokasi_cutiform').click(function(){$('#alokasi_cutiform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Alokasi Cuti</h3>

<p>
<div id="alokasi_cutioutput"></div>
</p>

<form method="post" action="<?=site_url();?>/alokasi_cutiadd/submit" id="alokasi_cutiform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('karyawan_id', $karyawan_id);?>
<tr class='basic'>
<td>Start Date *</td><script type="text/javascript">$(document).ready(function() {$(".cutiallowance__begindatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'cutiallowance__begindate', 'value' => $cutiallowance__begindate, 'class' => 'cutiallowance__begindatebasic'));?></td></tr>
<tr class='basic'>
<td>Total Cuti</td>
<td><?=form_input(array('name' => 'cutiallowance__totalcuti', 'value' => $cutiallowance__totalcuti, 'class' => 'basic', 'id' => 'cutiallowance__totalcuti'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'cutiallowance__notes', 'value' => $cutiallowance__notes, 'class' => 'basic', 'id' => 'cutiallowance__notes'));?></td></tr>
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
