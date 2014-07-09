<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#cash_bankoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#cash_bankeditform').click(function(){$('#cash_bankeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Cash Bank</h3>

<p>
<div id="cash_bankoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/cash_bankedit/submit" id="cash_bankeditform" class="editform">

<?=form_hidden("cash_bank_id", $cash_bank_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'cashbank__name', 'value' => $cashbank__name, 'id' => 'cashbank__name'));?></td></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('cashbank__currency_id', $currency_opt, $cashbank__currency_id);?>&nbsp;<input id='cashbank__currency_id_lookup' type='button' value='Lookup'></input></td><div id='cashbank__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#cashbank__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#cashbank__currency_id_dialog').html(data);$('#cashbank__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=cashbank__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=cashbank__currency_id]').val(lines[0]);if (typeof window.cash_bank_selected_currency_id == 'function') { cash_bank_selected_currency_id("<?=site_url();?>"); }}$('#cashbank__currency_id_dialog').dialog('close');});$('#cashbank__currency_id_lookup').button().click(function() {$('#cashbank__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Account *</td><td><?=form_dropdown('cashbank__coa_id', $coa_opt, $cashbank__coa_id);?>&nbsp;<input id='cashbank__coa_id_lookup' type='button' value='Lookup'></input></td><div id='cashbank__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#cashbank__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#cashbank__coa_id_dialog').html(data);$('#cashbank__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=cashbank__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=cashbank__coa_id]').val(lines[0]);if (typeof window.cash_bank_selected_coa_id == 'function') { cash_bank_selected_coa_id("<?=site_url();?>"); }}$('#cashbank__coa_id_dialog').dialog('close');});$('#cashbank__coa_id_lookup').button().click(function() {$('#cashbank__coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'cashbank__notes', 'value' => $cashbank__notes, 'id' => 'cashbank__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cash_banklist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


