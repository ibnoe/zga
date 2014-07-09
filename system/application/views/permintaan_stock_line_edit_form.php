<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#permintaan_stock_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#permintaan_stock_lineeditform').click(function(){$('#permintaan_stock_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Permintaan Stock Line</h3>

<p>
<div id="permintaan_stock_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/permintaan_stock_lineedit/submit" id="permintaan_stock_lineeditform" class="editform">

<?=form_hidden("permintaan_stock_line_id", $permintaan_stock_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'>
<td>Item *</td><td><?=form_dropdown('permintaanstockline__item_id', $item_opt, $permintaanstockline__item_id);?>&nbsp;<input id='permintaanstockline__item_id_lookup' type='button' value='Lookup'></input></td><div id='permintaanstockline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#permintaanstockline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#permintaanstockline__item_id_dialog').html(data);$('#permintaanstockline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=permintaanstockline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=permintaanstockline__item_id]').val(lines[0]);if (typeof window.permintaan_stock_line_selected_item_id == 'function') { permintaan_stock_line_selected_item_id("<?=site_url();?>"); }}$('#permintaanstockline__item_id_dialog').dialog('close');});$('#permintaanstockline__item_id_lookup').button().click(function() {$('#permintaanstockline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'permintaanstockline__quantity', 'value' => $permintaanstockline__quantity, 'id' => 'permintaanstockline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('permintaanstockline__uom_id', $uom_opt, $permintaanstockline__uom_id);?>&nbsp;<input id='permintaanstockline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='permintaanstockline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#permintaanstockline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#permintaanstockline__uom_id_dialog').html(data);$('#permintaanstockline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=permintaanstockline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=permintaanstockline__uom_id]').val(lines[0]);if (typeof window.permintaan_stock_line_selected_uom_id == 'function') { permintaan_stock_line_selected_uom_id("<?=site_url();?>"); }}$('#permintaanstockline__uom_id_dialog').dialog('close');});$('#permintaanstockline__uom_id_lookup').button().click(function() {$('#permintaanstockline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/permintaan_stock_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


