<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#customeroutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#customereditform').click(function(){$('#customereditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Customer</h3>

<p>
<div id="customeroutput"></div>
</p>

<form method="post" action="<?=site_url();?>/customeredit/submit" id="customereditform" class="editform">

<?=form_hidden("customer_id", $customer_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Customer ID *</td><td><?=form_input(array('name' => 'customer__idstring', 'value' => $customer__idstring, 'id' => 'customer__idstring'));?></td></tr><tr class='basic'>
<td>First Name *</td><td><?=form_input(array('name' => 'customer__firstname', 'value' => $customer__firstname, 'id' => 'customer__firstname'));?></td></tr><tr class='basic'>
<td>Last Name</td><td><?=form_input(array('name' => 'customer__lastname', 'value' => $customer__lastname, 'id' => 'customer__lastname'));?></td></tr><tr class='basic'>
<td>Address</td><td><?=form_input(array('name' => 'customer__address', 'value' => $customer__address, 'id' => 'customer__address'));?></td></tr><tr class='basic'>
<td>Default Delivery Recipient</td><td><?=form_input(array('name' => 'customer__deliveryrecipient', 'value' => $customer__deliveryrecipient, 'id' => 'customer__deliveryrecipient'));?></td></tr><tr class='basic'>
<td>Default Delivery Address</td><td><?=form_input(array('name' => 'customer__deliveryaddress', 'value' => $customer__deliveryaddress, 'id' => 'customer__deliveryaddress'));?></td></tr><tr class='basic'>
<td>Default VAT(%)</td><td><?=form_input(array('name' => 'customer__tax_rate', 'value' => $customer__tax_rate, 'id' => 'customer__tax_rate'));?></td></tr><tr class='basic'>
<td>Default Disc(%)</td><td><?=form_input(array('name' => 'customer__discount', 'value' => $customer__discount, 'id' => 'customer__discount'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#customer__top').change(function() { $('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#customer__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});$('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#customer__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});</script>
<td>Default Payment Term</td><td><?=form_dropdown('customer__top', array('Cash' => 'Cash', '30 Days' => '30 Days', '60 Days' => '60 Days', ), $customer__top, 'id="customer__top" class="basic"');?></td></tr><tr class='basic'>
<td>Phone</td><td><?=form_input(array('name' => 'customer__phone', 'value' => $customer__phone, 'id' => 'customer__phone'));?></td></tr><tr class='basic'>
<td>Fax</td><td><?=form_input(array('name' => 'customer__fax', 'value' => $customer__fax, 'id' => 'customer__fax'));?></td></tr><tr class='basic'>
<td>NPWP</td><td><?=form_input(array('name' => 'customer__npwp', 'value' => $customer__npwp, 'id' => 'customer__npwp'));?></td></tr><tr class='basic'>
<td>Email</td><td><?=form_input(array('name' => 'customer__email', 'value' => $customer__email, 'id' => 'customer__email'));?></td></tr><tr class='basic'>
<td>Website</td><td><?=form_input(array('name' => 'customer__website', 'value' => $customer__website, 'id' => 'customer__website'));?></td></tr><tr class='basic'>
<td>Default Currency</td><td><?=form_dropdown('customer__currency_id', $currency_opt, $customer__currency_id);?>&nbsp;<input id='customer__currency_id_lookup' type='button' value='Lookup'></input></td><div id='customer__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#customer__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#customer__currency_id_dialog').html(data);$('#customer__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=customer__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=customer__currency_id]').val(lines[0]);if (typeof window.customer_selected_currency_id == 'function') { customer_selected_currency_id("<?=site_url();?>"); }}$('#customer__currency_id_dialog').dialog('close');});$('#customer__currency_id_lookup').button().click(function() {$('#customer__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Company Group</td><td><?=form_dropdown('customer__customergroup_id', $customergroup_opt, $customer__customergroup_id);?>&nbsp;<input id='customer__customergroup_id_lookup' type='button' value='Lookup'></input></td><div id='customer__customergroup_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#customer__customergroup_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/company_grouplookup', function(data) { $('#customer__customergroup_id_dialog').html(data);$('#customer__customergroup_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=customer__customergroup_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=customer__customergroup_id]').val(lines[0]);if (typeof window.customer_selected_customergroup_id == 'function') { customer_selected_customergroup_id("<?=site_url();?>"); }}$('#customer__customergroup_id_dialog').dialog('close');});$('#customer__customergroup_id_lookup').button().click(function() {$('#customer__customergroup_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Marketing Officer</td><td><?=form_dropdown('customer__marketingofficer_id', $marketingofficer_opt, $customer__marketingofficer_id);?>&nbsp;<input id='customer__marketingofficer_id_lookup' type='button' value='Lookup'></input></td><div id='customer__marketingofficer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#customer__marketingofficer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/marketing_officerlookup', function(data) { $('#customer__marketingofficer_id_dialog').html(data);$('#customer__marketingofficer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=customer__marketingofficer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=customer__marketingofficer_id]').val(lines[0]);if (typeof window.customer_selected_marketingofficer_id == 'function') { customer_selected_marketingofficer_id("<?=site_url();?>"); }}$('#customer__marketingofficer_id_dialog').dialog('close');});$('#customer__marketingofficer_id_lookup').button().click(function() {$('#customer__marketingofficer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#customer__status').change(function() { $('.agen').attr('disabled', 'disabled');$('.agen').hide();$('.cabang').attr('disabled', 'disabled');$('.cabang').hide();$('.dalam_kota').attr('disabled', 'disabled');$('.dalam_kota').hide();$('.luar_kota').attr('disabled', 'disabled');$('.luar_kota').hide();$('.luar_negeri').attr('disabled', 'disabled');$('.luar_negeri').hide();var s = $("#customer__status option:selected").text();if (s == 'Agen') {$('.agen').attr('disabled', '');$('.agen').show();}if (s == 'Cabang') {$('.cabang').attr('disabled', '');$('.cabang').show();}if (s == 'Dalam Kota') {$('.dalam_kota').attr('disabled', '');$('.dalam_kota').show();}if (s == 'Luar Kota') {$('.luar_kota').attr('disabled', '');$('.luar_kota').show();}if (s == 'Luar Negeri') {$('.luar_negeri').attr('disabled', '');$('.luar_negeri').show();}});$('.agen').attr('disabled', 'disabled');$('.agen').hide();$('.cabang').attr('disabled', 'disabled');$('.cabang').hide();$('.dalam_kota').attr('disabled', 'disabled');$('.dalam_kota').hide();$('.luar_kota').attr('disabled', 'disabled');$('.luar_kota').hide();$('.luar_negeri').attr('disabled', 'disabled');$('.luar_negeri').hide();var s = $("#customer__status option:selected").text();if (s == 'Agen') {$('.agen').attr('disabled', '');$('.agen').show();}if (s == 'Cabang') {$('.cabang').attr('disabled', '');$('.cabang').show();}if (s == 'Dalam Kota') {$('.dalam_kota').attr('disabled', '');$('.dalam_kota').show();}if (s == 'Luar Kota') {$('.luar_kota').attr('disabled', '');$('.luar_kota').show();}if (s == 'Luar Negeri') {$('.luar_negeri').attr('disabled', '');$('.luar_negeri').show();}});</script>
<td>Status Customer</td><td><?=form_dropdown('customer__status', array('Agen' => 'Agen', 'Cabang' => 'Cabang', 'Dalam Kota' => 'Dalam Kota', 'Luar Kota' => 'Luar Kota', 'Luar Negeri' => 'Luar Negeri', ), $customer__status, 'id="customer__status" class="basic"');?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#customer__rating').change(function() { $('.small').attr('disabled', 'disabled');$('.small').hide();$('.medium').attr('disabled', 'disabled');$('.medium').hide();$('.big').attr('disabled', 'disabled');$('.big').hide();var s = $("#customer__rating option:selected").text();if (s == 'Small') {$('.small').attr('disabled', '');$('.small').show();}if (s == 'Medium') {$('.medium').attr('disabled', '');$('.medium').show();}if (s == 'Big') {$('.big').attr('disabled', '');$('.big').show();}});$('.small').attr('disabled', 'disabled');$('.small').hide();$('.medium').attr('disabled', 'disabled');$('.medium').hide();$('.big').attr('disabled', 'disabled');$('.big').hide();var s = $("#customer__rating option:selected").text();if (s == 'Small') {$('.small').attr('disabled', '');$('.small').show();}if (s == 'Medium') {$('.medium').attr('disabled', '');$('.medium').show();}if (s == 'Big') {$('.big').attr('disabled', '');$('.big').show();}});</script>
<td>Company Rating</td><td><?=form_dropdown('customer__rating', array('Small' => 'Small', 'Medium' => 'Medium', 'Big' => 'Big', ), $customer__rating, 'id="customer__rating" class="basic"');?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/customerlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


