<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#rifoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/rifview/index/' },
		}; 
		
		$('#rifform').click(function(){$('#rifform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New RIF</h3>

<p>
<div id="rifoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/rifadd/submit" id="rifform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>No RIF *</td>
<td><?=form_input(array('name' => 'rcn__norif', 'value' => $rcn__norif, 'class' => 'basic', 'id' => 'rcn__norif'));?></td></tr>
<tr class='basic'>
<td>Date of Incoming Roll *</td><script type="text/javascript">$(document).ready(function() {$(".rcn__incomingrolldatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'rcn__incomingrolldate', 'value' => $rcn__incomingrolldate, 'class' => 'rcn__incomingrolldatebasic'));?></td></tr>
<tr class='basic'>
<td>Time of Incoming Roll</td>
<td><?=form_input(array('name' => 'rcn__incomingrolltime', 'value' => $rcn__incomingrolltime, 'class' => 'basic', 'id' => 'rcn__incomingrolltime'));?></td></tr>
<tr class='basic'>
<td>Date of Identification *</td><script type="text/javascript">$(document).ready(function() {$(".rcn__identificationdatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'rcn__identificationdate', 'value' => $rcn__identificationdate, 'class' => 'rcn__identificationdatebasic'));?></td></tr>
<tr class='basic'>
<td>Time of Identification</td>
<td><?=form_input(array('name' => 'rcn__identificationtime', 'value' => $rcn__identificationtime, 'class' => 'basic', 'id' => 'rcn__identificationtime'));?></td></tr>
<tr class='basic'>
<td>Press</td>
<td><?=form_input(array('name' => 'rcn__press', 'value' => $rcn__press, 'class' => 'basic', 'id' => 'rcn__press'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<td><?=form_dropdown('rcn__customer_id', array(), '', 'class="basic"');?>&nbsp;<input id='rcn__customer_id_lookup' type='button' value='Lookup'></input></td><div id='rcn__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#rcn__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#rcn__customer_id_dialog').html(data);$('#rcn__customer_id_dialog a').attr('disabled', 'disabled');$('#rcn__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=rcn__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=rcn__customer_id]').val(lines[0]);if (typeof window.rif_selected_customer_id == 'function') { rif_selected_customer_id("<?=site_url();?>"); }}$('#rcn__customer_id_dialog').dialog('close');});$('#rcn__customer_id_lookup').button().click(function() {$('#rcn__customer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>No Diss *</td>
<td><?=form_input(array('name' => 'rcn__nodiss', 'value' => $rcn__nodiss, 'class' => 'basic', 'id' => 'rcn__nodiss'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/riflist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
