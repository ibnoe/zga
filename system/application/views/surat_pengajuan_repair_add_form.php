<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#surat_pengajuan_repairoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/surat_pengajuan_repairview/index/' },
		}; 
		
		$('#surat_pengajuan_repairform').click(function(){$('#surat_pengajuan_repairform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Surat Pengajuan Repair</h3>

<p>
<div id="surat_pengajuan_repairoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/surat_pengajuan_repairadd/submit" id="surat_pengajuan_repairform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>No Form *</td>
<td><?=form_input(array('name' => 'suratpengajuanrepair__idstring', 'value' => $suratpengajuanrepair__idstring, 'class' => 'basic', 'id' => 'suratpengajuanrepair__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".suratpengajuanrepair__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'suratpengajuanrepair__date', 'value' => $suratpengajuanrepair__date, 'class' => 'suratpengajuanrepair__datebasic'));?></td></tr>
<tr class='basic'>
<td>Diajukan oleh</td>
<td><?=form_input(array('name' => 'suratpengajuanrepair__requester', 'value' => $suratpengajuanrepair__requester, 'class' => 'basic', 'id' => 'suratpengajuanrepair__requester'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/surat_pengajuan_repairlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
