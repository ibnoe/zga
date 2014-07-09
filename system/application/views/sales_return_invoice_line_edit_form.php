<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_return_invoice_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_return_invoice_lineeditform').click(function(){$('#sales_return_invoice_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Return Invoice Line</h3>

<p>
<div id="sales_return_invoice_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_invoice_lineedit/submit" id="sales_return_invoice_lineeditform" class="editform">

<?=form_hidden("sales_return_invoice_line_id", $sales_return_invoice_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Item *</td><td><?=form_dropdown('salesreturninvoiceline__item_id', $item_opt, $salesreturninvoiceline__item_id);?>&nbsp;<input id='salesreturninvoiceline__item_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturninvoiceline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturninvoiceline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#salesreturninvoiceline__item_id_dialog').html(data);$('#salesreturninvoiceline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=salesreturninvoiceline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturninvoiceline__item_id]').val(lines[0]);$('#salesreturninvoiceline__item_id_dialog').dialog('close');});$('#salesreturninvoiceline__item_id_lookup').button().click(function() {$('#salesreturninvoiceline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'salesreturninvoiceline__quantity', 'value' => $salesreturninvoiceline__quantity, 'id' => 'salesreturninvoiceline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('salesreturninvoiceline__uom_id', $uom_opt, $salesreturninvoiceline__uom_id);?>&nbsp;<input id='salesreturninvoiceline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturninvoiceline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturninvoiceline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#salesreturninvoiceline__uom_id_dialog').html(data);$('#salesreturninvoiceline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=salesreturninvoiceline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesreturninvoiceline__uom_id]').val(lines[0]);$('#salesreturninvoiceline__uom_id_dialog').dialog('close');});$('#salesreturninvoiceline__uom_id_lookup').button().click(function() {$('#salesreturninvoiceline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Price *</td><td><?=form_input(array('name' => 'salesreturninvoiceline__price', 'value' => $salesreturninvoiceline__price, 'id' => 'salesreturninvoiceline__price'));?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=form_input(array('name' => 'salesreturninvoiceline__subtotal', 'value' => $salesreturninvoiceline__subtotal, 'id' => 'salesreturninvoiceline__subtotal'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_invoice_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


