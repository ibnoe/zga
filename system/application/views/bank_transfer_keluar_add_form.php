<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#bank_transfer_keluaroutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/bank_transfer_keluarview/index/' },
		}; 
		
		$('#bank_transfer_keluarform').click(function(){$('#bank_transfer_keluarform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Bank Transfer Keluar</h3>

<p>
<div id="bank_transfer_keluaroutput"></div>
</p>

<form method="post" action="<?=site_url();?>/bank_transfer_keluaradd/submit" id="bank_transfer_keluarform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'banktransferkeluar__idstring', 'value' => $banktransferkeluar__idstring, 'class' => 'basic', 'id' => 'banktransferkeluar__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".banktransferkeluar__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'banktransferkeluar__date', 'value' => $banktransferkeluar__date, 'class' => 'banktransferkeluar__datebasic'));?></td></tr>
<tr class='basic'>
<td>Currency *</td>
<td><?=form_dropdown('banktransferkeluar__currency_id', array(), '', 'class="basic"');?>&nbsp;<input id='banktransferkeluar__currency_id_lookup' type='button' value='Lookup'></input></td><div id='banktransferkeluar__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#banktransferkeluar__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#banktransferkeluar__currency_id_dialog').html(data);$('#banktransferkeluar__currency_id_dialog a').attr('disabled', 'disabled');$('#banktransferkeluar__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=banktransferkeluar__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=banktransferkeluar__currency_id]').val(lines[0]);if (typeof window.bank_transfer_keluar_selected_currency_id == 'function') { bank_transfer_keluar_selected_currency_id("<?=site_url();?>"); }}$('#banktransferkeluar__currency_id_dialog').dialog('close');});$('#banktransferkeluar__currency_id_lookup').button().click(function() {$('#banktransferkeluar__currency_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Amount</td>
<td><?=form_input(array('name' => 'banktransferkeluar__amount', 'value' => $banktransferkeluar__amount, 'class' => 'basic', 'id' => 'banktransferkeluar__amount'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'banktransferkeluar__notes', 'value' => $banktransferkeluar__notes, 'class' => 'basic', 'id' => 'banktransferkeluar__notes'));?></td></tr>
<tr class='basic'>
<td>Transferred</td>
<td><input type='checkbox' name='banktransferkeluar__transferedflag' value='1'></input></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bank_transfer_keluarlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
