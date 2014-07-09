<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#supplier_3output',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#supplier_3editform').click(function(){$('#supplier_3editform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Supplier 3</h3>

<p>
<div id="supplier_3output"></div>
</p>

<form method="post" action="<?=site_url();?>/supplier_3edit/submit" id="supplier_3editform" class="editform">

<?=form_hidden("supplier_3_id", $supplier_3_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Supplier ID *</td><td><?=form_input(array('name' => 'supplier__idstring', 'value' => $supplier__idstring, 'id' => 'supplier__idstring'));?></td></tr><tr class='basic'>
<td>First Name *</td><td><?=form_input(array('name' => 'supplier__firstname', 'value' => $supplier__firstname, 'id' => 'supplier__firstname'));?></td></tr><tr class='basic'>
<td>Last Name</td><td><?=form_input(array('name' => 'supplier__lastname', 'value' => $supplier__lastname, 'id' => 'supplier__lastname'));?></td></tr><tr class='basic'>
<td>Address</td><td><?=form_textarea(array('name' => 'supplier__address', 'value' => $supplier__address, 'id' => 'supplier__address'));?></td></tr><tr class='basic'>
<td>Phone</td><td><?=form_input(array('name' => 'supplier__phone', 'value' => $supplier__phone, 'id' => 'supplier__phone'));?></td></tr><tr class='basic'>
<td>Fax</td><td><?=form_input(array('name' => 'supplier__fax', 'value' => $supplier__fax, 'id' => 'supplier__fax'));?></td></tr><tr class='basic'>
<td>NPWP</td><td><?=form_input(array('name' => 'supplier__npwp', 'value' => $supplier__npwp, 'id' => 'supplier__npwp'));?></td></tr><tr class='basic'>
<td>Email</td><td><?=form_input(array('name' => 'supplier__email', 'value' => $supplier__email, 'id' => 'supplier__email'));?></td></tr><tr class='basic'>
<td>Firm Type</td><td><?=form_input(array('name' => 'supplier__firmtype', 'value' => $supplier__firmtype, 'id' => 'supplier__firmtype'));?></td></tr><tr class='basic'>
<td>Contact Person</td><td><?=form_input(array('name' => 'supplier__contactperson', 'value' => $supplier__contactperson, 'id' => 'supplier__contactperson'));?></td></tr><tr class='basic'>
<td>HP Contact Person</td><td><?=form_input(array('name' => 'supplier__hpcontactperson', 'value' => $supplier__hpcontactperson, 'id' => 'supplier__hpcontactperson'));?></td></tr><tr class='basic'>
<td>Barang</td><td><?=form_input(array('name' => 'supplier__barang', 'value' => $supplier__barang, 'id' => 'supplier__barang'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#supplier__top').change(function() { $('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#supplier__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});$('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#supplier__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});</script>
<td>Default Payment Term</td><td><?=form_dropdown('supplier__top', array('Cash' => 'Cash', '30 Days' => '30 Days', '60 Days' => '60 Days', ), $supplier__top, 'id="supplier__top" class="basic"');?></td></tr><tr class='basic'>
<td>Default Currency</td><td><?=form_dropdown('supplier__currency_id', $currency_opt, $supplier__currency_id);?>&nbsp;<input id='supplier__currency_id_lookup' type='button' value='Lookup'></input></td><div id='supplier__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#supplier__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#supplier__currency_id_dialog').html(data);$('#supplier__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=supplier__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=supplier__currency_id]').val(lines[0]);if (typeof window.supplier_3_selected_currency_id == 'function') { supplier_3_selected_currency_id("<?=site_url();?>"); }}$('#supplier__currency_id_dialog').dialog('close');});$('#supplier__currency_id_lookup').button().click(function() {$('#supplier__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Company Rating</td><td><?=form_input(array('name' => 'supplier__rating', 'value' => $supplier__rating, 'id' => 'supplier__rating'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/supplier_3list";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


