<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#move_orderoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/move_orderview/index/' },
		}; 
		
		$('#move_orderform').click(function(){$('#move_orderform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Move Order</h3>

<p>
<div id="move_orderoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/move_orderadd/submit" id="move_orderform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'moveorder__orderid', 'value' => $moveorder__orderid, 'class' => 'basic', 'id' => 'moveorder__orderid'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".moveorder__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'moveorder__date', 'value' => $moveorder__date, 'class' => 'moveorder__datebasic'));?></td></tr>
<tr class='basic'>
<td>From Location *</td>
<td><?=form_dropdown('moveorder__from_warehouse_id', array(), '', 'class="basic"');?>&nbsp;<input id='moveorder__from_warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='moveorder__from_warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#moveorder__from_warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/from_warehouselookup', function(data) { $('#moveorder__from_warehouse_id_dialog').html(data);$('#moveorder__from_warehouse_id_dialog a').attr('disabled', 'disabled');$('#moveorder__from_warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=moveorder__from_warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=moveorder__from_warehouse_id]').val(lines[0]);if (typeof window.move_order_selected_from_warehouse_id == 'function') { move_order_selected_from_warehouse_id("<?=site_url();?>"); }}$('#moveorder__from_warehouse_id_dialog').dialog('close');});$('#moveorder__from_warehouse_id_lookup').button().click(function() {$('#moveorder__from_warehouse_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>To Location *</td>
<td><?=form_dropdown('moveorder__to_warehouse_id', array(), '', 'class="basic"');?>&nbsp;<input id='moveorder__to_warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='moveorder__to_warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#moveorder__to_warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/to_warehouselookup', function(data) { $('#moveorder__to_warehouse_id_dialog').html(data);$('#moveorder__to_warehouse_id_dialog a').attr('disabled', 'disabled');$('#moveorder__to_warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=moveorder__to_warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=moveorder__to_warehouse_id]').val(lines[0]);if (typeof window.move_order_selected_to_warehouse_id == 'function') { move_order_selected_to_warehouse_id("<?=site_url();?>"); }}$('#moveorder__to_warehouse_id_dialog').dialog('close');});$('#moveorder__to_warehouse_id_lookup').button().click(function() {$('#moveorder__to_warehouse_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'moveorder__notes', 'value' => $moveorder__notes, 'class' => 'basic', 'id' => 'moveorder__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/move_orderlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
