<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#credit_note_inoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#credit_note_ineditform').click(function(){$('#credit_note_ineditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Credit Note In</h3>

<p>
<div id="credit_note_inoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/credit_note_inedit/submit" id="credit_note_ineditform" class="editform">

<?=form_hidden("credit_note_in_id", $credit_note_in_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>CN ID *</td><td><?=form_input(array('name' => 'creditnotein__creditnoteinid', 'value' => $creditnotein__creditnoteinid, 'id' => 'creditnotein__creditnoteinid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#creditnotein__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'creditnotein__date', 'value' => $creditnotein__date, 'class' => 'date', 'id' => 'creditnotein__date'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#creditnotein__expirydate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Expiry Date *</td><td><?=form_input(array('name' => 'creditnotein__expirydate', 'value' => $creditnotein__expirydate, 'class' => 'date', 'id' => 'creditnotein__expirydate'));?></td></tr><tr class='basic'>
<td>Supplier *</td><td><?=form_dropdown('creditnotein__supplier_id', $supplier_opt, $creditnotein__supplier_id);?>&nbsp;<input id='creditnotein__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='creditnotein__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnotein__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#creditnotein__supplier_id_dialog').html(data);$('#creditnotein__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnotein__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnotein__supplier_id]').val(lines[0]);if (typeof window.credit_note_in_selected_supplier_id == 'function') { credit_note_in_selected_supplier_id("<?=site_url();?>"); }}$('#creditnotein__supplier_id_dialog').dialog('close');});$('#creditnotein__supplier_id_lookup').button().click(function() {$('#creditnotein__supplier_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Account *</td><td><?=form_dropdown('creditnotein__coa_id', $coa_opt, $creditnotein__coa_id);?>&nbsp;<input id='creditnotein__coa_id_lookup' type='button' value='Lookup'></input></td><div id='creditnotein__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnotein__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#creditnotein__coa_id_dialog').html(data);$('#creditnotein__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnotein__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnotein__coa_id]').val(lines[0]);if (typeof window.credit_note_in_selected_coa_id == 'function') { credit_note_in_selected_coa_id("<?=site_url();?>"); }}$('#creditnotein__coa_id_dialog').dialog('close');});$('#creditnotein__coa_id_lookup').button().click(function() {$('#creditnotein__coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('creditnotein__currency_id', $currency_opt, $creditnotein__currency_id);?>&nbsp;<input id='creditnotein__currency_id_lookup' type='button' value='Lookup'></input></td><div id='creditnotein__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnotein__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#creditnotein__currency_id_dialog').html(data);$('#creditnotein__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnotein__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnotein__currency_id]').val(lines[0]);if (typeof window.credit_note_in_selected_currency_id == 'function') { credit_note_in_selected_currency_id("<?=site_url();?>"); }}$('#creditnotein__currency_id_dialog').dialog('close');});$('#creditnotein__currency_id_lookup').button().click(function() {$('#creditnotein__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Amount</td><td><?=form_input(array('name' => 'creditnotein__amount', 'value' => $creditnotein__amount, 'id' => 'creditnotein__amount'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'creditnotein__notes', 'value' => $creditnotein__notes, 'id' => 'creditnotein__notes'));?></td></tr><tr class='basic'>
<td>Used</td><td><input type='checkbox' name='creditnotein__usedflag' value='1' <?php if ($creditnotein__usedflag > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/credit_note_inlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


