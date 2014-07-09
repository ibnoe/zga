<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#bill_of_material_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#bill_of_material_lineeditform').click(function(){$('#bill_of_material_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Bill Of Material Line</h3>

<p>
<div id="bill_of_material_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/bill_of_material_lineedit/submit" id="bill_of_material_lineeditform" class="editform">

<?=form_hidden("bill_of_material_line_id", $bill_of_material_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Item *</td><td><?=form_dropdown('bomline__item_id', $item_opt, $bomline__item_id);?>&nbsp;<input id='bomline__item_id_lookup' type='button' value='Lookup'></input></td><div id='bomline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#bomline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#bomline__item_id_dialog').html(data);$('#bomline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=bomline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=bomline__item_id]').val(lines[0]);if (typeof window.bill_of_material_line_selected_item_id == 'function') { bill_of_material_line_selected_item_id("<?=site_url();?>"); }}$('#bomline__item_id_dialog').dialog('close');});$('#bomline__item_id_lookup').button().click(function() {$('#bomline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'bomline__quantity', 'value' => $bomline__quantity, 'id' => 'bomline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('bomline__uom_id', $uom_opt, $bomline__uom_id);?>&nbsp;<input id='bomline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='bomline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#bomline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#bomline__uom_id_dialog').html(data);$('#bomline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=bomline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=bomline__uom_id]').val(lines[0]);if (typeof window.bill_of_material_line_selected_uom_id == 'function') { bill_of_material_line_selected_uom_id("<?=site_url();?>"); }}$('#bomline__uom_id_dialog').dialog('close');});$('#bomline__uom_id_lookup').button().click(function() {$('#bomline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bill_of_material_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


