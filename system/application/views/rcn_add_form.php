<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#rcnoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/rcnview/index/' },
		}; 
		
		$('#rcnform').click(function(){$('#rcnform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New RCN</h3>

<p>
<div id="rcnoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/rcnadd/submit" id="rcnform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>No RIF *</td>
<?=form_hidden('rcn__norif', $rcn__norif);?>
<td><?=$rcn__norif;?></td></tr>
<tr class='basic'>
<td>No RCN *</td>
<td><?=form_input(array('name' => 'rcn__norcn', 'value' => $rcn__norcn, 'class' => 'basic', 'id' => 'rcn__norcn'));?></td></tr>
<tr class='basic'>
<td>No PO *</td>
<td><?=form_input(array('name' => 'rcn__customerponumber', 'value' => $rcn__customerponumber, 'class' => 'basic', 'id' => 'rcn__customerponumber'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".rcn__datercnbasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'rcn__datercn', 'value' => $rcn__datercn, 'class' => 'rcn__datercnbasic'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<td><?=form_dropdown('rcn__customer_id', array(), '', 'class="basic"');?>&nbsp;<input id='rcn__customer_id_lookup' type='button' value='Lookup'></input></td><div id='rcn__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rcn__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#rcn__customer_id_dialog').html(data);$('#rcn__customer_id_dialog a').attr('disabled', 'disabled');$('#rcn__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rcn__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=rcn__customer_id]').val(lines[0]);if (typeof window.rcn_selected_customer_id == 'function') { rcn_selected_customer_id("<?=site_url();?>"); }}$('#rcn__customer_id_dialog').dialog('close');});$('#rcn__customer_id_lookup').button().click(function() {$('#rcn__customer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Roller to Recover</td>
<td><input type='checkbox' name='rcn__reqtorecover' value='1'></input></td></tr>
<tr class='basic'>
<td>Exchange Core to Return</td>
<td><input type='checkbox' name='rcn__reqcoretoreturn' value='1'></input></td></tr>
<tr class='basic'>
<td>Roller Return Unused</td>
<td><input type='checkbox' name='rcn__reqreturnunused' value='1'></input></td></tr>
<tr class='basic'>
<td>Roller Returned Faulty</td>
<td><input type='checkbox' name='rcn__reqreturnfaulty' value='1'></input></td></tr>
<tr class='basic'>
<td>Others</td>
<td><input type='checkbox' name='rcn__reqothers' value='1'></input></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'rcn__notes', 'value' => $rcn__notes, 'class' => 'basic', 'id' => 'rcn__notes'));?></td></tr>
<tr class='basic'>
<td>Status</td><script type="text/javascript">$(document).ready(function() {$('#rcn__status').change(function() { $('.approved_by_marketing').attr('disabled', 'disabled');$('.approved_by_marketing').hide();$('.rejected_by_marketing').attr('disabled', 'disabled');$('.rejected_by_marketing').hide();$('.waiting_for_marketing_approval').attr('disabled', 'disabled');$('.waiting_for_marketing_approval').hide();$('.approved_by_customer').attr('disabled', 'disabled');$('.approved_by_customer').hide();$('.rejected_by_customer').attr('disabled', 'disabled');$('.rejected_by_customer').hide();$('.waiting_for_customer_approval').attr('disabled', 'disabled');$('.waiting_for_customer_approval').hide();var s = $("#rcn__status option:selected").text();if (s == 'Approved by Marketing') {$('.approved_by_marketing').attr('disabled', '');$('.approved_by_marketing').show();}if (s == 'Rejected by Marketing') {$('.rejected_by_marketing').attr('disabled', '');$('.rejected_by_marketing').show();}if (s == 'Waiting For Marketing Approval') {$('.waiting_for_marketing_approval').attr('disabled', '');$('.waiting_for_marketing_approval').show();}if (s == 'Approved by Customer') {$('.approved_by_customer').attr('disabled', '');$('.approved_by_customer').show();}if (s == 'Rejected by Customer') {$('.rejected_by_customer').attr('disabled', '');$('.rejected_by_customer').show();}if (s == 'Waiting For Customer Approval') {$('.waiting_for_customer_approval').attr('disabled', '');$('.waiting_for_customer_approval').show();}});$('.approved_by_marketing').attr('disabled', 'disabled');$('.approved_by_marketing').hide();$('.rejected_by_marketing').attr('disabled', 'disabled');$('.rejected_by_marketing').hide();$('.waiting_for_marketing_approval').attr('disabled', 'disabled');$('.waiting_for_marketing_approval').hide();$('.approved_by_customer').attr('disabled', 'disabled');$('.approved_by_customer').hide();$('.rejected_by_customer').attr('disabled', 'disabled');$('.rejected_by_customer').hide();$('.waiting_for_customer_approval').attr('disabled', 'disabled');$('.waiting_for_customer_approval').hide();var s = $("#rcn__status option:selected").text();if (s == 'Approved by Marketing') {$('.approved_by_marketing').attr('disabled', '');$('.approved_by_marketing').show();}if (s == 'Rejected by Marketing') {$('.rejected_by_marketing').attr('disabled', '');$('.rejected_by_marketing').show();}if (s == 'Waiting For Marketing Approval') {$('.waiting_for_marketing_approval').attr('disabled', '');$('.waiting_for_marketing_approval').show();}if (s == 'Approved by Customer') {$('.approved_by_customer').attr('disabled', '');$('.approved_by_customer').show();}if (s == 'Rejected by Customer') {$('.rejected_by_customer').attr('disabled', '');$('.rejected_by_customer').show();}if (s == 'Waiting For Customer Approval') {$('.waiting_for_customer_approval').attr('disabled', '');$('.waiting_for_customer_approval').show();}});</script>
<td><?=form_dropdown('rcn__status', array('Approved by Marketing' => 'Approved by Marketing', 'Rejected by Marketing' => 'Rejected by Marketing', 'Waiting For Marketing Approval' => 'Waiting For Marketing Approval', 'Approved by Customer' => 'Approved by Customer', 'Rejected by Customer' => 'Rejected by Customer', 'Waiting For Customer Approval' => 'Waiting For Customer Approval', ), $rcn__status, 'id="rcn__status" class="basic"');?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/rcnlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
