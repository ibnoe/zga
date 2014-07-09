<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#giro_inoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/giro_inview/index/' },
		}; 
		
		$('#giro_inform').click(function(){$('#giro_inform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Giro In</h3>

<p>
<div id="giro_inoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/giro_inadd/submit" id="giro_inform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Giro ID *</td>
<td><?=form_input(array('name' => 'giroin__giroinid', 'value' => $giroin__giroinid, 'class' => 'basic', 'id' => 'giroin__giroinid'));?></td></tr>
<tr class='basic'>
<td>Creation Date *</td><script type="text/javascript">$(document).ready(function() {$(".giroin__createdatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'giroin__createdate', 'value' => $giroin__createdate, 'class' => 'giroin__createdatebasic'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<td><?=form_dropdown('giroin__customer_id', array(), '', 'class="basic"');?>&nbsp;<input id='giroin__customer_id_lookup' type='button' value='Lookup'></input></td><div id='giroin__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#giroin__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#giroin__customer_id_dialog').html(data);$('#giroin__customer_id_dialog a').attr('disabled', 'disabled');$('#giroin__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=giroin__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=giroin__customer_id]').val(lines[0]);if (typeof window.giro_in_selected_customer_id == 'function') { giro_in_selected_customer_id("<?=site_url();?>"); }}$('#giroin__customer_id_dialog').dialog('close');});$('#giroin__customer_id_lookup').button().click(function() {$('#giroin__customer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Currency *</td>
<td><?=form_dropdown('giroin__currency_id', array(), '', 'class="basic"');?>&nbsp;<input id='giroin__currency_id_lookup' type='button' value='Lookup'></input></td><div id='giroin__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#giroin__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#giroin__currency_id_dialog').html(data);$('#giroin__currency_id_dialog a').attr('disabled', 'disabled');$('#giroin__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=giroin__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=giroin__currency_id]').val(lines[0]);if (typeof window.giro_in_selected_currency_id == 'function') { giro_in_selected_currency_id("<?=site_url();?>"); }}$('#giroin__currency_id_dialog').dialog('close');});$('#giroin__currency_id_lookup').button().click(function() {$('#giroin__currency_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Amount</td>
<td><?=form_input(array('name' => 'giroin__amount', 'value' => $giroin__amount, 'class' => 'basic', 'id' => 'giroin__amount'));?></td></tr>
<tr class='basic'>
<td>Account *</td>
<td><?=form_dropdown('giroin__coa_id', array(), '', 'class="basic"');?>&nbsp;<input id='giroin__coa_id_lookup' type='button' value='Lookup'></input></td><div id='giroin__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#giroin__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#giroin__coa_id_dialog').html(data);$('#giroin__coa_id_dialog a').attr('disabled', 'disabled');$('#giroin__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=giroin__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=giroin__coa_id]').val(lines[0]);if (typeof window.giro_in_selected_coa_id == 'function') { giro_in_selected_coa_id("<?=site_url();?>"); }}$('#giroin__coa_id_dialog').dialog('close');});$('#giroin__coa_id_lookup').button().click(function() {$('#giroin__coa_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'giroin__notes', 'value' => $giroin__notes, 'class' => 'basic', 'id' => 'giroin__notes'));?></td></tr>
<tr class='basic'>
<td>Used</td>
<td><input type='checkbox' name='giroin__usedflag' value='1'></input></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/giro_inlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
