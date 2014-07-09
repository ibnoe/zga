<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#surat_pengajuan_repair_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#surat_pengajuan_repair_lineform').click(function(){$('#surat_pengajuan_repair_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Surat Pengajuan Repair Line</h3>

<p>
<div id="surat_pengajuan_repair_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/surat_pengajuan_repair_lineadd/submit" id="surat_pengajuan_repair_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('suratpengajuanrepair_id', $suratpengajuanrepair_id);?>
<tr class='basic'>
<td>No Diss *</td>
<td><?=form_input(array('name' => 'suratpengajuanrepairline__nodiss', 'value' => $suratpengajuanrepairline__nodiss, 'class' => 'basic', 'id' => 'suratpengajuanrepairline__nodiss'));?></td></tr>
<tr class='basic'>
<td>Barang *</td>
<td><?=form_dropdown('suratpengajuanrepairline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='suratpengajuanrepairline__item_id_lookup' type='button' value='Lookup'></input></td><div id='suratpengajuanrepairline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#suratpengajuanrepairline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#suratpengajuanrepairline__item_id_dialog').html(data);$('#suratpengajuanrepairline__item_id_dialog a').attr('disabled', 'disabled');$('#suratpengajuanrepairline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=suratpengajuanrepairline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=suratpengajuanrepairline__item_id]').val(lines[0]);if (typeof window.surat_pengajuan_repair_line_selected_item_id == 'function') { surat_pengajuan_repair_line_selected_item_id("<?=site_url();?>"); }}$('#suratpengajuanrepairline__item_id_dialog').dialog('close');});$('#suratpengajuanrepairline__item_id_lookup').button().click(function() {$('#suratpengajuanrepairline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Customer *</td>
<td><?=form_dropdown('suratpengajuanrepairline__customer_id', array(), '', 'class="basic"');?>&nbsp;<input id='suratpengajuanrepairline__customer_id_lookup' type='button' value='Lookup'></input></td><div id='suratpengajuanrepairline__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#suratpengajuanrepairline__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#suratpengajuanrepairline__customer_id_dialog').html(data);$('#suratpengajuanrepairline__customer_id_dialog a').attr('disabled', 'disabled');$('#suratpengajuanrepairline__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=suratpengajuanrepairline__customer_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=suratpengajuanrepairline__customer_id]').val(lines[0]);if (typeof window.surat_pengajuan_repair_line_selected_customer_id == 'function') { surat_pengajuan_repair_line_selected_customer_id("<?=site_url();?>"); }}$('#suratpengajuanrepairline__customer_id_dialog').dialog('close');});$('#suratpengajuanrepairline__customer_id_lookup').button().click(function() {$('#suratpengajuanrepairline__customer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Mesin</td>
<td><?=form_dropdown('suratpengajuanrepairline__mesin_id', array(), '', 'class="basic"');?>&nbsp;<input id='suratpengajuanrepairline__mesin_id_lookup' type='button' value='Lookup'></input></td><div id='suratpengajuanrepairline__mesin_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#suratpengajuanrepairline__mesin_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/mesinlookup', function(data) { $('#suratpengajuanrepairline__mesin_id_dialog').html(data);$('#suratpengajuanrepairline__mesin_id_dialog a').attr('disabled', 'disabled');$('#suratpengajuanrepairline__mesin_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=suratpengajuanrepairline__mesin_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=suratpengajuanrepairline__mesin_id]').val(lines[0]);if (typeof window.surat_pengajuan_repair_line_selected_mesin_id == 'function') { surat_pengajuan_repair_line_selected_mesin_id("<?=site_url();?>"); }}$('#suratpengajuanrepairline__mesin_id_dialog').dialog('close');});$('#suratpengajuanrepairline__mesin_id_lookup').button().click(function() {$('#suratpengajuanrepairline__mesin_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Tipe Core</td>
<td><?=form_input(array('name' => 'suratpengajuanrepairline__tipecore', 'value' => $suratpengajuanrepairline__tipecore, 'class' => 'basic', 'id' => 'suratpengajuanrepairline__tipecore'));?></td></tr>
<tr class='basic'>
<td>Roll Diameter</td>
<td><?=form_input(array('name' => 'suratpengajuanrepairline__rolldiameter', 'value' => $suratpengajuanrepairline__rolldiameter, 'class' => 'basic', 'id' => 'suratpengajuanrepairline__rolldiameter'));?></td></tr>
<tr class='basic'>
<td>Bearing Seat Diameter</td>
<td><?=form_input(array('name' => 'suratpengajuanrepairline__bearingseatdiameter', 'value' => $suratpengajuanrepairline__bearingseatdiameter, 'class' => 'basic', 'id' => 'suratpengajuanrepairline__bearingseatdiameter'));?></td></tr>
<tr class='basic'>
<td>Total Length (TL)</td>
<td><?=form_input(array('name' => 'suratpengajuanrepairline__totallength', 'value' => $suratpengajuanrepairline__totallength, 'class' => 'basic', 'id' => 'suratpengajuanrepairline__totallength'));?></td></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'suratpengajuanrepairline__quantity', 'value' => $suratpengajuanrepairline__quantity, 'class' => 'basic', 'id' => 'suratpengajuanrepairline__quantity'));?></td></tr>
<tr class='basic'>
<td>Jenis Repair</td>
<td><?=form_input(array('name' => 'suratpengajuanrepairline__jenisrepair', 'value' => $suratpengajuanrepairline__jenisrepair, 'class' => 'basic', 'id' => 'suratpengajuanrepairline__jenisrepair'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'suratpengajuanrepairline__notes', 'value' => $suratpengajuanrepairline__notes, 'class' => 'basic', 'id' => 'suratpengajuanrepairline__notes'));?></td></tr>
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
