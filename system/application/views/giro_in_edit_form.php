<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#giro_inoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#giro_ineditform').click(function(){$('#giro_ineditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Giro In</h3>

<p>
<div id="giro_inoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_inedit/submit" id="giro_ineditform" class="editform">

<?=form_hidden("giro_in_id", $giro_in_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Giro ID *</td><td><?=form_input(array('name' => 'giroin__giroinid', 'value' => $giroin__giroinid, 'id' => 'giroin__giroinid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#giroin__createdate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Creation Date *</td><td><?=form_input(array('name' => 'giroin__createdate', 'value' => $giroin__createdate, 'class' => 'date', 'id' => 'giroin__createdate'));?></td></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('giroin__customer_id', $customer_opt, $giroin__customer_id);?>&nbsp;<input id='giroin__customer_id_lookup' type='button' value='Lookup'></input></td><div id='giroin__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#giroin__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#giroin__customer_id_dialog').html(data);$('#giroin__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=giroin__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=giroin__customer_id]').val(lines[0]);if (typeof window.giro_in_selected_customer_id == 'function') { giro_in_selected_customer_id("<?=site_url();?>"); }}$('#giroin__customer_id_dialog').dialog('close');});$('#giroin__customer_id_lookup').button().click(function() {$('#giroin__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('giroin__currency_id', $currency_opt, $giroin__currency_id);?>&nbsp;<input id='giroin__currency_id_lookup' type='button' value='Lookup'></input></td><div id='giroin__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#giroin__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#giroin__currency_id_dialog').html(data);$('#giroin__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=giroin__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=giroin__currency_id]').val(lines[0]);if (typeof window.giro_in_selected_currency_id == 'function') { giro_in_selected_currency_id("<?=site_url();?>"); }}$('#giroin__currency_id_dialog').dialog('close');});$('#giroin__currency_id_lookup').button().click(function() {$('#giroin__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Amount</td><td><?=form_input(array('name' => 'giroin__amount', 'value' => $giroin__amount, 'id' => 'giroin__amount'));?></td></tr><tr class='basic'>
<td>Account *</td><td><?=form_dropdown('giroin__coa_id', $coa_opt, $giroin__coa_id);?>&nbsp;<input id='giroin__coa_id_lookup' type='button' value='Lookup'></input></td><div id='giroin__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#giroin__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#giroin__coa_id_dialog').html(data);$('#giroin__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=giroin__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=giroin__coa_id]').val(lines[0]);if (typeof window.giro_in_selected_coa_id == 'function') { giro_in_selected_coa_id("<?=site_url();?>"); }}$('#giroin__coa_id_dialog').dialog('close');});$('#giroin__coa_id_lookup').button().click(function() {$('#giroin__coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'giroin__notes', 'value' => $giroin__notes, 'id' => 'giroin__notes'));?></td></tr><tr class='basic'>
<td>Used</td><td><input type='checkbox' name='giroin__usedflag' value='1' <?php if ($giroin__usedflag > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_inlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


