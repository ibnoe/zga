<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#credit_note_inoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/credit_note_inview/index/' },
		}; 
		
		$('#credit_note_inform').click(function(){$('#credit_note_inform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Credit Note In</h3>

<p>
<div id="credit_note_inoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/credit_note_inadd/submit" id="credit_note_inform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>CN ID *</td>
<td><?=form_input(array('name' => 'creditnotein__creditnoteinid', 'value' => $creditnotein__creditnoteinid, 'class' => 'basic', 'id' => 'creditnotein__creditnoteinid'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".creditnotein__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'creditnotein__date', 'value' => $creditnotein__date, 'class' => 'creditnotein__datebasic'));?></td></tr>
<tr class='basic'>
<td>Expiry Date *</td><script type="text/javascript">$(document).ready(function() {$(".creditnotein__expirydatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'creditnotein__expirydate', 'value' => $creditnotein__expirydate, 'class' => 'creditnotein__expirydatebasic'));?></td></tr>
<tr class='basic'>
<td>Supplier *</td>
<td><?=form_dropdown('creditnotein__supplier_id', array(), '', 'class="basic"');?>&nbsp;<input id='creditnotein__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='creditnotein__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnotein__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#creditnotein__supplier_id_dialog').html(data);$('#creditnotein__supplier_id_dialog a').attr('disabled', 'disabled');$('#creditnotein__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnotein__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnotein__supplier_id]').val(lines[0]);if (typeof window.credit_note_in_selected_supplier_id == 'function') { credit_note_in_selected_supplier_id("<?=site_url();?>"); }}$('#creditnotein__supplier_id_dialog').dialog('close');});$('#creditnotein__supplier_id_lookup').button().click(function() {$('#creditnotein__supplier_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Account *</td>
<td><?=form_dropdown('creditnotein__coa_id', array(), '', 'class="basic"');?>&nbsp;<input id='creditnotein__coa_id_lookup' type='button' value='Lookup'></input></td><div id='creditnotein__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnotein__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#creditnotein__coa_id_dialog').html(data);$('#creditnotein__coa_id_dialog a').attr('disabled', 'disabled');$('#creditnotein__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnotein__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnotein__coa_id]').val(lines[0]);if (typeof window.credit_note_in_selected_coa_id == 'function') { credit_note_in_selected_coa_id("<?=site_url();?>"); }}$('#creditnotein__coa_id_dialog').dialog('close');});$('#creditnotein__coa_id_lookup').button().click(function() {$('#creditnotein__coa_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Currency *</td>
<td><?=form_dropdown('creditnotein__currency_id', array(), '', 'class="basic"');?>&nbsp;<input id='creditnotein__currency_id_lookup' type='button' value='Lookup'></input></td><div id='creditnotein__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnotein__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#creditnotein__currency_id_dialog').html(data);$('#creditnotein__currency_id_dialog a').attr('disabled', 'disabled');$('#creditnotein__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnotein__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnotein__currency_id]').val(lines[0]);if (typeof window.credit_note_in_selected_currency_id == 'function') { credit_note_in_selected_currency_id("<?=site_url();?>"); }}$('#creditnotein__currency_id_dialog').dialog('close');});$('#creditnotein__currency_id_lookup').button().click(function() {$('#creditnotein__currency_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Amount</td>
<td><?=form_input(array('name' => 'creditnotein__amount', 'value' => $creditnotein__amount, 'class' => 'basic', 'id' => 'creditnotein__amount'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'creditnotein__notes', 'value' => $creditnotein__notes, 'class' => 'basic', 'id' => 'creditnotein__notes'));?></td></tr>
<tr class='basic'>
<td>Used</td>
<td><input type='checkbox' name='creditnotein__usedflag' value='1' checked='checked' ></input></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/credit_note_inlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
