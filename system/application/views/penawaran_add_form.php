<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#penawaranoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/penawaranview/index/' },
		}; 
		
		$('#penawaranform').click(function(){$('#penawaranform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Penawaran</h3>

<p>
<div id="penawaranoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/penawaranadd/submit" id="penawaranform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>No Penawaran *</td>
<td><?=form_input(array('name' => 'salesorderquote__nopenawaran', 'value' => $salesorderquote__nopenawaran, 'class' => 'basic', 'id' => 'salesorderquote__nopenawaran'));?></td></tr>
<tr class='basic'>
<td>No PO</td>
<td><?=form_input(array('name' => 'salesorderquote__customerponumber', 'value' => $salesorderquote__customerponumber, 'class' => 'basic', 'id' => 'salesorderquote__customerponumber'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".salesorderquote__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'salesorderquote__date', 'value' => $salesorderquote__date, 'class' => 'salesorderquote__datebasic'));?></td></tr>
<tr class='basic'>
<td>Description</td>
<td><?=form_input(array('name' => 'salesorderquote__notes', 'value' => $salesorderquote__notes, 'class' => 'basic', 'id' => 'salesorderquote__notes'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<td><?=form_dropdown('salesorderquote__customer_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorderquote__customer_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderquote__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderquote__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#salesorderquote__customer_id_dialog').html(data);$('#salesorderquote__customer_id_dialog a').attr('disabled', 'disabled');$('#salesorderquote__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorderquote__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorderquote__customer_id]').val(lines[0]);if (typeof window.penawaran_selected_customer_id == 'function') { penawaran_selected_customer_id("<?=site_url();?>"); }}$('#salesorderquote__customer_id_dialog').dialog('close');});$('#salesorderquote__customer_id_lookup').button().click(function() {$('#salesorderquote__customer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Currency *</td>
<td><?=form_dropdown('salesorderquote__currency_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorderquote__currency_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderquote__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderquote__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#salesorderquote__currency_id_dialog').html(data);$('#salesorderquote__currency_id_dialog a').attr('disabled', 'disabled');$('#salesorderquote__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorderquote__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorderquote__currency_id]').val(lines[0]);if (typeof window.penawaran_selected_currency_id == 'function') { penawaran_selected_currency_id("<?=site_url();?>"); }}$('#salesorderquote__currency_id_dialog').dialog('close');});$('#salesorderquote__currency_id_lookup').button().click(function() {$('#salesorderquote__currency_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Currency Rate</td>
<td><?=form_input(array('name' => 'salesorderquote__currencyrate', 'value' => $salesorderquote__currencyrate, 'class' => 'basic', 'id' => 'salesorderquote__currencyrate'));?></td></tr>
<tr class='basic'>
<td>Marketing Officer</td>
<td><?=form_dropdown('salesorderquote__marketingofficer_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorderquote__marketingofficer_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderquote__marketingofficer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderquote__marketingofficer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/marketing_officerlookup', function(data) { $('#salesorderquote__marketingofficer_id_dialog').html(data);$('#salesorderquote__marketingofficer_id_dialog a').attr('disabled', 'disabled');$('#salesorderquote__marketingofficer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorderquote__marketingofficer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorderquote__marketingofficer_id]').val(lines[0]);if (typeof window.penawaran_selected_marketingofficer_id == 'function') { penawaran_selected_marketingofficer_id("<?=site_url();?>"); }}$('#salesorderquote__marketingofficer_id_dialog').dialog('close');});$('#salesorderquote__marketingofficer_id_lookup').button().click(function() {$('#salesorderquote__marketingofficer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Status</td><script type="text/javascript">$(document).ready(function() {$('#salesorderquote__status').change(function() { $('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#salesorderquote__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});$('.waiting_for_approval').attr('disabled', 'disabled');$('.waiting_for_approval').hide();$('.rejected').attr('disabled', 'disabled');$('.rejected').hide();$('.approved').attr('disabled', 'disabled');$('.approved').hide();var s = $("#salesorderquote__status option:selected").text();if (s == 'Waiting For Approval') {$('.waiting_for_approval').attr('disabled', '');$('.waiting_for_approval').show();}if (s == 'Rejected') {$('.rejected').attr('disabled', '');$('.rejected').show();}if (s == 'Approved') {$('.approved').attr('disabled', '');$('.approved').show();}});</script>
<td><?=form_dropdown('salesorderquote__status', array('Waiting For Approval' => 'Waiting For Approval', 'Rejected' => 'Rejected', 'Approved' => 'Approved', ), $salesorderquote__status, 'id="salesorderquote__status" class="basic"');?></td></tr>
<tr class='approved'>
<td>SO ID *</td>
<td><?=form_input(array('name' => 'salesorderquote__orderid', 'value' => $salesorderquote__orderid, 'class' => 'approved', 'id' => 'salesorderquote__orderid'));?></td></tr>
<tr class='basic'>
<?=form_hidden('salesorderquote__modulename', $salesorderquote__modulename);?></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penawaranlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
