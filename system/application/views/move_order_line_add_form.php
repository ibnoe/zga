<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#move_order_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#move_order_lineform').click(function(){$('#move_order_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Move Order Line</h3>

<p>
<div id="move_order_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/move_order_lineadd/submit" id="move_order_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('moveorder_id', $moveorder_id);?>
<tr class='basic'>
<?=form_hidden('moveorderline__orderid', $moveorderline__orderid);?></tr>
<tr class='basic'>
<?=form_hidden('moveorderline__date', $moveorderline__date);?></tr>
<tr class='basic'>
<?=form_hidden('moveorderline__from_warehouse_id', $moveorderline__from_warehouse_id);?></tr>
<tr class='basic'>
<?=form_hidden('moveorderline__to_warehouse_id', $moveorderline__to_warehouse_id);?></tr>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('moveorderline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='moveorderline__item_id_lookup' type='button' value='Lookup'></input></td><div id='moveorderline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#moveorderline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/item_in_stocklookup', function(data) { $('#moveorderline__item_id_dialog').html(data);$('#moveorderline__item_id_dialog a').attr('disabled', 'disabled');$('#moveorderline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=moveorderline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=moveorderline__item_id]').val(lines[0]);if (typeof window.move_order_line_selected_item_id == 'function') { move_order_line_selected_item_id("<?=site_url();?>"); }}$('#moveorderline__item_id_dialog').dialog('close');});$('#moveorderline__item_id_lookup').button().click(function() {$('#moveorderline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'moveorderline__quantity', 'value' => $moveorderline__quantity, 'class' => 'basic', 'id' => 'moveorderline__quantity'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('moveorderline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='moveorderline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='moveorderline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#moveorderline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#moveorderline__uom_id_dialog').html(data);$('#moveorderline__uom_id_dialog a').attr('disabled', 'disabled');$('#moveorderline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=moveorderline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=moveorderline__uom_id]').val(lines[0]);if (typeof window.move_order_line_selected_uom_id == 'function') { move_order_line_selected_uom_id("<?=site_url();?>"); }}$('#moveorderline__uom_id_dialog').dialog('close');});$('#moveorderline__uom_id_lookup').button().click(function() {$('#moveorderline__uom_id_dialog').dialog('open');});});});</script></tr>
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
