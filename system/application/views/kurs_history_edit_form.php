<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#kurs_historyoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#kurs_historyeditform').click(function(){$('#kurs_historyeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Kurs History</h3>

<p>
<div id="kurs_historyoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/kurs_historyedit/submit" id="kurs_historyeditform" class="editform">

<?=form_hidden("kurs_history_id", $kurs_history_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'kurshistory__idstring', 'value' => $kurshistory__idstring, 'id' => 'kurshistory__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#kurshistory__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'kurshistory__date', 'value' => $kurshistory__date, 'class' => 'date', 'id' => 'kurshistory__date'));?></td></tr><tr class='basic'>
<td>Currency *</td><td><?=form_dropdown('kurshistory__currency_id', $currency_opt, $kurshistory__currency_id);?>&nbsp;<input id='kurshistory__currency_id_lookup' type='button' value='Lookup'></input></td><div id='kurshistory__currency_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#kurshistory__currency_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/currencylookup', function(data) { $('#kurshistory__currency_id_dialog').html(data);$('#kurshistory__currency_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=kurshistory__currency_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=kurshistory__currency_id]').val(lines[0]);if (typeof window.kurs_history_selected_currency_id == 'function') { kurs_history_selected_currency_id("<?=site_url();?>"); }}$('#kurshistory__currency_id_dialog').dialog('close');});$('#kurshistory__currency_id_lookup').button().click(function() {$('#kurshistory__currency_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Value</td><td><?=form_input(array('name' => 'kurshistory__value', 'value' => $kurshistory__value, 'id' => 'kurshistory__value'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'kurshistory__notes', 'value' => $kurshistory__notes, 'id' => 'kurshistory__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/kurs_historylist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


