<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#penawaran_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#penawaran_lineeditform').click(function(){$('#penawaran_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Penawaran Line</h3>

<p>
<div id="penawaran_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/penawaran_lineedit/submit" id="penawaran_lineeditform" class="editform">

<?=form_hidden("penawaran_line_id", $penawaran_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$('#salesorderquoteline__type').change(function() { $('.item').attr('disabled', 'disabled');$('.item').hide();var s = $("#salesorderquoteline__type option:selected").text();if (s == 'Item') {$('.item').attr('disabled', '');$('.item').show();}});$('.item').attr('disabled', 'disabled');$('.item').hide();var s = $("#salesorderquoteline__type option:selected").text();if (s == 'Item') {$('.item').attr('disabled', '');$('.item').show();}});</script>
<td>Type</td><td><?=form_dropdown('salesorderquoteline__type', array('Item' => 'Item', ), $salesorderquoteline__type, 'id="salesorderquoteline__type" class="basic"');?></td></tr><tr class='basic'>
<td>Item *</td><td><?=form_dropdown('salesorderquoteline__item_id', $item_opt, $salesorderquoteline__item_id);?>&nbsp;<input id='salesorderquoteline__item_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderquoteline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderquoteline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#salesorderquoteline__item_id_dialog').html(data);$('#salesorderquoteline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorderquoteline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorderquoteline__item_id]').val(lines[0]);if (typeof window.penawaran_line_selected_item_id == 'function') { penawaran_line_selected_item_id("<?=site_url();?>"); }}$('#salesorderquoteline__item_id_dialog').dialog('close');});$('#salesorderquoteline__item_id_lookup').button().click(function() {$('#salesorderquoteline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'salesorderquoteline__quantity', 'value' => $salesorderquoteline__quantity, 'id' => 'salesorderquoteline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('salesorderquoteline__uom_id', $uom_opt, $salesorderquoteline__uom_id);?>&nbsp;<input id='salesorderquoteline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderquoteline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderquoteline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#salesorderquoteline__uom_id_dialog').html(data);$('#salesorderquoteline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorderquoteline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesorderquoteline__uom_id]').val(lines[0]);if (typeof window.penawaran_line_selected_uom_id == 'function') { penawaran_line_selected_uom_id("<?=site_url();?>"); }}$('#salesorderquoteline__uom_id_dialog').dialog('close');});$('#salesorderquoteline__uom_id_lookup').button().click(function() {$('#salesorderquoteline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Price *</td><td><?=form_input(array('name' => 'salesorderquoteline__price', 'value' => $salesorderquoteline__price, 'id' => 'salesorderquoteline__price'));?></td></tr><tr class='basic'>
<td>Disc %</td><td><?=form_input(array('name' => 'salesorderquoteline__pdisc', 'value' => $salesorderquoteline__pdisc, 'id' => 'salesorderquoteline__pdisc'));?></td></tr><tr class='basic'>
<td>SubTotal</td><td><?=form_input(array('name' => 'salesorderquoteline__subtotal', 'value' => $salesorderquoteline__subtotal, 'id' => 'salesorderquoteline__subtotal'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/penawaran_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


