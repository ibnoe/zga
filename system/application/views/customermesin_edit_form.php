<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#customermesinoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#customermesineditform').click(function(){$('#customermesineditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit CustomerMesin</h3>

<p>
<div id="customermesinoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/customermesinedit/submit" id="customermesineditform" class="editform">

<?=form_hidden("customermesin_id", $customermesin_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Mesin ID *</td><td><?=form_dropdown('customermesin__mesin_id', $mesin_opt, $customermesin__mesin_id);?>&nbsp;<input id='customermesin__mesin_id_lookup' type='button' value='Lookup'></input></td><div id='customermesin__mesin_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#customermesin__mesin_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/mesinlookup', function(data) { $('#customermesin__mesin_id_dialog').html(data);$('#customermesin__mesin_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=customermesin__mesin_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=customermesin__mesin_id]').val(lines[0]);if (typeof window.customermesin_selected_mesin_id == 'function') { customermesin_selected_mesin_id("<?=site_url();?>"); }}$('#customermesin__mesin_id_dialog').dialog('close');});$('#customermesin__mesin_id_lookup').button().click(function() {$('#customermesin__mesin_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>No Mesin *</td><td><?=form_input(array('name' => 'customermesin__nomesin', 'value' => $customermesin__nomesin, 'id' => 'customermesin__nomesin'));?></td></tr><tr class='basic'>
<td>No Seri Mesin *</td><td><?=form_input(array('name' => 'customermesin__noserimesin', 'value' => $customermesin__noserimesin, 'id' => 'customermesin__noserimesin'));?></td></tr><tr class='basic'>
<td>Tahun</td><td><?=form_input(array('name' => 'customermesin__tahun', 'value' => $customermesin__tahun, 'id' => 'customermesin__tahun'));?></td></tr><tr class='basic'>
<td>Konfigurasi</td><td><?=form_input(array('name' => 'customermesin__konfigurasi', 'value' => $customermesin__konfigurasi, 'id' => 'customermesin__konfigurasi'));?></td></tr><tr class='basic'>
<td>Jumlah Blanket</td><td><?=form_input(array('name' => 'customermesin__jumlahblanket', 'value' => $customermesin__jumlahblanket, 'id' => 'customermesin__jumlahblanket'));?></td></tr><tr class='basic'>
<td>Jumlah Roll</td><td><?=form_input(array('name' => 'customermesin__jumlahroll', 'value' => $customermesin__jumlahroll, 'id' => 'customermesin__jumlahroll'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'customermesin__notes', 'value' => $customermesin__notes, 'id' => 'customermesin__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/customermesinlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


