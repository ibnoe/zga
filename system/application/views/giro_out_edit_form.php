<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#giro_outoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#giro_outeditform').click(function(){$('#giro_outeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Giro Out</h3>

<p>
<div id="giro_outoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_outedit/submit" id="giro_outeditform" class="editform">

<?=form_hidden("giro_out_id", $giro_out_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Giro ID *</td><td><?=form_input(array('name' => 'giroout__girooutid', 'value' => $giroout__girooutid, 'id' => 'giroout__girooutid'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#giroout__createdate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Creation Date *</td><td><?=form_input(array('name' => 'giroout__createdate', 'value' => $giroout__createdate, 'class' => 'date', 'id' => 'giroout__createdate'));?></td></tr><tr class='basic'>
<td>Supplier *</td><td><?=form_dropdown('giroout__supplier_id', $supplier_opt, $giroout__supplier_id);?>&nbsp;<input id='giroout__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='giroout__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#giroout__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#giroout__supplier_id_dialog').html(data);$('#giroout__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=giroout__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=giroout__supplier_id]').val(lines[0]);if (typeof window.giro_out_selected_supplier_id == 'function') { giro_out_selected_supplier_id("<?=site_url();?>"); }}$('#giroout__supplier_id_dialog').dialog('close');});$('#giroout__supplier_id_lookup').button().click(function() {$('#giroout__supplier_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('giroout__currency_id', $currency_opt, $giroout__currency_id);?>&nbsp;<input id='giroout__currency_id_lookup' type='button' value='Lookup'></input></td><div id='giroout__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#giroout__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#giroout__currency_id_dialog').html(data);$('#giroout__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=giroout__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=giroout__currency_id]').val(lines[0]);if (typeof window.giro_out_selected_currency_id == 'function') { giro_out_selected_currency_id("<?=site_url();?>"); }}$('#giroout__currency_id_dialog').dialog('close');});$('#giroout__currency_id_lookup').button().click(function() {$('#giroout__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Amount</td><td><?=form_input(array('name' => 'giroout__amount', 'value' => $giroout__amount, 'id' => 'giroout__amount'));?></td></tr><tr class='basic'>
<td>Account *</td><td><?=form_dropdown('giroout__coa_id', $coa_opt, $giroout__coa_id);?>&nbsp;<input id='giroout__coa_id_lookup' type='button' value='Lookup'></input></td><div id='giroout__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#giroout__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#giroout__coa_id_dialog').html(data);$('#giroout__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=giroout__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=giroout__coa_id]').val(lines[0]);if (typeof window.giro_out_selected_coa_id == 'function') { giro_out_selected_coa_id("<?=site_url();?>"); }}$('#giroout__coa_id_dialog').dialog('close');});$('#giroout__coa_id_lookup').button().click(function() {$('#giroout__coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'giroout__notes', 'value' => $giroout__notes, 'id' => 'giroout__notes'));?></td></tr><tr class='basic'>
<td>Used</td><td><input type='checkbox' name='giroout__usedflag' value='1' <?php if ($giroout__usedflag > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_outlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


