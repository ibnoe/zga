<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#rolloutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/rollview/index/' },
		}; 
		
		$('#rollform').click(function(){$('#rollform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Roll</h3>

<p>
<div id="rolloutput"></div>
</p>

<form method="post" action="<?=site_url();?>/rolladd/submit" id="rollform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Item ID *</td>
<td><?=form_input(array('name' => 'item__idstring', 'value' => $item__idstring, 'class' => 'basic', 'id' => 'item__idstring'));?></td></tr>
<tr class='basic'>
<td>Name *</td>
<td><?=form_input(array('name' => 'item__name', 'value' => $item__name, 'class' => 'basic', 'id' => 'item__name'));?></td></tr>
<tr class='basic'>
<td>Roll No</td>
<td><?=form_input(array('name' => 'item__rollno', 'value' => $item__rollno, 'class' => 'basic', 'id' => 'item__rollno'));?></td></tr>
<tr class='basic'>
<td>Ink Type</td><script type="text/javascript">$(document).ready(function() {$('#item__inktype').change(function() { $('.standard').attr('disabled', 'disabled');$('.standard').hide();$('.mix').attr('disabled', 'disabled');$('.mix').hide();$('.uv').attr('disabled', 'disabled');$('.uv').hide();var s = $("#item__inktype option:selected").text();if (s == 'Standard') {$('.standard').attr('disabled', '');$('.standard').show();}if (s == 'Mix') {$('.mix').attr('disabled', '');$('.mix').show();}if (s == 'UV') {$('.uv').attr('disabled', '');$('.uv').show();}});$('.standard').attr('disabled', 'disabled');$('.standard').hide();$('.mix').attr('disabled', 'disabled');$('.mix').hide();$('.uv').attr('disabled', 'disabled');$('.uv').hide();var s = $("#item__inktype option:selected").text();if (s == 'Standard') {$('.standard').attr('disabled', '');$('.standard').show();}if (s == 'Mix') {$('.mix').attr('disabled', '');$('.mix').show();}if (s == 'UV') {$('.uv').attr('disabled', '');$('.uv').show();}});</script>
<td><?=form_dropdown('item__inktype', array('Standard' => 'Standard', 'Mix' => 'Mix', 'UV' => 'UV', ), $item__inktype, 'id="item__inktype" class="basic"');?></td></tr>
<tr class='basic'>
<td>Press Type</td>
<td><?=form_input(array('name' => 'item__machinetype', 'value' => $item__machinetype, 'class' => 'basic', 'id' => 'item__machinetype'));?></td></tr>
<tr class='basic'>
<td>Core</td><script type="text/javascript">$(document).ready(function() {$('#item__core').change(function() { $('.used').attr('disabled', 'disabled');$('.used').hide();$('.new').attr('disabled', 'disabled');$('.new').hide();var s = $("#item__core option:selected").text();if (s == 'Used') {$('.used').attr('disabled', '');$('.used').show();}if (s == 'New') {$('.new').attr('disabled', '');$('.new').show();}});$('.used').attr('disabled', 'disabled');$('.used').hide();$('.new').attr('disabled', 'disabled');$('.new').hide();var s = $("#item__core option:selected").text();if (s == 'Used') {$('.used').attr('disabled', '');$('.used').show();}if (s == 'New') {$('.new').attr('disabled', '');$('.new').show();}});</script>
<td><?=form_dropdown('item__core', array('Used' => 'Used', 'New' => 'New', ), $item__core, 'id="item__core" class="basic"');?></td></tr>
<tr class='dimensions'>
<td>Rubber Diameter (RD)</td>
<td><?=form_input(array('name' => 'item__rd', 'value' => $item__rd, 'class' => 'dimensions', 'id' => 'item__rd'));?></td></tr>
<tr class='dimensions'>
<td>Core Diameter (CD)</td>
<td><?=form_input(array('name' => 'item__cd', 'value' => $item__cd, 'class' => 'dimensions', 'id' => 'item__cd'));?></td></tr>
<tr class='dimensions'>
<td>Rubber Length (RL)</td>
<td><?=form_input(array('name' => 'item__rl', 'value' => $item__rl, 'class' => 'dimensions', 'id' => 'item__rl'));?></td></tr>
<tr class='dimensions'>
<td>Working Length (WL)</td>
<td><?=form_input(array('name' => 'item__wl', 'value' => $item__wl, 'class' => 'dimensions', 'id' => 'item__wl'));?></td></tr>
<tr class='dimensions'>
<td>Total Length (TL)</td>
<td><?=form_input(array('name' => 'item__tl', 'value' => $item__tl, 'class' => 'dimensions', 'id' => 'item__tl'));?></td></tr>
<tr class='basic'>
<td>Compound</td>
<td><?=form_input(array('name' => 'item__compound', 'value' => $item__compound, 'class' => 'basic', 'id' => 'item__compound'));?></td></tr>
<tr class='basic'>
<td>Process Scheme</td><script type="text/javascript">$(document).ready(function() {$('#item__processscheme').change(function() { $('.recovering').attr('disabled', 'disabled');$('.recovering').hide();$('.exchange').attr('disabled', 'disabled');$('.exchange').hide();$('.brandnew').attr('disabled', 'disabled');$('.brandnew').hide();var s = $("#item__processscheme option:selected").text();if (s == 'Recovering') {$('.recovering').attr('disabled', '');$('.recovering').show();}if (s == 'Exchange') {$('.exchange').attr('disabled', '');$('.exchange').show();}if (s == 'BrandNew') {$('.brandnew').attr('disabled', '');$('.brandnew').show();}});$('.recovering').attr('disabled', 'disabled');$('.recovering').hide();$('.exchange').attr('disabled', 'disabled');$('.exchange').hide();$('.brandnew').attr('disabled', 'disabled');$('.brandnew').hide();var s = $("#item__processscheme option:selected").text();if (s == 'Recovering') {$('.recovering').attr('disabled', '');$('.recovering').show();}if (s == 'Exchange') {$('.exchange').attr('disabled', '');$('.exchange').show();}if (s == 'BrandNew') {$('.brandnew').attr('disabled', '');$('.brandnew').show();}});</script>
<td><?=form_dropdown('item__processscheme', array('Recovering' => 'Recovering', 'Exchange' => 'Exchange', 'BrandNew' => 'BrandNew', ), $item__processscheme, 'id="item__processscheme" class="basic"');?></td></tr>
<tr class='basic'>
<td>Roller Type</td><script type="text/javascript">$(document).ready(function() {$('#item__rollertype').change(function() { $('.ink_form').attr('disabled', 'disabled');$('.ink_form').hide();$('.dampenig_form').attr('disabled', 'disabled');$('.dampenig_form').hide();var s = $("#item__rollertype option:selected").text();if (s == 'Ink Form') {$('.ink_form').attr('disabled', '');$('.ink_form').show();}if (s == 'Dampenig Form') {$('.dampenig_form').attr('disabled', '');$('.dampenig_form').show();}});$('.ink_form').attr('disabled', 'disabled');$('.ink_form').hide();$('.dampenig_form').attr('disabled', 'disabled');$('.dampenig_form').hide();var s = $("#item__rollertype option:selected").text();if (s == 'Ink Form') {$('.ink_form').attr('disabled', '');$('.ink_form').show();}if (s == 'Dampenig Form') {$('.dampenig_form').attr('disabled', '');$('.dampenig_form').show();}});</script>
<td><?=form_dropdown('item__rollertype', array('Ink Form' => 'Ink Form', 'Dampenig Form' => 'Dampenig Form', ), $item__rollertype, 'id="item__rollertype" class="basic"');?></td></tr>
<tr class='basic'>
<td>Is Accessories</td>
<td><input type='checkbox' name='item__isaccessories' value='1'></input></td></tr>
<tr class='basic'>
<td>Minimum Quantity</td>
<td><?=form_input(array('name' => 'item__minquantity', 'value' => $item__minquantity, 'class' => 'basic', 'id' => 'item__minquantity'));?></td></tr>
<tr class='basic'>
<td>Maximum Quantity</td>
<td><?=form_input(array('name' => 'item__maxquantity', 'value' => $item__maxquantity, 'class' => 'basic', 'id' => 'item__maxquantity'));?></td></tr>
<tr class='brandnew'>
<td>Buffer 3 Months</td>
<td><?=form_input(array('name' => 'item__buffer3months', 'value' => $item__buffer3months, 'class' => 'brandnew', 'id' => 'item__buffer3months'));?></td></tr>
<tr class='basic'>
<?=form_hidden('item__intitemtype', $item__intitemtype);?></tr>
<tr class='basic'>
<?=form_hidden('item__itemcategory_id', $item__itemcategory_id);?></tr>
<tr class='basic'>
<td>Is Purchasable?</td>
<td><input type='checkbox' name='item__purchaseable' value='1'></input></td></tr>
<tr class='basic'>
<td>Is Sellable?</td>
<td><input type='checkbox' name='item__sellable' value='1'></input></td></tr>
<tr class='basic'>
<td>Is Manufactured?</td>
<td><input type='checkbox' name='item__manufactured' value='1'></input></td></tr>
<tr class='basic'>
<td>Account Persediaan *</td>
<td><?=form_dropdown('item__persediaan_coa_id', array(), '', 'class="basic"');?>&nbsp;<input id='item__persediaan_coa_id_lookup' type='button' value='Lookup'></input></td><div id='item__persediaan_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__persediaan_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/inventory_accountslookup', function(data) { $('#item__persediaan_coa_id_dialog').html(data);$('#item__persediaan_coa_id_dialog a').attr('disabled', 'disabled');$('#item__persediaan_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__persediaan_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=item__persediaan_coa_id]').val(lines[0]);if (typeof window.roll_selected_persediaan_coa_id == 'function') { roll_selected_persediaan_coa_id("<?=site_url();?>"); }}$('#item__persediaan_coa_id_dialog').dialog('close');});$('#item__persediaan_coa_id_lookup').button().click(function() {$('#item__persediaan_coa_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Account HPP *</td>
<td><?=form_dropdown('item__hpp_coa_id', array(), '', 'class="basic"');?>&nbsp;<input id='item__hpp_coa_id_lookup' type='button' value='Lookup'></input></td><div id='item__hpp_coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#item__hpp_coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#item__hpp_coa_id_dialog').html(data);$('#item__hpp_coa_id_dialog a').attr('disabled', 'disabled');$('#item__hpp_coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=item__hpp_coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=item__hpp_coa_id]').val(lines[0]);if (typeof window.roll_selected_hpp_coa_id == 'function') { roll_selected_hpp_coa_id("<?=site_url();?>"); }}$('#item__hpp_coa_id_dialog').dialog('close');});$('#item__hpp_coa_id_lookup').button().click(function() {$('#item__hpp_coa_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/rolllist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
