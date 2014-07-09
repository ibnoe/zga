<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#stock_movementoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#stock_movementeditform').click(function(){$('#stock_movementeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Stock Movement</h3>

<p>
<div id="stock_movementoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/stock_movementedit/submit" id="stock_movementeditform" class="editform">

<?=form_hidden("stock_movement_id", $stock_movement_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#moveaction__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'moveaction__date', 'value' => $moveaction__date, 'class' => 'date', 'id' => 'moveaction__date'));?></td></tr><tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'moveaction__orderid', 'value' => $moveaction__orderid, 'id' => 'moveaction__orderid'));?></td></tr><tr class='basic'>
<td>From Warehouse</td><td><?=form_dropdown('moveaction__from_warehouse_id', $warehouse_opt, $moveaction__from_warehouse_id);?>&nbsp;<input id='moveaction__from_warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='moveaction__from_warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#moveaction__from_warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/from_warehouselookup', function(data) { $('#moveaction__from_warehouse_id_dialog').html(data);$('#moveaction__from_warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=moveaction__from_warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=moveaction__from_warehouse_id]').val(lines[0]);if (typeof window.stock_movement_selected_from_warehouse_id == 'function') { stock_movement_selected_from_warehouse_id("<?=site_url();?>"); }}$('#moveaction__from_warehouse_id_dialog').dialog('close');});$('#moveaction__from_warehouse_id_lookup').button().click(function() {$('#moveaction__from_warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>To Warehouse</td><td><?=form_dropdown('moveaction__to_warehouse_id', $warehouse_opt, $moveaction__to_warehouse_id);?>&nbsp;<input id='moveaction__to_warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='moveaction__to_warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#moveaction__to_warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/to_warehouselookup', function(data) { $('#moveaction__to_warehouse_id_dialog').html(data);$('#moveaction__to_warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=moveaction__to_warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=moveaction__to_warehouse_id]').val(lines[0]);if (typeof window.stock_movement_selected_to_warehouse_id == 'function') { stock_movement_selected_to_warehouse_id("<?=site_url();?>"); }}$('#moveaction__to_warehouse_id_dialog').dialog('close');});$('#moveaction__to_warehouse_id_lookup').button().click(function() {$('#moveaction__to_warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/stock_movementlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


