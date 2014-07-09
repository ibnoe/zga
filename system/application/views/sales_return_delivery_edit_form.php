<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_return_deliveryoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_return_deliveryeditform').click(function(){$('#sales_return_deliveryeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Return Delivery</h3>

<p>
<div id="sales_return_deliveryoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_deliveryedit/submit" id="sales_return_deliveryeditform" class="editform">

<?=form_hidden("sales_return_delivery_id", $sales_return_delivery_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#salesreturndelivery__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'salesreturndelivery__date', 'value' => $salesreturndelivery__date, 'class' => 'date', 'id' => 'salesreturndelivery__date'));?></td></tr><tr class='basic'>
<td>Delivery No *</td><td><?=form_input(array('name' => 'salesreturndelivery__salesreturndeliveryid', 'value' => $salesreturndelivery__salesreturndeliveryid, 'id' => 'salesreturndelivery__salesreturndeliveryid'));?></td></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('salesreturndelivery__customer_id', $customer_opt, $salesreturndelivery__customer_id);?>&nbsp;<input id='salesreturndelivery__customer_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturndelivery__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturndelivery__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#salesreturndelivery__customer_id_dialog').html(data);$('#salesreturndelivery__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturndelivery__customer_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturndelivery__customer_id]').val(lines[0]);if (typeof window.sales_return_delivery_selected_customer_id == 'function') { sales_return_delivery_selected_customer_id("<?=site_url();?>"); }}$('#salesreturndelivery__customer_id_dialog').dialog('close');});$('#salesreturndelivery__customer_id_lookup').button().click(function() {$('#salesreturndelivery__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Warehouse *</td><td><?=form_dropdown('salesreturndelivery__warehouse_id', $warehouse_opt, $salesreturndelivery__warehouse_id);?>&nbsp;<input id='salesreturndelivery__warehouse_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturndelivery__warehouse_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturndelivery__warehouse_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/warehouselookup', function(data) { $('#salesreturndelivery__warehouse_id_dialog').html(data);$('#salesreturndelivery__warehouse_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturndelivery__warehouse_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesreturndelivery__warehouse_id]').val(lines[0]);if (typeof window.sales_return_delivery_selected_warehouse_id == 'function') { sales_return_delivery_selected_warehouse_id("<?=site_url();?>"); }}$('#salesreturndelivery__warehouse_id_dialog').dialog('close');});$('#salesreturndelivery__warehouse_id_lookup').button().click(function() {$('#salesreturndelivery__warehouse_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'salesreturndelivery__notes', 'value' => $salesreturndelivery__notes, 'id' => 'salesreturndelivery__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_deliverylist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


