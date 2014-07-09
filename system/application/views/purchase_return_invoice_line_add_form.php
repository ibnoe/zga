<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_invoice_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/purchase_return_invoice_lineview/index/' },
		}; 
		
		$('#purchase_return_invoice_lineform').click(function(){$('#purchase_return_invoice_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Invoice Line</h3>

<p>
<div id="purchase_return_invoice_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_invoice_lineadd/submit" id="purchase_return_invoice_lineform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('purchasereturninvoiceline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasereturninvoiceline__item_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturninvoiceline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturninvoiceline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#purchasereturninvoiceline__item_id_dialog').html(data);$('#purchasereturninvoiceline__item_id_dialog a').attr('disabled', 'disabled');$('#purchasereturninvoiceline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=purchasereturninvoiceline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturninvoiceline__item_id]').val(lines[0]);$('#purchasereturninvoiceline__item_id_dialog').dialog('close');});$('#purchasereturninvoiceline__item_id_lookup').button().click(function() {$('#purchasereturninvoiceline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<?=form_hidden('purchasereturninvoiceline__quantity', $purchasereturninvoiceline__quantity);?>
<td><?=$purchasereturninvoiceline__quantity;?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('purchasereturninvoiceline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasereturninvoiceline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturninvoiceline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturninvoiceline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#purchasereturninvoiceline__uom_id_dialog').html(data);$('#purchasereturninvoiceline__uom_id_dialog a').attr('disabled', 'disabled');$('#purchasereturninvoiceline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=purchasereturninvoiceline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchasereturninvoiceline__uom_id]').val(lines[0]);$('#purchasereturninvoiceline__uom_id_dialog').dialog('close');});$('#purchasereturninvoiceline__uom_id_lookup').button().click(function() {$('#purchasereturninvoiceline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Price *</td>
<?=form_hidden('purchasereturninvoiceline__price', $purchasereturninvoiceline__price);?>
<td><?=$purchasereturninvoiceline__price;?></td></tr>
<tr class='basic'>
<?=form_hidden('purchasereturninvoiceline__purchasereturnorderline_id', $purchasereturninvoiceline__purchasereturnorderline_id);?></tr>
<tr class='basic'>
<?=form_hidden('purchasereturninvoiceline__subtotal', $purchasereturninvoiceline__subtotal);?></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_return_invoice_linelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
