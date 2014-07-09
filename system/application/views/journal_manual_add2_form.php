<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#journal_manualoutput',
			success: 		function(data) { 
			//alert(data);
			if (data.indexOf('success') != -1) location.href='<?=site_url();?>/journal_manualview/index/' },
		}; 
		
		$('#journal_manualform').click(function(){$('#journal_manualform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Journal Manual</h3>

<p>
<div id="journal_manualoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/journal_manualadd2/submit" id="journal_manualform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Reference *</td>
<td><?=form_input(array('name' => 'journalmanual__reference', 'value' => $journalmanual__reference, 'class' => 'basic', 'id' => 'journalmanual__reference'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".journalmanual__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'journalmanual__date', 'value' => $journalmanual__date, 'class' => 'journalmanual__datebasic'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'journalmanual__notes', 'value' => $journalmanual__notes, 'class' => 'basic', 'id' => 'journalmanual__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>

<script type="text/javascript">$(document).ready(function() {

//$('#id_journal__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });

$('.journal__coa_id_lookup').live('click', function() {


//alert('aaa');
var dialog = $(this).closest('td').find('div');
//var sel = $(this).closest('td').find('select');
alert(dialog.attr('id'));


});

});

var currentsel;

function test(ob)
{
	//alert('aaa');
	//alert(ob.type);
	var sel = $(ob).closest('td').find('select');
	currentsel = sel;
	
	$('#journal__coa_id_dialog').dialog('open');
}
</script>

<script type="text/javascript">

$(document).ready(function() {
var line = "<tr><td><select name='journal__coa_id[]'></select><input onclick='test(this)'  type='button' value='Lookup'></input></td><td>Debit&nbsp;<input name='journal__debit[]' id='journal__debit' /></td><td>Credit&nbsp;<input name='journal__credit[]' id='journal__credit' /></td></tr>";
$('#lines').append(line);
$('#addrow').click(function() {
	//$('#lines').append("<tr><td>a</td><td>b</td><td>c</td></tr>");
	//var line = "<tr><td><select name='journal__coa_id'></select><input class='journal__coa_id_lookup' type='button' value='Lookup'></input><div id='id_journal__coa_id_dialog'></div></td><td>Debit&nbsp;<input name='journal__debit' id='journal__debit' /></td><td>Credit&nbsp;<input name='journal__credit' id='journal__credit' /></td></tr>";
	$('#lines').append(line);
	//alert('123');
	
	
	});
});
</script>

<input id='addrow' type='button' value='+Row'></input></td>
<br/>
<br/>

<table id="lines">
<tr>
<!--<td><?//=form_dropdown('journal__coa_id', array(), '', 'class="basic"');?>&nbsp;

<select name='journal__coa_id[]'></select>

<input id='journal__coa_id_lookup' type='button' value='Lookup'></input>-->
<div id='journal__coa_id_dialog'></div><script type="text/javascript">
$(document).ready(function() {
$('#journal__coa_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });
$.get('<?=site_url();?>/accountslookup', function(data) { 
$('#journal__coa_id_dialog').html(data);
$('#journal__coa_id_dialog a').attr('disabled', 'disabled');
$('#journal__coa_id_dialog table tr').live('click', function() { 
var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });
if (lines[0] != null) {
var sel = currentsel;//$(this).closest('td').find('select');
//alert(sel.attr('name'));
//$('select[name=journal__coa_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');
//$('select[name=journal__coa_id]').val(lines[0]);
sel.append('<option value=' + lines[0] + '>' + lines[1] + '</option>');
sel.val(lines[0]);
if (typeof window.journal_manual_line_selected_coa_id == 'function') { journal_manual_line_selected_coa_id("<?=site_url();?>"); }}
$('#journal__coa_id_dialog').dialog('close');});$('#journal__coa_id_lookup').button().click(function() {$('#journal__coa_id_dialog').dialog('open');});});
});
</script>
<!--</td>
<td>Debit&nbsp;<?//=form_input(array('name' => 'journal__debit', 'value' => '', 'class' => 'basic', 'id' => 'journal__debit'));?></td>
<td>Credit&nbsp;<?//=form_input(array('name' => 'journal__credit', 'value' => '', 'class' => 'basic', 'id' => 'journal__credit'));?></td>-->
</tr>
</table>


<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/journal_manuallist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
