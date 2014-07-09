<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#manufacturing_order_done_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/manufacturing_order_done_lineview/index/' },
		}; 
		
		$('#manufacturing_order_done_lineform').click(function(){$('#manufacturing_order_done_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Manufacturing Order Done Line</h3>

<p>
<div id="manufacturing_order_done_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/manufacturing_order_done_lineadd/submit" id="manufacturing_order_done_lineform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<?=form_hidden('manufacturingorderdoneline__idstring', $manufacturingorderdoneline__idstring);?></tr>
<tr class='basic'>
<?=form_hidden('manufacturingorderdoneline__date', $manufacturingorderdoneline__date);?></tr>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('manufacturingorderdoneline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='manufacturingorderdoneline__item_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingorderdoneline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingorderdoneline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#manufacturingorderdoneline__item_id_dialog').html(data);$('#manufacturingorderdoneline__item_id_dialog a').attr('disabled', 'disabled');$('#manufacturingorderdoneline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingorderdoneline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=manufacturingorderdoneline__item_id]').val(lines[0]);if (typeof window.manufacturing_order_done_line_selected_item_id == 'function') { manufacturing_order_done_line_selected_item_id("<?=site_url();?>"); }}$('#manufacturingorderdoneline__item_id_dialog').dialog('close');});$('#manufacturingorderdoneline__item_id_lookup').button().click(function() {$('#manufacturingorderdoneline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'manufacturingorderdoneline__quantitytoprocess', 'value' => $manufacturingorderdoneline__quantitytoprocess, 'class' => 'basic', 'id' => 'manufacturingorderdoneline__quantitytoprocess'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('manufacturingorderdoneline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='manufacturingorderdoneline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='manufacturingorderdoneline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#manufacturingorderdoneline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#manufacturingorderdoneline__uom_id_dialog').html(data);$('#manufacturingorderdoneline__uom_id_dialog a').attr('disabled', 'disabled');$('#manufacturingorderdoneline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=manufacturingorderdoneline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=manufacturingorderdoneline__uom_id]').val(lines[0]);if (typeof window.manufacturing_order_done_line_selected_uom_id == 'function') { manufacturing_order_done_line_selected_uom_id("<?=site_url();?>"); }}$('#manufacturingorderdoneline__uom_id_dialog').dialog('close');});$('#manufacturingorderdoneline__uom_id_lookup').button().click(function() {$('#manufacturingorderdoneline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<?=form_hidden('manufacturingorderdoneline__manufacturingorder_id', $manufacturingorderdoneline__manufacturingorder_id);?></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/manufacturing_order_done_linelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
