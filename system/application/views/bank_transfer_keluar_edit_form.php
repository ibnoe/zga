<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#bank_transfer_keluaroutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#bank_transfer_keluareditform').click(function(){$('#bank_transfer_keluareditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Bank Transfer Keluar</h3>

<p>
<div id="bank_transfer_keluaroutput"></div>
</p>

<form method="post" action="<?=site_url();?>/bank_transfer_keluaredit/submit" id="bank_transfer_keluareditform" class="editform">

<?=form_hidden("bank_transfer_keluar_id", $bank_transfer_keluar_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'banktransferkeluar__idstring', 'value' => $banktransferkeluar__idstring, 'id' => 'banktransferkeluar__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#banktransferkeluar__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'banktransferkeluar__date', 'value' => $banktransferkeluar__date, 'class' => 'date', 'id' => 'banktransferkeluar__date'));?></td></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('banktransferkeluar__currency_id', $currency_opt, $banktransferkeluar__currency_id);?>&nbsp;<input id='banktransferkeluar__currency_id_lookup' type='button' value='Lookup'></input></td><div id='banktransferkeluar__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#banktransferkeluar__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#banktransferkeluar__currency_id_dialog').html(data);$('#banktransferkeluar__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=banktransferkeluar__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=banktransferkeluar__currency_id]').val(lines[0]);if (typeof window.bank_transfer_keluar_selected_currency_id == 'function') { bank_transfer_keluar_selected_currency_id("<?=site_url();?>"); }}$('#banktransferkeluar__currency_id_dialog').dialog('close');});$('#banktransferkeluar__currency_id_lookup').button().click(function() {$('#banktransferkeluar__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Amount</td><td><?=form_input(array('name' => 'banktransferkeluar__amount', 'value' => $banktransferkeluar__amount, 'id' => 'banktransferkeluar__amount'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'banktransferkeluar__notes', 'value' => $banktransferkeluar__notes, 'id' => 'banktransferkeluar__notes'));?></td></tr><tr class='basic'>
<td>Transferred</td><td><input type='checkbox' name='banktransferkeluar__transferedflag' value='1' <?php if ($banktransferkeluar__transferedflag > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bank_transfer_keluarlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


