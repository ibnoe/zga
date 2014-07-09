<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#surat_pengajuan_repairoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#surat_pengajuan_repaireditform').click(function(){$('#surat_pengajuan_repaireditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Surat Pengajuan Repair</h3>

<p>
<div id="surat_pengajuan_repairoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/surat_pengajuan_repairedit/submit" id="surat_pengajuan_repaireditform" class="editform">

<?=form_hidden("surat_pengajuan_repair_id", $surat_pengajuan_repair_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>No Form *</td><td><?=form_input(array('name' => 'suratpengajuanrepair__idstring', 'value' => $suratpengajuanrepair__idstring, 'id' => 'suratpengajuanrepair__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#suratpengajuanrepair__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'suratpengajuanrepair__date', 'value' => $suratpengajuanrepair__date, 'class' => 'date', 'id' => 'suratpengajuanrepair__date'));?></td></tr><tr class='basic'>
<td>Diajukan oleh</td><td><?=form_input(array('name' => 'suratpengajuanrepair__requester', 'value' => $suratpengajuanrepair__requester, 'id' => 'suratpengajuanrepair__requester'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/surat_pengajuan_repairlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


