<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#alokasi_tunjangan_kesehatanoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#alokasi_tunjangan_kesehataneditform').click(function(){$('#alokasi_tunjangan_kesehataneditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Alokasi Tunjangan Kesehatan</h3>

<p>
<div id="alokasi_tunjangan_kesehatanoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/alokasi_tunjangan_kesehatanedit/submit" id="alokasi_tunjangan_kesehataneditform" class="editform">

<?=form_hidden("alokasi_tunjangan_kesehatan_id", $alokasi_tunjangan_kesehatan_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#tunjangankesehatanallowance__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'tunjangankesehatanallowance__date', 'value' => $tunjangankesehatanallowance__date, 'class' => 'date', 'id' => 'tunjangankesehatanallowance__date'));?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'tunjangankesehatanallowance__description', 'value' => $tunjangankesehatanallowance__description, 'id' => 'tunjangankesehatanallowance__description'));?></td></tr><tr class='basic'>
<td>Amount</td><td><?=form_input(array('name' => 'tunjangankesehatanallowance__amount', 'value' => $tunjangankesehatanallowance__amount, 'id' => 'tunjangankesehatanallowance__amount'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'tunjangankesehatanallowance__notes', 'value' => $tunjangankesehatanallowance__notes, 'id' => 'tunjangankesehatanallowance__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/alokasi_tunjangan_kesehatanlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


