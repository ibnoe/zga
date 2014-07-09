<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#kurs_historyoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/kurs_historyview/index/' },
		}; 
		
		$('#kurs_historyform').click(function(){$('#kurs_historyform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Kurs History</h3>

<p>
<div id="kurs_historyoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/kurs_historyadd/submit" id="kurs_historyform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'kurshistory__idstring', 'value' => $kurshistory__idstring, 'class' => 'basic', 'id' => 'kurshistory__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".kurshistory__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'kurshistory__date', 'value' => $kurshistory__date, 'class' => 'kurshistory__datebasic'));?></td></tr>
<tr class='basic'>
<td>Currency *</td>
<td><?=form_dropdown('kurshistory__currency_id', array(), '', 'class="basic"');?>&nbsp;<input id='kurshistory__currency_id_lookup' type='button' value='Lookup'></input></td><div id='kurshistory__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#kurshistory__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#kurshistory__currency_id_dialog').html(data);$('#kurshistory__currency_id_dialog a').attr('disabled', 'disabled');$('#kurshistory__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=kurshistory__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=kurshistory__currency_id]').val(lines[0]);if (typeof window.kurs_history_selected_currency_id == 'function') { kurs_history_selected_currency_id("<?=site_url();?>"); }}$('#kurshistory__currency_id_dialog').dialog('close');});$('#kurshistory__currency_id_lookup').button().click(function() {$('#kurshistory__currency_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Value</td>
<td><?=form_input(array('name' => 'kurshistory__value', 'value' => $kurshistory__value, 'class' => 'basic', 'id' => 'kurshistory__value'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'kurshistory__notes', 'value' => $kurshistory__notes, 'class' => 'basic', 'id' => 'kurshistory__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/kurs_historylist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
