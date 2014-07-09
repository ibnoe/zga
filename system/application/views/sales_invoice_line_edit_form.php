<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_invoice_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_invoice_lineeditform').click(function(){$('#sales_invoice_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Invoice Line</h3>

<p>
<div id="sales_invoice_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_invoice_lineedit/submit" id="sales_invoice_lineeditform" class="editform">

<?=form_hidden("sales_invoice_line_id", $sales_invoice_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Item *</td><td><?=form_dropdown('salesinvoiceline__item_id', $item_opt, $salesinvoiceline__item_id);?>&nbsp;<input id='salesinvoiceline__item_id_lookup' type='button' value='Lookup'></input></td><div id='salesinvoiceline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesinvoiceline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#salesinvoiceline__item_id_dialog').html(data);$('#salesinvoiceline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=salesinvoiceline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesinvoiceline__item_id]').val(lines[0]);$('#salesinvoiceline__item_id_dialog').dialog('close');});$('#salesinvoiceline__item_id_lookup').button().click(function() {$('#salesinvoiceline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'salesinvoiceline__quantity', 'value' => $salesinvoiceline__quantity, 'id' => 'salesinvoiceline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('salesinvoiceline__uom_id', $uom_opt, $salesinvoiceline__uom_id);?>&nbsp;<input id='salesinvoiceline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='salesinvoiceline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesinvoiceline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#salesinvoiceline__uom_id_dialog').html(data);$('#salesinvoiceline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=salesinvoiceline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesinvoiceline__uom_id]').val(lines[0]);$('#salesinvoiceline__uom_id_dialog').dialog('close');});$('#salesinvoiceline__uom_id_lookup').button().click(function() {$('#salesinvoiceline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Price *</td><td><?=form_input(array('name' => 'salesinvoiceline__price', 'value' => $salesinvoiceline__price, 'id' => 'salesinvoiceline__price'));?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=form_input(array('name' => 'salesinvoiceline__subtotal', 'value' => $salesinvoiceline__subtotal, 'id' => 'salesinvoiceline__subtotal'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_invoice_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


