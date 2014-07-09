<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#cuti_approvaloutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#cuti_approvaleditform').click(function(){$('#cuti_approvaleditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Cuti Approval</h3>

<p>
<div id="cuti_approvaloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/cuti_approvaledit/submit" id="cuti_approvaleditform" class="editform">

<?=form_hidden("cuti_approval_id", $cuti_approval_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#cutiklaim__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'cutiklaim__date', 'value' => $cutiklaim__date, 'class' => 'date', 'id' => 'cutiklaim__date'));?></td></tr><tr class='basic'>
<td>Total Cuti Diambil</td><td><?=form_input(array('name' => 'cutiklaim__totalcutiklaimed', 'value' => $cutiklaim__totalcutiklaimed, 'id' => 'cutiklaim__totalcutiklaimed'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'cutiklaim__notes', 'value' => $cutiklaim__notes, 'id' => 'cutiklaim__notes'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#cutiklaim__status').change(function() { $('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#cutiklaim__status option:selected").text();if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});$('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#cutiklaim__status option:selected").text();if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});</script>
<td>Status</td><td><?=form_dropdown('cutiklaim__status', array('Approved' => 'Approved', ), $cutiklaim__status, 'id="cutiklaim__status" class="basic"');?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cuti_approvallist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


