<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#permintaan_stock_chemical_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#permintaan_stock_chemical_lineform').click(function(){$('#permintaan_stock_chemical_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Permintaan Stock Chemical Line</h3>

<p>
<div id="permintaan_stock_chemical_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/permintaan_stock_chemical_lineadd/submit" id="permintaan_stock_chemical_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('permintaanstockchemical_id', $permintaanstockchemical_id);?>
<tr class='basic'>
<?=form_hidden('permintaanstockchemicalline__idstring', $permintaanstockchemicalline__idstring);?></tr>
<tr class='basic'>
<?=form_hidden('permintaanstockchemicalline__date', $permintaanstockchemicalline__date);?></tr>
<tr class='basic'>
<?=form_hidden('permintaanstockchemicalline__notes', $permintaanstockchemicalline__notes);?></tr>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('permintaanstockchemicalline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='permintaanstockchemicalline__item_id_lookup' type='button' value='Lookup'></input></td><div id='permintaanstockchemicalline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#permintaanstockchemicalline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#permintaanstockchemicalline__item_id_dialog').html(data);$('#permintaanstockchemicalline__item_id_dialog a').attr('disabled', 'disabled');$('#permintaanstockchemicalline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=permintaanstockchemicalline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=permintaanstockchemicalline__item_id]').val(lines[0]);if (typeof window.permintaan_stock_chemical_line_selected_item_id == 'function') { permintaan_stock_chemical_line_selected_item_id("<?=site_url();?>"); }}$('#permintaanstockchemicalline__item_id_dialog').dialog('close');});$('#permintaanstockchemicalline__item_id_lookup').button().click(function() {$('#permintaanstockchemicalline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'permintaanstockchemicalline__quantity', 'value' => $permintaanstockchemicalline__quantity, 'class' => 'basic', 'id' => 'permintaanstockchemicalline__quantity'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('permintaanstockchemicalline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='permintaanstockchemicalline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='permintaanstockchemicalline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#permintaanstockchemicalline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#permintaanstockchemicalline__uom_id_dialog').html(data);$('#permintaanstockchemicalline__uom_id_dialog a').attr('disabled', 'disabled');$('#permintaanstockchemicalline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=permintaanstockchemicalline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=permintaanstockchemicalline__uom_id]').val(lines[0]);if (typeof window.permintaan_stock_chemical_line_selected_uom_id == 'function') { permintaan_stock_chemical_line_selected_uom_id("<?=site_url();?>"); }}$('#permintaanstockchemicalline__uom_id_dialog').dialog('close');});$('#permintaanstockchemicalline__uom_id_lookup').button().click(function() {$('#permintaanstockchemicalline__uom_id_dialog').dialog('open');});});});</script></tr>
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
