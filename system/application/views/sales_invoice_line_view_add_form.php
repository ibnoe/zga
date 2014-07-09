<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_invoice_line_viewoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#sales_invoice_line_viewform').click(function(){$('#sales_invoice_line_viewform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Invoice Line View</h3>

<p>
<div id="sales_invoice_line_viewoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_invoice_line_viewadd/submit" id="sales_invoice_line_viewform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('salesinvoice_id', $salesinvoice_id);?>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('salesinvoiceline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesinvoiceline__item_id_lookup' type='button' value='Lookup'></input></td><div id='salesinvoiceline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesinvoiceline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#salesinvoiceline__item_id_dialog').html(data);$('#salesinvoiceline__item_id_dialog a').attr('disabled', 'disabled');$('#salesinvoiceline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=salesinvoiceline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesinvoiceline__item_id]').val(lines[0]);$('#salesinvoiceline__item_id_dialog').dialog('close');});$('#salesinvoiceline__item_id_lookup').button().click(function() {$('#salesinvoiceline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'salesinvoiceline__quantity', 'value' => $salesinvoiceline__quantity, 'class' => 'basic', 'id' => 'salesinvoiceline__quantity'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('salesinvoiceline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesinvoiceline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='salesinvoiceline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesinvoiceline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#salesinvoiceline__uom_id_dialog').html(data);$('#salesinvoiceline__uom_id_dialog a').attr('disabled', 'disabled');$('#salesinvoiceline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=salesinvoiceline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesinvoiceline__uom_id]').val(lines[0]);$('#salesinvoiceline__uom_id_dialog').dialog('close');});$('#salesinvoiceline__uom_id_lookup').button().click(function() {$('#salesinvoiceline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Price *</td>
<td><?=form_input(array('name' => 'salesinvoiceline__price', 'value' => $salesinvoiceline__price, 'class' => 'basic', 'id' => 'salesinvoiceline__price'));?></td></tr>
<tr class='basic'>
<?=form_hidden('salesinvoiceline__salesorderline_id', $salesinvoiceline__salesorderline_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesinvoiceline__subtotal', $salesinvoiceline__subtotal);?></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=$_SERVER['HTTP_REFERER'];?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
