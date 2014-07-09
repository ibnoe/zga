<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#cuti_approvaloutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/cuti_approvalview/index/' },
		}; 
		
		$('#cuti_approvalform').click(function(){$('#cuti_approvalform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Cuti Approval</h3>

<p>
<div id="cuti_approvaloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/cuti_approvaladd/submit" id="cuti_approvalform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".cutiklaim__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'cutiklaim__date', 'value' => $cutiklaim__date, 'class' => 'cutiklaim__datebasic'));?></td></tr>
<tr class='basic'>
<td>Total Cuti Diambil</td>
<?=form_hidden('cutiklaim__totalcutiklaimed', $cutiklaim__totalcutiklaimed);?>
<td><?=$cutiklaim__totalcutiklaimed;?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'cutiklaim__notes', 'value' => $cutiklaim__notes, 'class' => 'basic', 'id' => 'cutiklaim__notes'));?></td></tr>
<tr class='basic'>
<td>Status</td><script type="text/javascript">$(document).ready(function() {$('#cutiklaim__status').change(function() { $('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#cutiklaim__status option:selected").text();if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});$('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#cutiklaim__status option:selected").text();if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});</script>
<td><?=form_dropdown('cutiklaim__status', array('Approved' => 'Approved', ), $cutiklaim__status, 'id="cutiklaim__status" class="basic"');?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cuti_approvallist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
