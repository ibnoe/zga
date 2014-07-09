<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#packing_unitoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#packing_uniteditform').click(function(){$('#packing_uniteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Packing Unit</h3>

<p>
<div id="packing_unitoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/packing_unitedit/submit" id="packing_uniteditform" class="editform">

<?=form_hidden("packing_unit_id", $packing_unit_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Name *</td><td><?=form_input(array('name' => 'packingunit__name', 'value' => $packingunit__name, 'id' => 'packingunit__name'));?></td></tr><tr class='basic'>
<td>Ratio</td><td><?=form_input(array('name' => 'packingunit__ratio', 'value' => $packingunit__ratio, 'id' => 'packingunit__ratio'));?></td></tr><tr class='basic'>
<td>Uom *</td><td><?=form_dropdown('packingunit__uom_id', $uom_opt, $packingunit__uom_id);?>&nbsp;<input id='packingunit__uom_id_lookup' type='button' value='Lookup'></input></td><div id='packingunit__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#packingunit__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#packingunit__uom_id_dialog').html(data);$('#packingunit__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=packingunit__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=packingunit__uom_id]').val(lines[0]);if (typeof window.packing_unit_selected_uom_id == 'function') { packing_unit_selected_uom_id("<?=site_url();?>"); }}$('#packingunit__uom_id_dialog').dialog('close');});$('#packingunit__uom_id_lookup').button().click(function() {$('#packingunit__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/packing_unitlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


