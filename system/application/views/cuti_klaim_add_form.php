<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#cuti_klaimoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#cuti_klaimform').click(function(){$('#cuti_klaimform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Cuti Klaim</h3>

<p>
<div id="cuti_klaimoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/cuti_klaimadd/submit" id="cuti_klaimform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('karyawan_id', $karyawan_id);?>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".cutiklaim__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'cutiklaim__date', 'value' => $cutiklaim__date, 'class' => 'cutiklaim__datebasic'));?></td></tr>
<tr class='basic'>
<td>Total Cuti Diambil</td>
<td><?=form_input(array('name' => 'cutiklaim__totalcutiklaimed', 'value' => $cutiklaim__totalcutiklaimed, 'class' => 'basic', 'id' => 'cutiklaim__totalcutiklaimed'));?></td></tr>
<tr class='basic'>
<td>Atasan *</td>
<td><?=form_dropdown('cutiklaim__users_id', array(), '', 'class="basic"');?>&nbsp;<input id='cutiklaim__users_id_lookup' type='button' value='Lookup'></input></td><div id='cutiklaim__users_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#cutiklaim__users_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/hr_userslookup', function(data) { $('#cutiklaim__users_id_dialog').html(data);$('#cutiklaim__users_id_dialog a').attr('disabled', 'disabled');$('#cutiklaim__users_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=cutiklaim__users_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=cutiklaim__users_id]').val(lines[0]);if (typeof window.cuti_klaim_selected_users_id == 'function') { cuti_klaim_selected_users_id("<?=site_url();?>"); }}$('#cutiklaim__users_id_dialog').dialog('close');});$('#cutiklaim__users_id_lookup').button().click(function() {$('#cutiklaim__users_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'cutiklaim__notes', 'value' => $cutiklaim__notes, 'class' => 'basic', 'id' => 'cutiklaim__notes'));?></td></tr>
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
