<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sppoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sppeditform').click(function(){$('#sppeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit SPP</h3>

<p>
<div id="sppoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sppedit/submit" id="sppeditform" class="editform">

<?=form_hidden("spp_id", $spp_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>No SPP *</td><td><?=form_input(array('name' => 'suratpermintaanpembelian__orderid', 'value' => $suratpermintaanpembelian__orderid, 'id' => 'suratpermintaanpembelian__orderid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#suratpermintaanpembelian__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'suratpermintaanpembelian__date', 'value' => $suratpermintaanpembelian__date, 'class' => 'date', 'id' => 'suratpermintaanpembelian__date'));?></td></tr><tr class='basic'>
<td>Requester</td><td><?=form_input(array('name' => 'suratpermintaanpembelian__requester', 'value' => $suratpermintaanpembelian__requester, 'id' => 'suratpermintaanpembelian__requester'));?></td></tr><tr class='basic'>
<td>Divisi</td><td><?=form_input(array('name' => 'suratpermintaanpembelian__divisi', 'value' => $suratpermintaanpembelian__divisi, 'id' => 'suratpermintaanpembelian__divisi'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#suratpermintaanpembelian__buysource').change(function() { $('.lokal').attr('disabled', 'disabled');$('.lokal').hide();$('.import').attr('disabled', 'disabled');$('.import').hide();var s = $("#suratpermintaanpembelian__buysource option:selected").text();if (s == 'Lokal') {$('.lokal').attr('disabled', '');$('.lokal').show();}if (s == 'Import') {$('.import').attr('disabled', '');$('.import').show();}});$('.lokal').attr('disabled', 'disabled');$('.lokal').hide();$('.import').attr('disabled', 'disabled');$('.import').hide();var s = $("#suratpermintaanpembelian__buysource option:selected").text();if (s == 'Lokal') {$('.lokal').attr('disabled', '');$('.lokal').show();}if (s == 'Import') {$('.import').attr('disabled', '');$('.import').show();}});</script>
<td>Buy Source</td><td><?=form_dropdown('suratpermintaanpembelian__buysource', array('Lokal' => 'Lokal', 'Import' => 'Import', ), $suratpermintaanpembelian__buysource, 'id="suratpermintaanpembelian__buysource" class="basic"');?></td></tr><tr class='basic'>
<td>Description</td><td><?=form_input(array('name' => 'suratpermintaanpembelian__notes', 'value' => $suratpermintaanpembelian__notes, 'id' => 'suratpermintaanpembelian__notes'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#suratpermintaanpembelian__status').change(function() { $('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.cancelled').attr('disabled', 'disabled');$('.cancelled').hide();var s = $("#suratpermintaanpembelian__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Cancelled') {$('.cancelled').attr('disabled', '');$('.cancelled').show();}});$('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.cancelled').attr('disabled', 'disabled');$('.cancelled').hide();var s = $("#suratpermintaanpembelian__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Cancelled') {$('.cancelled').attr('disabled', '');$('.cancelled').show();}});</script>
<td>Status</td><td><?=form_dropdown('suratpermintaanpembelian__status', array('Waiting For Approval' => 'Waiting For Approval', 'Approved' => 'Approved', 'Rejected' => 'Rejected', 'Cancelled' => 'Cancelled', ), $suratpermintaanpembelian__status, 'id="suratpermintaanpembelian__status" class="basic"');?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/spplist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


