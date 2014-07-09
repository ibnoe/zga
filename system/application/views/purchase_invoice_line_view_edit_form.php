<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#purchase_invoice_line_viewoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#purchase_invoice_line_vieweditform').click(function(){$('#purchase_invoice_line_vieweditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Purchase Invoice Line View</h3>

<p>
<div id="purchase_invoice_line_viewoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_invoice_line_viewedit/submit" id="purchase_invoice_line_vieweditform" class="editform">

<?=form_hidden("purchase_invoice_line_view_id", $purchase_invoice_line_view_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Item *</td><td><?=form_dropdown('purchaseinvoiceline__item_id', $item_opt, $purchaseinvoiceline__item_id);?>&nbsp;<input id='purchaseinvoiceline__item_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseinvoiceline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseinvoiceline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#purchaseinvoiceline__item_id_dialog').html(data);$('#purchaseinvoiceline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=purchaseinvoiceline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchaseinvoiceline__item_id]').val(lines[0]);$('#purchaseinvoiceline__item_id_dialog').dialog('close');});$('#purchaseinvoiceline__item_id_lookup').button().click(function() {$('#purchaseinvoiceline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'purchaseinvoiceline__quantity', 'value' => $purchaseinvoiceline__quantity, 'id' => 'purchaseinvoiceline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('purchaseinvoiceline__uom_id', $uom_opt, $purchaseinvoiceline__uom_id);?>&nbsp;<input id='purchaseinvoiceline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='purchaseinvoiceline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchaseinvoiceline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#purchaseinvoiceline__uom_id_dialog').html(data);$('#purchaseinvoiceline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=purchaseinvoiceline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchaseinvoiceline__uom_id]').val(lines[0]);$('#purchaseinvoiceline__uom_id_dialog').dialog('close');});$('#purchaseinvoiceline__uom_id_lookup').button().click(function() {$('#purchaseinvoiceline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Price *</td><td><?=form_input(array('name' => 'purchaseinvoiceline__price', 'value' => $purchaseinvoiceline__price, 'id' => 'purchaseinvoiceline__price'));?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=form_input(array('name' => 'purchaseinvoiceline__subtotal', 'value' => $purchaseinvoiceline__subtotal, 'id' => 'purchaseinvoiceline__subtotal'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchase_invoice_line_viewlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


