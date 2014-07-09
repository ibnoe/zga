<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#stock_adjustmentoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/stock_adjustmentview/index/' },
		}; 
		
		$('#stock_adjustmentform').click(function(){$('#stock_adjustmentform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Stock Adjustment</h3>

<p>
<div id="stock_adjustmentoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/stock_adjustmentadd/submit" id="stock_adjustmentform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'stockadjustment__idstring', 'value' => $stockadjustment__idstring, 'class' => 'basic', 'id' => 'stockadjustment__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".stockadjustment__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'stockadjustment__date', 'value' => $stockadjustment__date, 'class' => 'stockadjustment__datebasic'));?></td></tr>
<tr class='basic'>
<td>Description</td>
<td><?=form_input(array('name' => 'stockadjustment__notes', 'value' => $stockadjustment__notes, 'class' => 'basic', 'id' => 'stockadjustment__notes'));?></td></tr>
<tr class='basic'>
<td>Location *</td>
<td><?=form_dropdown('stockadjustment__warehouse_id', array(), '', 'class="basic"');?>&nbsp;<input id='stockadjustment__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='stockadjustment__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#stockadjustment__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#stockadjustment__warehouse_id_dialog').html(data);$('#stockadjustment__warehouse_id_dialog a').attr('disabled', 'disabled');$('#stockadjustment__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=stockadjustment__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=stockadjustment__warehouse_id]').val(lines[0]);if (typeof window.stock_adjustment_selected_warehouse_id == 'function') { stock_adjustment_selected_warehouse_id("<?=site_url();?>"); }}$('#stockadjustment__warehouse_id_dialog').dialog('close');});$('#stockadjustment__warehouse_id_lookup').button().click(function() {$('#stockadjustment__warehouse_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/stock_adjustmentlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
