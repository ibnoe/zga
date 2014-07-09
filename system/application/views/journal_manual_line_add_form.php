<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#journal_manual_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#journal_manual_lineform').click(function(){$('#journal_manual_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Journal Manual Line</h3>

<p>
<div id="journal_manual_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/journal_manual_lineadd/submit" id="journal_manual_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('journalmanual_id', $journalmanual_id);?>
<tr class='basic'>
<td>Account</td>
<td><?=form_dropdown('journal__coa_id', array(), '', 'class="basic"');?>&nbsp;<input id='journal__coa_id_lookup' type='button' value='Lookup'></input></td><div id='journal__coa_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#journal__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/accountslookup', function(data) { $('#journal__coa_id_dialog').html(data);$('#journal__coa_id_dialog a').attr('disabled', 'disabled');$('#journal__coa_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=journal__coa_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=journal__coa_id]').val(lines[0]);if (typeof window.journal_manual_line_selected_coa_id == 'function') { journal_manual_line_selected_coa_id("<?=site_url();?>"); }}$('#journal__coa_id_dialog').dialog('close');});$('#journal__coa_id_lookup').button().click(function() {$('#journal__coa_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Debit</td>
<td><?=form_input(array('name' => 'journal__debit', 'value' => $journal__debit, 'class' => 'basic', 'id' => 'journal__debit'));?></td></tr>
<tr class='basic'>
<td>Credit</td>
<td><?=form_input(array('name' => 'journal__credit', 'value' => $journal__credit, 'class' => 'basic', 'id' => 'journal__credit'));?></td></tr>
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
