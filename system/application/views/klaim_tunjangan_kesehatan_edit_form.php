<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#klaim_tunjangan_kesehatanoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#klaim_tunjangan_kesehataneditform').click(function(){$('#klaim_tunjangan_kesehataneditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Klaim Tunjangan Kesehatan</h3>

<p>
<div id="klaim_tunjangan_kesehatanoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/klaim_tunjangan_kesehatanedit/submit" id="klaim_tunjangan_kesehataneditform" class="editform">

<?=form_hidden("klaim_tunjangan_kesehatan_id", $klaim_tunjangan_kesehatan_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#tunjangankesehatanusage__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'tunjangankesehatanusage__date', 'value' => $tunjangankesehatanusage__date, 'class' => 'date', 'id' => 'tunjangankesehatanusage__date'));?></td></tr><tr class='basic'>
<td>Receipt From</td><td><?=form_input(array('name' => 'tunjangankesehatanusage__description', 'value' => $tunjangankesehatanusage__description, 'id' => 'tunjangankesehatanusage__description'));?></td></tr><tr class='basic'>
<td>Total Receipt</td><td><?=form_input(array('name' => 'tunjangankesehatanusage__amount', 'value' => $tunjangankesehatanusage__amount, 'id' => 'tunjangankesehatanusage__amount'));?></td></tr><tr class='basic'>
<td>Company Paid</td><td><?=form_input(array('name' => 'tunjangankesehatanusage__amountpaid', 'value' => $tunjangankesehatanusage__amountpaid, 'id' => 'tunjangankesehatanusage__amountpaid'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'tunjangankesehatanusage__notes', 'value' => $tunjangankesehatanusage__notes, 'id' => 'tunjangankesehatanusage__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/klaim_tunjangan_kesehatanlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


