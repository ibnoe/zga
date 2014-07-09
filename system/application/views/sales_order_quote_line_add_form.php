<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_order_quote_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#sales_order_quote_lineform').click(function(){$('#sales_order_quote_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Order Quote Line</h3>

<p>
<div id="sales_order_quote_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_order_quote_lineadd/submit" id="sales_order_quote_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('salesorder_id', $salesorder_id);?>
<tr class='basic'>
<?=form_hidden('salesorderline__orderid', $salesorderline__orderid);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__date', $salesorderline__date);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__notes', $salesorderline__notes);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__customer_id', $salesorderline__customer_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__currency_id', $salesorderline__currency_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__currencyrate', $salesorderline__currencyrate);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__warehouse_id', $salesorderline__warehouse_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__status', $salesorderline__status);?></tr>
<tr class='basic'>
<td>Type</td><script type="text/javascript">$(document).ready(function() {$('#salesorderline__type').change(function() { $('.item').attr('disabled', 'disabled');$('.item').hide();var s = $("#salesorderline__type option:selected").text();if (s == 'Item') {$('.item').attr('disabled', '');$('.item').show();}});$('.item').attr('disabled', 'disabled');$('.item').hide();var s = $("#salesorderline__type option:selected").text();if (s == 'Item') {$('.item').attr('disabled', '');$('.item').show();}});</script>
<td><?=form_dropdown('salesorderline__type', array('Item' => 'Item', ), $salesorderline__type, 'id="salesorderline__type" class="basic"');?></td></tr>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('salesorderline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorderline__item_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/sellable_itemlookup', function(data) { $('#salesorderline__item_id_dialog').html(data);$('#salesorderline__item_id_dialog a').attr('disabled', 'disabled');$('#salesorderline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorderline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorderline__item_id]').val(lines[0]);if (typeof window.sales_order_quote_line_selected_item_id == 'function') { sales_order_quote_line_selected_item_id("<?=site_url();?>"); }}$('#salesorderline__item_id_dialog').dialog('close');});$('#salesorderline__item_id_lookup').button().click(function() {$('#salesorderline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'salesorderline__quantity', 'value' => $salesorderline__quantity, 'class' => 'basic', 'id' => 'salesorderline__quantity'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('salesorderline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorderline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#salesorderline__uom_id_dialog').html(data);$('#salesorderline__uom_id_dialog a').attr('disabled', 'disabled');$('#salesorderline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorderline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesorderline__uom_id]').val(lines[0]);if (typeof window.sales_order_quote_line_selected_uom_id == 'function') { sales_order_quote_line_selected_uom_id("<?=site_url();?>"); }}$('#salesorderline__uom_id_dialog').dialog('close');});$('#salesorderline__uom_id_lookup').button().click(function() {$('#salesorderline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Price *</td>
<td><?=form_input(array('name' => 'salesorderline__price', 'value' => $salesorderline__price, 'class' => 'basic', 'id' => 'salesorderline__price'));?></td></tr>
<tr class='basic'>
<td>Disc %</td>
<td><?=form_input(array('name' => 'salesorderline__pdisc', 'value' => $salesorderline__pdisc, 'class' => 'basic', 'id' => 'salesorderline__pdisc'));?></td></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__modulename', $salesorderline__modulename);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__subtotal', $salesorderline__subtotal);?></tr>
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
