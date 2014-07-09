<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#credit_note_outoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/credit_note_outview/index/' },
		}; 
		
		$('#credit_note_outform').click(function(){$('#credit_note_outform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Credit Note Out</h3>

<p>
<div id="credit_note_outoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/credit_note_outadd/submit" id="credit_note_outform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>CN ID *</td>
<td><?=form_input(array('name' => 'creditnoteout__creditnoteoutid', 'value' => $creditnoteout__creditnoteoutid, 'class' => 'basic', 'id' => 'creditnoteout__creditnoteoutid'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".creditnoteout__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'creditnoteout__date', 'value' => $creditnoteout__date, 'class' => 'creditnoteout__datebasic'));?></td></tr>
<tr class='basic'>
<td>Expiry Date *</td><script type="text/javascript">$(document).ready(function() {$(".creditnoteout__expirydatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'creditnoteout__expirydate', 'value' => $creditnoteout__expirydate, 'class' => 'creditnoteout__expirydatebasic'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<td><?=form_dropdown('creditnoteout__customer_id', array(), '', 'class="basic"');?>&nbsp;<input id='creditnoteout__customer_id_lookup' type='button' value='Lookup'></input></td><div id='creditnoteout__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnoteout__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#creditnoteout__customer_id_dialog').html(data);$('#creditnoteout__customer_id_dialog a').attr('disabled', 'disabled');$('#creditnoteout__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnoteout__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnoteout__customer_id]').val(lines[0]);if (typeof window.credit_note_out_selected_customer_id == 'function') { credit_note_out_selected_customer_id("<?=site_url();?>"); }}$('#creditnoteout__customer_id_dialog').dialog('close');});$('#creditnoteout__customer_id_lookup').button().click(function() {$('#creditnoteout__customer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Account *</td>
<td><?=form_dropdown('creditnoteout__coa_id', array(), '', 'class="basic"');?>&nbsp;<input id='creditnoteout__coa_id_lookup' type='button' value='Lookup'></input></td><div id='creditnoteout__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnoteout__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#creditnoteout__coa_id_dialog').html(data);$('#creditnoteout__coa_id_dialog a').attr('disabled', 'disabled');$('#creditnoteout__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnoteout__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnoteout__coa_id]').val(lines[0]);if (typeof window.credit_note_out_selected_coa_id == 'function') { credit_note_out_selected_coa_id("<?=site_url();?>"); }}$('#creditnoteout__coa_id_dialog').dialog('close');});$('#creditnoteout__coa_id_lookup').button().click(function() {$('#creditnoteout__coa_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Currency *</td>
<td><?=form_dropdown('creditnoteout__currency_id', array(), '', 'class="basic"');?>&nbsp;<input id='creditnoteout__currency_id_lookup' type='button' value='Lookup'></input></td><div id='creditnoteout__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnoteout__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#creditnoteout__currency_id_dialog').html(data);$('#creditnoteout__currency_id_dialog a').attr('disabled', 'disabled');$('#creditnoteout__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnoteout__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnoteout__currency_id]').val(lines[0]);if (typeof window.credit_note_out_selected_currency_id == 'function') { credit_note_out_selected_currency_id("<?=site_url();?>"); }}$('#creditnoteout__currency_id_dialog').dialog('close');});$('#creditnoteout__currency_id_lookup').button().click(function() {$('#creditnoteout__currency_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Amount</td>
<td><?=form_input(array('name' => 'creditnoteout__amount', 'value' => $creditnoteout__amount, 'class' => 'basic', 'id' => 'creditnoteout__amount'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'creditnoteout__notes', 'value' => $creditnoteout__notes, 'class' => 'basic', 'id' => 'creditnoteout__notes'));?></td></tr>
<tr class='basic'>
<td>Used</td>
<td><input type='checkbox' name='creditnoteout__usedflag' value='1' checked='checked' ></input></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/credit_note_outlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
