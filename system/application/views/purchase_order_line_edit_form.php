<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_order_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_order_lineeditform').click(function(){$('#purchase_order_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Order Line</h3>

<p>
<div id="purchase_order_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_order_lineedit/submit" id="purchase_order_lineeditform" class="editform">

<?=form_hidden("purchase_order_line_id", $purchase_order_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'>
<td>Item *</td><td><?=form_dropdown('purchaseorderline__item_id', $item_opt, $purchaseorderline__item_id);?>&nbsp;<input id='purchaseorderline__item_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseorderline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseorderline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/purchaseable_itemlookup', function(data) { $('#purchaseorderline__item_id_dialog').html(data);$('#purchaseorderline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchaseorderline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchaseorderline__item_id]').val(lines[0]);if (typeof window.purchase_order_line_selected_item_id == 'function') { purchase_order_line_selected_item_id("<?=site_url();?>"); }}$('#purchaseorderline__item_id_dialog').dialog('close');});$('#purchaseorderline__item_id_lookup').button().click(function() {$('#purchaseorderline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Ship To Location *</td><td><?=form_dropdown('purchaseorderline__warehouse_id', $warehouse_opt, $purchaseorderline__warehouse_id);?>&nbsp;<input id='purchaseorderline__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseorderline__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseorderline__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#purchaseorderline__warehouse_id_dialog').html(data);$('#purchaseorderline__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchaseorderline__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchaseorderline__warehouse_id]').val(lines[0]);if (typeof window.purchase_order_line_selected_warehouse_id == 'function') { purchase_order_line_selected_warehouse_id("<?=site_url();?>"); }}$('#purchaseorderline__warehouse_id_dialog').dialog('close');});$('#purchaseorderline__warehouse_id_lookup').button().click(function() {$('#purchaseorderline__warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'purchaseorderline__quantity', 'value' => $purchaseorderline__quantity, 'id' => 'purchaseorderline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('purchaseorderline__uom_id', $uom_opt, $purchaseorderline__uom_id);?>&nbsp;<input id='purchaseorderline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseorderline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseorderline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#purchaseorderline__uom_id_dialog').html(data);$('#purchaseorderline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchaseorderline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchaseorderline__uom_id]').val(lines[0]);if (typeof window.purchase_order_line_selected_uom_id == 'function') { purchase_order_line_selected_uom_id("<?=site_url();?>"); }}$('#purchaseorderline__uom_id_dialog').dialog('close');});$('#purchaseorderline__uom_id_lookup').button().click(function() {$('#purchaseorderline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Price *</td><td><?=form_input(array('name' => 'purchaseorderline__price', 'value' => $purchaseorderline__price, 'id' => 'purchaseorderline__price'));?></td></tr><tr class='basic'>
<td>PPN?</td><td><input type='checkbox' name='purchaseorderline__hasppn' value='1' <?php if ($purchaseorderline__hasppn > 0) echo "checked='checked'"; else echo '';?> ></input></td></tr><tr class='basic'>
<td>PPH %</td><td><?=form_input(array('name' => 'purchaseorderline__pph', 'value' => $purchaseorderline__pph, 'id' => 'purchaseorderline__pph'));?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=form_input(array('name' => 'purchaseorderline__subtotal', 'value' => $purchaseorderline__subtotal, 'id' => 'purchaseorderline__subtotal'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_order_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


