<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#mesinoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/mesinview/index/' },
		}; 
		
		$('#mesinform').click(function(){$('#mesinform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Mesin</h3>

<p>
<div id="mesinoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/mesinadd/submit" id="mesinform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Kode Mesin *</td>
<td><?=form_input(array('name' => 'mesin__idstring', 'value' => $mesin__idstring, 'class' => 'basic', 'id' => 'mesin__idstring'));?></td></tr>
<tr class='basic'>
<td>Tipe Mesin *</td>
<td><?=form_input(array('name' => 'mesin__typename', 'value' => $mesin__typename, 'class' => 'basic', 'id' => 'mesin__typename'));?></td></tr>
<tr class='basic'>
<td>Merk Mesin</td>
<td><?=form_dropdown('mesin__merkmesin_id', array(), '', 'class="basic"');?>&nbsp;<input id='mesin__merkmesin_id_lookup' type='button' value='Lookup'></input></td><div id='mesin__merkmesin_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#mesin__merkmesin_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/merk_mesinlookup', function(data) { $('#mesin__merkmesin_id_dialog').html(data);$('#mesin__merkmesin_id_dialog a').attr('disabled', 'disabled');$('#mesin__merkmesin_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=mesin__merkmesin_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=mesin__merkmesin_id]').val(lines[0]);if (typeof window.mesin_selected_merkmesin_id == 'function') { mesin_selected_merkmesin_id("<?=site_url();?>"); }}$('#mesin__merkmesin_id_dialog').dialog('close');});$('#mesin__merkmesin_id_lookup').button().click(function() {$('#mesin__merkmesin_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/mesinlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
