<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#fixed_assetoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#fixed_asseteditform').click(function(){$('#fixed_asseteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Fixed Asset</h3>

<p>
<div id="fixed_assetoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/fixed_assetedit/submit" id="fixed_asseteditform" class="editform">

<?=form_hidden("fixed_asset_id", $fixed_asset_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'fixedasset__name', 'value' => $fixedasset__name, 'id' => 'fixedasset__name'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#fixedasset__datebought").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date Buy *</td><td><?=form_input(array('name' => 'fixedasset__datebought', 'value' => $fixedasset__datebought, 'class' => 'date', 'id' => 'fixedasset__datebought'));?></td></tr><tr class='basic'>
<td>Fixed Asset Account *</td><td><?=form_dropdown('fixedasset__coa_id', $coa_opt, $fixedasset__coa_id);?>&nbsp;<input id='fixedasset__coa_id_lookup' type='button' value='Lookup'></input></td><div id='fixedasset__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#fixedasset__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#fixedasset__coa_id_dialog').html(data);$('#fixedasset__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=fixedasset__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=fixedasset__coa_id]').val(lines[0]);if (typeof window.fixed_asset_selected_coa_id == 'function') { fixed_asset_selected_coa_id("<?=site_url();?>"); }}$('#fixedasset__coa_id_dialog').dialog('close');});$('#fixedasset__coa_id_lookup').button().click(function() {$('#fixedasset__coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Pay Account *</td><td><?=form_dropdown('fixedasset__paidusing_coa_id', $coa_opt, $fixedasset__paidusing_coa_id);?>&nbsp;<input id='fixedasset__paidusing_coa_id_lookup' type='button' value='Lookup'></input></td><div id='fixedasset__paidusing_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#fixedasset__paidusing_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/pay_accountslookup', function(data) { $('#fixedasset__paidusing_coa_id_dialog').html(data);$('#fixedasset__paidusing_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=fixedasset__paidusing_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=fixedasset__paidusing_coa_id]').val(lines[0]);if (typeof window.fixed_asset_selected_paidusing_coa_id == 'function') { fixed_asset_selected_paidusing_coa_id("<?=site_url();?>"); }}$('#fixedasset__paidusing_coa_id_dialog').dialog('close');});$('#fixedasset__paidusing_coa_id_lookup').button().click(function() {$('#fixedasset__paidusing_coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Depreciation Account *</td><td><?=form_dropdown('fixedasset__depreciation_coa_id', $coa_opt, $fixedasset__depreciation_coa_id);?>&nbsp;<input id='fixedasset__depreciation_coa_id_lookup' type='button' value='Lookup'></input></td><div id='fixedasset__depreciation_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#fixedasset__depreciation_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/depreciation_accountslookup', function(data) { $('#fixedasset__depreciation_coa_id_dialog').html(data);$('#fixedasset__depreciation_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=fixedasset__depreciation_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=fixedasset__depreciation_coa_id]').val(lines[0]);if (typeof window.fixed_asset_selected_depreciation_coa_id == 'function') { fixed_asset_selected_depreciation_coa_id("<?=site_url();?>"); }}$('#fixedasset__depreciation_coa_id_dialog').dialog('close');});$('#fixedasset__depreciation_coa_id_lookup').button().click(function() {$('#fixedasset__depreciation_coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Accumulated Account *</td><td><?=form_dropdown('fixedasset__accumulated_coa_id', $coa_opt, $fixedasset__accumulated_coa_id);?>&nbsp;<input id='fixedasset__accumulated_coa_id_lookup' type='button' value='Lookup'></input></td><div id='fixedasset__accumulated_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#fixedasset__accumulated_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accumulated_accountslookup', function(data) { $('#fixedasset__accumulated_coa_id_dialog').html(data);$('#fixedasset__accumulated_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=fixedasset__accumulated_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=fixedasset__accumulated_coa_id]').val(lines[0]);if (typeof window.fixed_asset_selected_accumulated_coa_id == 'function') { fixed_asset_selected_accumulated_coa_id("<?=site_url();?>"); }}$('#fixedasset__accumulated_coa_id_dialog').dialog('close');});$('#fixedasset__accumulated_coa_id_lookup').button().click(function() {$('#fixedasset__accumulated_coa_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Est Lifetime *</td><td><?=form_input(array('name' => 'fixedasset__estlifetime', 'value' => $fixedasset__estlifetime, 'id' => 'fixedasset__estlifetime'));?></td></tr><tr class='basic'>
<td>Cost *</td><td><?=form_input(array('name' => 'fixedasset__cost', 'value' => $fixedasset__cost, 'id' => 'fixedasset__cost'));?></td></tr><tr class='basic'>
<td>Salvage</td><td><?=form_input(array('name' => 'fixedasset__salvage', 'value' => $fixedasset__salvage, 'id' => 'fixedasset__salvage'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'fixedasset__notes', 'value' => $fixedasset__notes, 'id' => 'fixedasset__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/fixed_assetlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


