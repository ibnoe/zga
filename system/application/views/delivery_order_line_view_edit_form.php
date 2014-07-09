<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#delivery_order_line_viewoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#delivery_order_line_vieweditform').click(function(){$('#delivery_order_line_vieweditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Delivery Order Line View</h3>

<p>
<div id="delivery_order_line_viewoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/delivery_order_line_viewedit/submit" id="delivery_order_line_vieweditform" class="editform">

<?=form_hidden("delivery_order_line_view_id", $delivery_order_line_view_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Item *</td><td><?=form_dropdown('deliveryorderline__item_id', $item_opt, $deliveryorderline__item_id);?>&nbsp;<input id='deliveryorderline__item_id_lookup' type='button' value='Lookup'></input></td><div id='deliveryorderline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#deliveryorderline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#deliveryorderline__item_id_dialog').html(data);$('#deliveryorderline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=deliveryorderline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=deliveryorderline__item_id]').val(lines[0]);if (typeof window.delivery_order_line_view_selected_item_id == 'function') { delivery_order_line_view_selected_item_id("<?=site_url();?>"); }}$('#deliveryorderline__item_id_dialog').dialog('close');});$('#deliveryorderline__item_id_lookup').button().click(function() {$('#deliveryorderline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'deliveryorderline__quantitytosend', 'value' => $deliveryorderline__quantitytosend, 'id' => 'deliveryorderline__quantitytosend'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('deliveryorderline__uom_id', $uom_opt, $deliveryorderline__uom_id);?>&nbsp;<input id='deliveryorderline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='deliveryorderline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#deliveryorderline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#deliveryorderline__uom_id_dialog').html(data);$('#deliveryorderline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=deliveryorderline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=deliveryorderline__uom_id]').val(lines[0]);if (typeof window.delivery_order_line_view_selected_uom_id == 'function') { delivery_order_line_view_selected_uom_id("<?=site_url();?>"); }}$('#deliveryorderline__uom_id_dialog').dialog('close');});$('#deliveryorderline__uom_id_lookup').button().click(function() {$('#deliveryorderline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/delivery_order_line_viewlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


