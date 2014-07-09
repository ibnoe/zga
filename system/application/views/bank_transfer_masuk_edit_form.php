<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#bank_transfer_masukoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#bank_transfer_masukeditform').click(function(){$('#bank_transfer_masukeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Bank Transfer Masuk</h3>

<p>
<div id="bank_transfer_masukoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/bank_transfer_masukedit/submit" id="bank_transfer_masukeditform" class="editform">

<?=form_hidden("bank_transfer_masuk_id", $bank_transfer_masuk_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'banktransfermasuk__idstring', 'value' => $banktransfermasuk__idstring, 'id' => 'banktransfermasuk__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#banktransfermasuk__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'banktransfermasuk__date', 'value' => $banktransfermasuk__date, 'class' => 'date', 'id' => 'banktransfermasuk__date'));?></td></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('banktransfermasuk__currency_id', $currency_opt, $banktransfermasuk__currency_id);?>&nbsp;<input id='banktransfermasuk__currency_id_lookup' type='button' value='Lookup'></input></td><div id='banktransfermasuk__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#banktransfermasuk__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#banktransfermasuk__currency_id_dialog').html(data);$('#banktransfermasuk__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=banktransfermasuk__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=banktransfermasuk__currency_id]').val(lines[0]);if (typeof window.bank_transfer_masuk_selected_currency_id == 'function') { bank_transfer_masuk_selected_currency_id("<?=site_url();?>"); }}$('#banktransfermasuk__currency_id_dialog').dialog('close');});$('#banktransfermasuk__currency_id_lookup').button().click(function() {$('#banktransfermasuk__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Amount</td><td><?=form_input(array('name' => 'banktransfermasuk__amount', 'value' => $banktransfermasuk__amount, 'id' => 'banktransfermasuk__amount'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'banktransfermasuk__notes', 'value' => $banktransfermasuk__notes, 'id' => 'banktransfermasuk__notes'));?></td></tr><tr class='basic'>
<td>Transferred</td><td><input type='checkbox' name='banktransfermasuk__transferedflag' value='1' <?php if ($banktransfermasuk__transferedflag > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bank_transfer_masuklist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


