<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#spp_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#spp_lineeditform').click(function(){$('#spp_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit SPP Line</h3>

<p>
<div id="spp_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/spp_lineedit/submit" id="spp_lineeditform" class="editform">

<?=form_hidden("spp_line_id", $spp_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'>
<td>Item *</td><td><?=form_dropdown('suratpermintaanpembelianline__item_id', $item_opt, $suratpermintaanpembelianline__item_id);?>&nbsp;<input id='suratpermintaanpembelianline__item_id_lookup' type='button' value='Lookup'></input></td><div id='suratpermintaanpembelianline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#suratpermintaanpembelianline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/purchaseable_itemlookup', function(data) { $('#suratpermintaanpembelianline__item_id_dialog').html(data);$('#suratpermintaanpembelianline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=suratpermintaanpembelianline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=suratpermintaanpembelianline__item_id]').val(lines[0]);if (typeof window.spp_line_selected_item_id == 'function') { spp_line_selected_item_id("<?=site_url();?>"); }}$('#suratpermintaanpembelianline__item_id_dialog').dialog('close');});$('#suratpermintaanpembelianline__item_id_lookup').button().click(function() {$('#suratpermintaanpembelianline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'suratpermintaanpembelianline__quantity', 'value' => $suratpermintaanpembelianline__quantity, 'id' => 'suratpermintaanpembelianline__quantity'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('suratpermintaanpembelianline__uom_id', $uom_opt, $suratpermintaanpembelianline__uom_id);?>&nbsp;<input id='suratpermintaanpembelianline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='suratpermintaanpembelianline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#suratpermintaanpembelianline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#suratpermintaanpembelianline__uom_id_dialog').html(data);$('#suratpermintaanpembelianline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=suratpermintaanpembelianline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=suratpermintaanpembelianline__uom_id]').val(lines[0]);if (typeof window.spp_line_selected_uom_id == 'function') { spp_line_selected_uom_id("<?=site_url();?>"); }}$('#suratpermintaanpembelianline__uom_id_dialog').dialog('close');});$('#suratpermintaanpembelianline__uom_id_lookup').button().click(function() {$('#suratpermintaanpembelianline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/spp_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


