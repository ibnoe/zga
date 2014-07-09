<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#alokasi_cutioutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#alokasi_cutieditform').click(function(){$('#alokasi_cutieditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Alokasi Cuti</h3>

<p>
<div id="alokasi_cutioutput"></div>
</p>

<form method="post" action="<?=site_url();?>/alokasi_cutiedit/submit" id="alokasi_cutieditform" class="editform">

<?=form_hidden("alokasi_cuti_id", $alokasi_cuti_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#cutiallowance__begindate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Start Date *</td><td><?=form_input(array('name' => 'cutiallowance__begindate', 'value' => $cutiallowance__begindate, 'class' => 'date', 'id' => 'cutiallowance__begindate'));?></td></tr><tr class='basic'>
<td>Total Cuti</td><td><?=form_input(array('name' => 'cutiallowance__totalcuti', 'value' => $cutiallowance__totalcuti, 'id' => 'cutiallowance__totalcuti'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'cutiallowance__notes', 'value' => $cutiallowance__notes, 'id' => 'cutiallowance__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/alokasi_cutilist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


