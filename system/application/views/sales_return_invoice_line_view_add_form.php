<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_return_invoice_line_viewoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#sales_return_invoice_line_viewform').click(function(){$('#sales_return_invoice_line_viewform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Return Invoice Line View</h3>

<p>
<div id="sales_return_invoice_line_viewoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_invoice_line_viewadd/submit" id="sales_return_invoice_line_viewform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('salesreturninvoice_id', $salesreturninvoice_id);?>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('salesreturninvoiceline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesreturninvoiceline__item_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturninvoiceline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturninvoiceline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#salesreturninvoiceline__item_id_dialog').html(data);$('#salesreturninvoiceline__item_id_dialog a').attr('disabled', 'disabled');$('#salesreturninvoiceline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=salesreturninvoiceline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturninvoiceline__item_id]').val(lines[0]);$('#salesreturninvoiceline__item_id_dialog').dialog('close');});$('#salesreturninvoiceline__item_id_lookup').button().click(function() {$('#salesreturninvoiceline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'salesreturninvoiceline__quantity', 'value' => $salesreturninvoiceline__quantity, 'class' => 'basic', 'id' => 'salesreturninvoiceline__quantity'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('salesreturninvoiceline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesreturninvoiceline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturninvoiceline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturninvoiceline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#salesreturninvoiceline__uom_id_dialog').html(data);$('#salesreturninvoiceline__uom_id_dialog a').attr('disabled', 'disabled');$('#salesreturninvoiceline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=salesreturninvoiceline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesreturninvoiceline__uom_id]').val(lines[0]);$('#salesreturninvoiceline__uom_id_dialog').dialog('close');});$('#salesreturninvoiceline__uom_id_lookup').button().click(function() {$('#salesreturninvoiceline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Price *</td>
<td><?=form_input(array('name' => 'salesreturninvoiceline__price', 'value' => $salesreturninvoiceline__price, 'class' => 'basic', 'id' => 'salesreturninvoiceline__price'));?></td></tr>
<tr class='basic'>
<?=form_hidden('salesreturninvoiceline__salesreturnorderline_id', $salesreturninvoiceline__salesreturnorderline_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesreturninvoiceline__subtotal', $salesreturninvoiceline__subtotal);?></tr>
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
