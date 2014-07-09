<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_order_open_paymentoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_order_open_paymentview/index/' },
		}; 
		
		$('#purchase_order_open_paymentform').click(function(){$('#purchase_order_open_paymentform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Order Open Payment</h3>

<p>
<div id="purchase_order_open_paymentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_order_open_paymentadd/submit" id="purchase_order_open_paymentform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>PO ID *</td>
<td><?=form_input(array('name' => 'purchaseorder__orderid', 'value' => $purchaseorder__orderid, 'class' => 'basic', 'id' => 'purchaseorder__orderid'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchaseorder__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchaseorder__date', 'value' => $purchaseorder__date, 'class' => 'purchaseorder__datebasic'));?></td></tr>
<tr class='basic'>
<td>SPP</td>
<td><?=form_dropdown('purchaseorder__suratpermintaanpembelian_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchaseorder__suratpermintaanpembelian_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseorder__suratpermintaanpembelian_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseorder__suratpermintaanpembelian_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/spplookup', function(data) { $('#purchaseorder__suratpermintaanpembelian_id_dialog').html(data);$('#purchaseorder__suratpermintaanpembelian_id_dialog a').attr('disabled', 'disabled');$('#purchaseorder__suratpermintaanpembelian_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchaseorder__suratpermintaanpembelian_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchaseorder__suratpermintaanpembelian_id]').val(lines[0]);if (typeof window.purchase_order_open_payment_selected_suratpermintaanpembelian_id == 'function') { purchase_order_open_payment_selected_suratpermintaanpembelian_id("<?=site_url();?>"); }}$('#purchaseorder__suratpermintaanpembelian_id_dialog').dialog('close');});$('#purchaseorder__suratpermintaanpembelian_id_lookup').button().click(function() {$('#purchaseorder__suratpermintaanpembelian_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Supplier *</td>
<td><?=form_dropdown('purchaseorder__supplier_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchaseorder__supplier_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseorder__supplier_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseorder__supplier_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplierlookup', function(data) { $('#purchaseorder__supplier_id_dialog').html(data);$('#purchaseorder__supplier_id_dialog a').attr('disabled', 'disabled');$('#purchaseorder__supplier_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchaseorder__supplier_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchaseorder__supplier_id]').val(lines[0]);if (typeof window.purchase_order_open_payment_selected_supplier_id == 'function') { purchase_order_open_payment_selected_supplier_id("<?=site_url();?>"); }}$('#purchaseorder__supplier_id_dialog').dialog('close');});$('#purchaseorder__supplier_id_lookup').button().click(function() {$('#purchaseorder__supplier_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Buy Source</td><script type="text/javascript">$(document).ready(function() {$('#purchaseorder__buysource').change(function() { $('.lokal').attr('disabled', 'disabled');$('.lokal').hide();$('.import').attr('disabled', 'disabled');$('.import').hide();var s = $("#purchaseorder__buysource option:selected").text();if (s == 'Lokal') {$('.lokal').attr('disabled', '');$('.lokal').show();}if (s == 'Import') {$('.import').attr('disabled', '');$('.import').show();}});$('.lokal').attr('disabled', 'disabled');$('.lokal').hide();$('.import').attr('disabled', 'disabled');$('.import').hide();var s = $("#purchaseorder__buysource option:selected").text();if (s == 'Lokal') {$('.lokal').attr('disabled', '');$('.lokal').show();}if (s == 'Import') {$('.import').attr('disabled', '');$('.import').show();}});</script>
<td><?=form_dropdown('purchaseorder__buysource', array('Lokal' => 'Lokal', 'Import' => 'Import', ), $purchaseorder__buysource, 'id="purchaseorder__buysource" class="basic"');?></td></tr>
<tr class='basic'>
<td>Currency *</td>
<td><?=form_dropdown('purchaseorder__currency_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchaseorder__currency_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseorder__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseorder__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#purchaseorder__currency_id_dialog').html(data);$('#purchaseorder__currency_id_dialog a').attr('disabled', 'disabled');$('#purchaseorder__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchaseorder__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchaseorder__currency_id]').val(lines[0]);if (typeof window.purchase_order_open_payment_selected_currency_id == 'function') { purchase_order_open_payment_selected_currency_id("<?=site_url();?>"); }}$('#purchaseorder__currency_id_dialog').dialog('close');});$('#purchaseorder__currency_id_lookup').button().click(function() {$('#purchaseorder__currency_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Currency Rate</td>
<td><?=form_input(array('name' => 'purchaseorder__currencyrate', 'value' => $purchaseorder__currencyrate, 'class' => 'basic', 'id' => 'purchaseorder__currencyrate'));?></td></tr>
<tr class='basic'>
<td>PO Quote 1</td>
<td><?=form_upload(array('name' => 'purchaseorder__quote1', 'class' => 'basic', 'id' => 'purchaseorder__quote1'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'purchaseorder__notes', 'value' => $purchaseorder__notes, 'class' => 'basic', 'id' => 'purchaseorder__notes'));?></td></tr>
<tr class='basic'>
<td>Supplier 2</td>
<td><?=form_dropdown('purchaseorder__supplier2_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchaseorder__supplier2_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseorder__supplier2_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseorder__supplier2_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplier_2lookup', function(data) { $('#purchaseorder__supplier2_id_dialog').html(data);$('#purchaseorder__supplier2_id_dialog a').attr('disabled', 'disabled');$('#purchaseorder__supplier2_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchaseorder__supplier2_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchaseorder__supplier2_id]').val(lines[0]);if (typeof window.purchase_order_open_payment_selected_supplier2_id == 'function') { purchase_order_open_payment_selected_supplier2_id("<?=site_url();?>"); }}$('#purchaseorder__supplier2_id_dialog').dialog('close');});$('#purchaseorder__supplier2_id_lookup').button().click(function() {$('#purchaseorder__supplier2_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>PO Quote 2</td>
<td><?=form_upload(array('name' => 'purchaseorder__quote2', 'class' => 'basic', 'id' => 'purchaseorder__quote2'));?></td></tr>
<tr class='basic'>
<td>Notes 2</td>
<td><?=form_input(array('name' => 'purchaseorder__notes2', 'value' => $purchaseorder__notes2, 'class' => 'basic', 'id' => 'purchaseorder__notes2'));?></td></tr>
<tr class='basic'>
<td>Supplier 3</td>
<td><?=form_dropdown('purchaseorder__supplier3_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchaseorder__supplier3_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseorder__supplier3_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseorder__supplier3_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/supplier_3lookup', function(data) { $('#purchaseorder__supplier3_id_dialog').html(data);$('#purchaseorder__supplier3_id_dialog a').attr('disabled', 'disabled');$('#purchaseorder__supplier3_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchaseorder__supplier3_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchaseorder__supplier3_id]').val(lines[0]);if (typeof window.purchase_order_open_payment_selected_supplier3_id == 'function') { purchase_order_open_payment_selected_supplier3_id("<?=site_url();?>"); }}$('#purchaseorder__supplier3_id_dialog').dialog('close');});$('#purchaseorder__supplier3_id_lookup').button().click(function() {$('#purchaseorder__supplier3_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>PO Quote 3</td>
<td><?=form_upload(array('name' => 'purchaseorder__quote3', 'class' => 'basic', 'id' => 'purchaseorder__quote3'));?></td></tr>
<tr class='basic'>
<td>Notes 3</td>
<td><?=form_input(array('name' => 'purchaseorder__notes3', 'value' => $purchaseorder__notes3, 'class' => 'basic', 'id' => 'purchaseorder__notes3'));?></td></tr>
<tr class='basic'>
<td>Forwarder</td>
<td><?=form_dropdown('purchaseorder__forwarder_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchaseorder__forwarder_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseorder__forwarder_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseorder__forwarder_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/forwarderlookup', function(data) { $('#purchaseorder__forwarder_id_dialog').html(data);$('#purchaseorder__forwarder_id_dialog a').attr('disabled', 'disabled');$('#purchaseorder__forwarder_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchaseorder__forwarder_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchaseorder__forwarder_id]').val(lines[0]);if (typeof window.purchase_order_open_payment_selected_forwarder_id == 'function') { purchase_order_open_payment_selected_forwarder_id("<?=site_url();?>"); }}$('#purchaseorder__forwarder_id_dialog').dialog('close');});$('#purchaseorder__forwarder_id_lookup').button().click(function() {$('#purchaseorder__forwarder_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Ship Method</td><script type="text/javascript">$(document).ready(function() {$('#purchaseorder__shipmethod').change(function() { $('.by_sea').attr('disabled', 'disabled');$('.by_sea').hide();$('.by_air').attr('disabled', 'disabled');$('.by_air').hide();$('.by_land').attr('disabled', 'disabled');$('.by_land').hide();var s = $("#purchaseorder__shipmethod option:selected").text();if (s == 'By Sea') {$('.by_sea').attr('disabled', '');$('.by_sea').show();}if (s == 'By Air') {$('.by_air').attr('disabled', '');$('.by_air').show();}if (s == 'By Land') {$('.by_land').attr('disabled', '');$('.by_land').show();}});$('.by_sea').attr('disabled', 'disabled');$('.by_sea').hide();$('.by_air').attr('disabled', 'disabled');$('.by_air').hide();$('.by_land').attr('disabled', 'disabled');$('.by_land').hide();var s = $("#purchaseorder__shipmethod option:selected").text();if (s == 'By Sea') {$('.by_sea').attr('disabled', '');$('.by_sea').show();}if (s == 'By Air') {$('.by_air').attr('disabled', '');$('.by_air').show();}if (s == 'By Land') {$('.by_land').attr('disabled', '');$('.by_land').show();}});</script>
<td><?=form_dropdown('purchaseorder__shipmethod', array('By Sea' => 'By Sea', 'By Air' => 'By Air', 'By Land' => 'By Land', ), $purchaseorder__shipmethod, 'id="purchaseorder__shipmethod" class="basic"');?></td></tr>
<tr class='basic'>
<td>Est Arrival Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchaseorder__estarrivaldatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchaseorder__estarrivaldate', 'value' => $purchaseorder__estarrivaldate, 'class' => 'purchaseorder__estarrivaldatebasic'));?></td></tr>
<tr class='basic'>
<td>Total Amount</td>
<td><?=form_input(array('name' => 'purchaseorder__total', 'value' => $purchaseorder__total, 'class' => 'basic', 'id' => 'purchaseorder__total'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_order_open_paymentlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
