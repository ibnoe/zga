<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_order_open_sentoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_return_order_open_sentview/index/' },
		}; 
		
		$('#purchase_return_order_open_sentform').click(function(){$('#purchase_return_order_open_sentform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Order Open Sent</h3>

<p>
<div id="purchase_return_order_open_sentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_order_open_sentadd/submit" id="purchase_return_order_open_sentform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchasereturnorder__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchasereturnorder__date', 'value' => $purchasereturnorder__date, 'class' => 'purchasereturnorder__datebasic'));?></td></tr>
<tr class='basic'>
<td>Return ID *</td>
<td><?=form_input(array('name' => 'purchasereturnorder__purchasereturnorderid', 'value' => $purchasereturnorder__purchasereturnorderid, 'class' => 'basic', 'id' => 'purchasereturnorder__purchasereturnorderid'));?></td></tr>
<tr class='basic'>
<td>Supplier *</td>
<td><?=form_dropdown('purchasereturnorder__supplier_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasereturnorder__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnorder__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnorder__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#purchasereturnorder__supplier_id_dialog').html(data);$('#purchasereturnorder__supplier_id_dialog a').attr('disabled', 'disabled');$('#purchasereturnorder__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnorder__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturnorder__supplier_id]').val(lines[0]);if (typeof window.purchase_return_order_open_sent_selected_supplier_id == 'function') { purchase_return_order_open_sent_selected_supplier_id("<?=site_url();?>"); }}$('#purchasereturnorder__supplier_id_dialog').dialog('close');});$('#purchasereturnorder__supplier_id_lookup').button().click(function() {$('#purchasereturnorder__supplier_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Currency *</td>
<td><?=form_dropdown('purchasereturnorder__currency_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasereturnorder__currency_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturnorder__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturnorder__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#purchasereturnorder__currency_id_dialog').html(data);$('#purchasereturnorder__currency_id_dialog a').attr('disabled', 'disabled');$('#purchasereturnorder__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturnorder__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturnorder__currency_id]').val(lines[0]);if (typeof window.purchase_return_order_open_sent_selected_currency_id == 'function') { purchase_return_order_open_sent_selected_currency_id("<?=site_url();?>"); }}$('#purchasereturnorder__currency_id_dialog').dialog('close');});$('#purchasereturnorder__currency_id_lookup').button().click(function() {$('#purchasereturnorder__currency_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Currency Rate</td>
<td><?=form_input(array('name' => 'purchasereturnorder__currencyrate', 'value' => $purchasereturnorder__currencyrate, 'class' => 'basic', 'id' => 'purchasereturnorder__currencyrate'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'purchasereturnorder__notes', 'value' => $purchasereturnorder__notes, 'class' => 'basic', 'id' => 'purchasereturnorder__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_order_open_sentlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
