<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sppoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sppview/index/' },
		}; 
		
		$('#sppform').click(function(){$('#sppform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New SPP</h3>

<p>
<div id="sppoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sppadd/submit" id="sppform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>No SPP *</td>
<td><?=form_input(array('name' => 'suratpermintaanpembelian__orderid', 'value' => $suratpermintaanpembelian__orderid, 'class' => 'basic', 'id' => 'suratpermintaanpembelian__orderid'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".suratpermintaanpembelian__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'suratpermintaanpembelian__date', 'value' => $suratpermintaanpembelian__date, 'class' => 'suratpermintaanpembelian__datebasic'));?></td></tr>
<tr class='basic'>
<td>Requester</td>
<td><?=form_input(array('name' => 'suratpermintaanpembelian__requester', 'value' => $suratpermintaanpembelian__requester, 'class' => 'basic', 'id' => 'suratpermintaanpembelian__requester'));?></td></tr>
<tr class='basic'>
<td>Divisi</td>
<td><?=form_input(array('name' => 'suratpermintaanpembelian__divisi', 'value' => $suratpermintaanpembelian__divisi, 'class' => 'basic', 'id' => 'suratpermintaanpembelian__divisi'));?></td></tr>
<tr class='basic'>
<td>Buy Source</td><script type="text/javascript">$(document).ready(function() {$('#suratpermintaanpembelian__buysource').change(function() { $('.lokal').attr('disabled', 'disabled');$('.lokal').hide();$('.import').attr('disabled', 'disabled');$('.import').hide();var s = $("#suratpermintaanpembelian__buysource option:selected").text();if (s == 'Lokal') {$('.lokal').attr('disabled', '');$('.lokal').show();}if (s == 'Import') {$('.import').attr('disabled', '');$('.import').show();}});$('.lokal').attr('disabled', 'disabled');$('.lokal').hide();$('.import').attr('disabled', 'disabled');$('.import').hide();var s = $("#suratpermintaanpembelian__buysource option:selected").text();if (s == 'Lokal') {$('.lokal').attr('disabled', '');$('.lokal').show();}if (s == 'Import') {$('.import').attr('disabled', '');$('.import').show();}});</script>
<td><?=form_dropdown('suratpermintaanpembelian__buysource', array('Lokal' => 'Lokal', 'Import' => 'Import', ), $suratpermintaanpembelian__buysource, 'id="suratpermintaanpembelian__buysource" class="basic"');?></td></tr>
<tr class='basic'>
<td>Description</td>
<td><?=form_input(array('name' => 'suratpermintaanpembelian__notes', 'value' => $suratpermintaanpembelian__notes, 'class' => 'basic', 'id' => 'suratpermintaanpembelian__notes'));?></td></tr>
<tr class='basic'>
<td>Status</td><script type="text/javascript">$(document).ready(function() {$('#suratpermintaanpembelian__status').change(function() { $('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.cancelled').attr('disabled', 'disabled');$('.cancelled').hide();var s = $("#suratpermintaanpembelian__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Cancelled') {$('.cancelled').attr('disabled', '');$('.cancelled').show();}});$('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.cancelled').attr('disabled', 'disabled');$('.cancelled').hide();var s = $("#suratpermintaanpembelian__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Cancelled') {$('.cancelled').attr('disabled', '');$('.cancelled').show();}});</script>
<td><?=form_dropdown('suratpermintaanpembelian__status', array('Waiting For Approval' => 'Waiting For Approval', 'Approved' => 'Approved', 'Rejected' => 'Rejected', 'Cancelled' => 'Cancelled', ), $suratpermintaanpembelian__status, 'id="suratpermintaanpembelian__status" class="basic"');?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/spplist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
