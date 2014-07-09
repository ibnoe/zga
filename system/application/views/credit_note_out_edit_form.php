<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#credit_note_outoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#credit_note_outeditform').click(function(){$('#credit_note_outeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Credit Note Out</h3>

<p>
<div id="credit_note_outoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/credit_note_outedit/submit" id="credit_note_outeditform" class="editform">

<?=form_hidden("credit_note_out_id", $credit_note_out_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>CN ID *</td><td><?=form_input(array('name' => 'creditnoteout__creditnoteoutid', 'value' => $creditnoteout__creditnoteoutid, 'id' => 'creditnoteout__creditnoteoutid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#creditnoteout__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'creditnoteout__date', 'value' => $creditnoteout__date, 'class' => 'date', 'id' => 'creditnoteout__date'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#creditnoteout__expirydate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Expiry Date *</td><td><?=form_input(array('name' => 'creditnoteout__expirydate', 'value' => $creditnoteout__expirydate, 'class' => 'date', 'id' => 'creditnoteout__expirydate'));?></td></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('creditnoteout__customer_id', $customer_opt, $creditnoteout__customer_id);?>&nbsp;<input id='creditnoteout__customer_id_lookup' type='button' value='Lookup'></input></td><div id='creditnoteout__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnoteout__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#creditnoteout__customer_id_dialog').html(data);$('#creditnoteout__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnoteout__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnoteout__customer_id]').val(lines[0]);if (typeof window.credit_note_out_selected_customer_id == 'function') { credit_note_out_selected_customer_id("<?=site_url();?>"); }}$('#creditnoteout__customer_id_dialog').dialog('close');});$('#creditnoteout__customer_id_lookup').button().click(function() {$('#creditnoteout__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Account *</td><td><?=form_dropdown('creditnoteout__coa_id', $coa_opt, $creditnoteout__coa_id);?>&nbsp;<input id='creditnoteout__coa_id_lookup' type='button' value='Lookup'></input></td><div id='creditnoteout__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnoteout__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#creditnoteout__coa_id_dialog').html(data);$('#creditnoteout__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnoteout__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnoteout__coa_id]').val(lines[0]);if (typeof window.credit_note_out_selected_coa_id == 'function') { credit_note_out_selected_coa_id("<?=site_url();?>"); }}$('#creditnoteout__coa_id_dialog').dialog('close');});$('#creditnoteout__coa_id_lookup').button().click(function() {$('#creditnoteout__coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('creditnoteout__currency_id', $currency_opt, $creditnoteout__currency_id);?>&nbsp;<input id='creditnoteout__currency_id_lookup' type='button' value='Lookup'></input></td><div id='creditnoteout__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#creditnoteout__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#creditnoteout__currency_id_dialog').html(data);$('#creditnoteout__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=creditnoteout__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=creditnoteout__currency_id]').val(lines[0]);if (typeof window.credit_note_out_selected_currency_id == 'function') { credit_note_out_selected_currency_id("<?=site_url();?>"); }}$('#creditnoteout__currency_id_dialog').dialog('close');});$('#creditnoteout__currency_id_lookup').button().click(function() {$('#creditnoteout__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Amount</td><td><?=form_input(array('name' => 'creditnoteout__amount', 'value' => $creditnoteout__amount, 'id' => 'creditnoteout__amount'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'creditnoteout__notes', 'value' => $creditnoteout__notes, 'id' => 'creditnoteout__notes'));?></td></tr><tr class='basic'>
<td>Used</td><td><input type='checkbox' name='creditnoteout__usedflag' value='1' <?php if ($creditnoteout__usedflag > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/credit_note_outlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


