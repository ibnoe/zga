<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#surat_pengajuan_repair_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#surat_pengajuan_repair_lineeditform').click(function(){$('#surat_pengajuan_repair_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Surat Pengajuan Repair Line</h3>

<p>
<div id="surat_pengajuan_repair_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/surat_pengajuan_repair_lineedit/submit" id="surat_pengajuan_repair_lineeditform" class="editform">

<?=form_hidden("surat_pengajuan_repair_line_id", $surat_pengajuan_repair_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>No Diss *</td><td><?=form_input(array('name' => 'suratpengajuanrepairline__nodiss', 'value' => $suratpengajuanrepairline__nodiss, 'id' => 'suratpengajuanrepairline__nodiss'));?></td></tr><tr class='basic'>
<td>Barang *</td><td><?=form_dropdown('suratpengajuanrepairline__item_id', $item_opt, $suratpengajuanrepairline__item_id);?>&nbsp;<input id='suratpengajuanrepairline__item_id_lookup' type='button' value='Lookup'></input></td><div id='suratpengajuanrepairline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#suratpengajuanrepairline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#suratpengajuanrepairline__item_id_dialog').html(data);$('#suratpengajuanrepairline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=suratpengajuanrepairline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=suratpengajuanrepairline__item_id]').val(lines[0]);if (typeof window.surat_pengajuan_repair_line_selected_item_id == 'function') { surat_pengajuan_repair_line_selected_item_id("<?=site_url();?>"); }}$('#suratpengajuanrepairline__item_id_dialog').dialog('close');});$('#suratpengajuanrepairline__item_id_lookup').button().click(function() {$('#suratpengajuanrepairline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('suratpengajuanrepairline__customer_id', $customer_opt, $suratpengajuanrepairline__customer_id);?>&nbsp;<input id='suratpengajuanrepairline__customer_id_lookup' type='button' value='Lookup'></input></td><div id='suratpengajuanrepairline__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#suratpengajuanrepairline__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#suratpengajuanrepairline__customer_id_dialog').html(data);$('#suratpengajuanrepairline__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=suratpengajuanrepairline__customer_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=suratpengajuanrepairline__customer_id]').val(lines[0]);if (typeof window.surat_pengajuan_repair_line_selected_customer_id == 'function') { surat_pengajuan_repair_line_selected_customer_id("<?=site_url();?>"); }}$('#suratpengajuanrepairline__customer_id_dialog').dialog('close');});$('#suratpengajuanrepairline__customer_id_lookup').button().click(function() {$('#suratpengajuanrepairline__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Mesin</td><td><?=form_dropdown('suratpengajuanrepairline__mesin_id', $mesin_opt, $suratpengajuanrepairline__mesin_id);?>&nbsp;<input id='suratpengajuanrepairline__mesin_id_lookup' type='button' value='Lookup'></input></td><div id='suratpengajuanrepairline__mesin_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#suratpengajuanrepairline__mesin_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/mesinlookup', function(data) { $('#suratpengajuanrepairline__mesin_id_dialog').html(data);$('#suratpengajuanrepairline__mesin_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=suratpengajuanrepairline__mesin_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=suratpengajuanrepairline__mesin_id]').val(lines[0]);if (typeof window.surat_pengajuan_repair_line_selected_mesin_id == 'function') { surat_pengajuan_repair_line_selected_mesin_id("<?=site_url();?>"); }}$('#suratpengajuanrepairline__mesin_id_dialog').dialog('close');});$('#suratpengajuanrepairline__mesin_id_lookup').button().click(function() {$('#suratpengajuanrepairline__mesin_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Tipe Core</td><td><?=form_input(array('name' => 'suratpengajuanrepairline__tipecore', 'value' => $suratpengajuanrepairline__tipecore, 'id' => 'suratpengajuanrepairline__tipecore'));?></td></tr><tr class='basic'>
<td>Roll Diameter</td><td><?=form_input(array('name' => 'suratpengajuanrepairline__rolldiameter', 'value' => $suratpengajuanrepairline__rolldiameter, 'id' => 'suratpengajuanrepairline__rolldiameter'));?></td></tr><tr class='basic'>
<td>Bearing Seat Diameter</td><td><?=form_input(array('name' => 'suratpengajuanrepairline__bearingseatdiameter', 'value' => $suratpengajuanrepairline__bearingseatdiameter, 'id' => 'suratpengajuanrepairline__bearingseatdiameter'));?></td></tr><tr class='basic'>
<td>Total Length (TL)</td><td><?=form_input(array('name' => 'suratpengajuanrepairline__totallength', 'value' => $suratpengajuanrepairline__totallength, 'id' => 'suratpengajuanrepairline__totallength'));?></td></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'suratpengajuanrepairline__quantity', 'value' => $suratpengajuanrepairline__quantity, 'id' => 'suratpengajuanrepairline__quantity'));?></td></tr><tr class='basic'>
<td>Jenis Repair</td><td><?=form_input(array('name' => 'suratpengajuanrepairline__jenisrepair', 'value' => $suratpengajuanrepairline__jenisrepair, 'id' => 'suratpengajuanrepairline__jenisrepair'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'suratpengajuanrepairline__notes', 'value' => $suratpengajuanrepairline__notes, 'id' => 'suratpengajuanrepairline__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/surat_pengajuan_repair_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


