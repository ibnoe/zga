<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_invoice_line_viewoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#purchase_invoice_line_viewform').click(function(){$('#purchase_invoice_line_viewform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Invoice Line View</h3>

<p>
<div id="purchase_invoice_line_viewoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_invoice_line_viewadd/submit" id="purchase_invoice_line_viewform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('purchaseinvoice_id', $purchaseinvoice_id);?>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('purchaseinvoiceline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchaseinvoiceline__item_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseinvoiceline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseinvoiceline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#purchaseinvoiceline__item_id_dialog').html(data);$('#purchaseinvoiceline__item_id_dialog a').attr('disabled', 'disabled');$('#purchaseinvoiceline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=purchaseinvoiceline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchaseinvoiceline__item_id]').val(lines[0]);$('#purchaseinvoiceline__item_id_dialog').dialog('close');});$('#purchaseinvoiceline__item_id_lookup').button().click(function() {$('#purchaseinvoiceline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'purchaseinvoiceline__quantity', 'value' => $purchaseinvoiceline__quantity, 'class' => 'basic', 'id' => 'purchaseinvoiceline__quantity'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('purchaseinvoiceline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchaseinvoiceline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseinvoiceline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseinvoiceline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#purchaseinvoiceline__uom_id_dialog').html(data);$('#purchaseinvoiceline__uom_id_dialog a').attr('disabled', 'disabled');$('#purchaseinvoiceline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=purchaseinvoiceline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchaseinvoiceline__uom_id]').val(lines[0]);$('#purchaseinvoiceline__uom_id_dialog').dialog('close');});$('#purchaseinvoiceline__uom_id_lookup').button().click(function() {$('#purchaseinvoiceline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Price *</td>
<td><?=form_input(array('name' => 'purchaseinvoiceline__price', 'value' => $purchaseinvoiceline__price, 'class' => 'basic', 'id' => 'purchaseinvoiceline__price'));?></td></tr>
<tr class='basic'>
<?=form_hidden('purchaseinvoiceline__purchaseorderline_id', $purchaseinvoiceline__purchaseorderline_id);?></tr>
<tr class='basic'>
<?=form_hidden('purchaseinvoiceline__subtotal', $purchaseinvoiceline__subtotal);?></tr>
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
