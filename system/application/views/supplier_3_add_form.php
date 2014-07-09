<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#supplier_3output',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/supplier_3view/index/' },
		}; 
		
		$('#supplier_3form').click(function(){$('#supplier_3form').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Supplier 3</h3>

<p>
<div id="supplier_3output"></div>
</p>

<form method="post" action="<?=site_url();?>/supplier_3add/submit" id="supplier_3form" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Supplier ID *</td>
<td><?=form_input(array('name' => 'supplier__idstring', 'value' => $supplier__idstring, 'class' => 'basic', 'id' => 'supplier__idstring'));?></td></tr>
<tr class='basic'>
<td>First Name *</td>
<td><?=form_input(array('name' => 'supplier__firstname', 'value' => $supplier__firstname, 'class' => 'basic', 'id' => 'supplier__firstname'));?></td></tr>
<tr class='basic'>
<td>Last Name</td>
<td><?=form_input(array('name' => 'supplier__lastname', 'value' => $supplier__lastname, 'class' => 'basic', 'id' => 'supplier__lastname'));?></td></tr>
<tr class='basic'>
<td>Address</td>
<td><?=form_textarea(array('name' => 'supplier__address', 'value' => $supplier__address, 'class' => 'basic', 'id' => 'supplier__address'));?></td></tr>
<tr class='basic'>
<td>Phone</td>
<td><?=form_input(array('name' => 'supplier__phone', 'value' => $supplier__phone, 'class' => 'basic', 'id' => 'supplier__phone'));?></td></tr>
<tr class='basic'>
<td>Fax</td>
<td><?=form_input(array('name' => 'supplier__fax', 'value' => $supplier__fax, 'class' => 'basic', 'id' => 'supplier__fax'));?></td></tr>
<tr class='basic'>
<td>NPWP</td>
<td><?=form_input(array('name' => 'supplier__npwp', 'value' => $supplier__npwp, 'class' => 'basic', 'id' => 'supplier__npwp'));?></td></tr>
<tr class='basic'>
<td>Email</td>
<td><?=form_input(array('name' => 'supplier__email', 'value' => $supplier__email, 'class' => 'basic', 'id' => 'supplier__email'));?></td></tr>
<tr class='basic'>
<td>Firm Type</td>
<td><?=form_input(array('name' => 'supplier__firmtype', 'value' => $supplier__firmtype, 'class' => 'basic', 'id' => 'supplier__firmtype'));?></td></tr>
<tr class='basic'>
<td>Contact Person</td>
<td><?=form_input(array('name' => 'supplier__contactperson', 'value' => $supplier__contactperson, 'class' => 'basic', 'id' => 'supplier__contactperson'));?></td></tr>
<tr class='basic'>
<td>HP Contact Person</td>
<td><?=form_input(array('name' => 'supplier__hpcontactperson', 'value' => $supplier__hpcontactperson, 'class' => 'basic', 'id' => 'supplier__hpcontactperson'));?></td></tr>
<tr class='basic'>
<td>Barang</td>
<td><?=form_input(array('name' => 'supplier__barang', 'value' => $supplier__barang, 'class' => 'basic', 'id' => 'supplier__barang'));?></td></tr>
<tr class='basic'>
<td>Default Payment Term</td><script type="text/javascript">$(document).ready(function() {$('#supplier__top').change(function() { $('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#supplier__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});$('.cash').attr('disabled', 'disabled');$('.cash').hide();$('.30_days').attr('disabled', 'disabled');$('.30_days').hide();$('.60_days').attr('disabled', 'disabled');$('.60_days').hide();var s = $("#supplier__top option:selected").text();if (s == 'Cash') {$('.cash').attr('disabled', '');$('.cash').show();}if (s == '30 Days') {$('.30_days').attr('disabled', '');$('.30_days').show();}if (s == '60 Days') {$('.60_days').attr('disabled', '');$('.60_days').show();}});</script>
<td><?=form_dropdown('supplier__top', array('Cash' => 'Cash', '30 Days' => '30 Days', '60 Days' => '60 Days', ), $supplier__top, 'id="supplier__top" class="basic"');?></td></tr>
<tr class='basic'>
<td>Default Currency</td>
<td><?=form_dropdown('supplier__currency_id', array(), '', 'class="basic"');?>&nbsp;<input id='supplier__currency_id_lookup' type='button' value='Lookup'></input></td><div id='supplier__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#supplier__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#supplier__currency_id_dialog').html(data);$('#supplier__currency_id_dialog a').attr('disabled', 'disabled');$('#supplier__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=supplier__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=supplier__currency_id]').val(lines[0]);if (typeof window.supplier_3_selected_currency_id == 'function') { supplier_3_selected_currency_id("<?=site_url();?>"); }}$('#supplier__currency_id_dialog').dialog('close');});$('#supplier__currency_id_lookup').button().click(function() {$('#supplier__currency_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Company Rating</td>
<td><?=form_input(array('name' => 'supplier__rating', 'value' => $supplier__rating, 'class' => 'basic', 'id' => 'supplier__rating'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/supplier_3list";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
