<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#purchase_return_delivery_line_viewoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#purchase_return_delivery_line_viewform').click(function(){$('#purchase_return_delivery_line_viewform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Purchase Return Delivery Line View</h3>

<p>
<div id="purchase_return_delivery_line_viewoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchase_return_delivery_line_viewadd/submit" id="purchase_return_delivery_line_viewform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('purchasereturndelivery_id', $purchasereturndelivery_id);?>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('purchasereturndeliveryline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasereturndeliveryline__item_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturndeliveryline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturndeliveryline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#purchasereturndeliveryline__item_id_dialog').html(data);$('#purchasereturndeliveryline__item_id_dialog a').attr('disabled', 'disabled');$('#purchasereturndeliveryline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturndeliveryline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=purchasereturndeliveryline__item_id]').val(lines[0]);if (typeof window.purchase_return_delivery_line_view_selected_item_id == 'function') { purchase_return_delivery_line_view_selected_item_id("<?=site_url();?>"); }}$('#purchasereturndeliveryline__item_id_dialog').dialog('close');});$('#purchasereturndeliveryline__item_id_lookup').button().click(function() {$('#purchasereturndeliveryline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'purchasereturndeliveryline__quantitytosend', 'value' => $purchasereturndeliveryline__quantitytosend, 'class' => 'basic', 'id' => 'purchasereturndeliveryline__quantitytosend'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('purchasereturndeliveryline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='purchasereturndeliveryline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='purchasereturndeliveryline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#purchasereturndeliveryline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#purchasereturndeliveryline__uom_id_dialog').html(data);$('#purchasereturndeliveryline__uom_id_dialog a').attr('disabled', 'disabled');$('#purchasereturndeliveryline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=purchasereturndeliveryline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=purchasereturndeliveryline__uom_id]').val(lines[0]);if (typeof window.purchase_return_delivery_line_view_selected_uom_id == 'function') { purchase_return_delivery_line_view_selected_uom_id("<?=site_url();?>"); }}$('#purchasereturndeliveryline__uom_id_dialog').dialog('close');});$('#purchasereturndeliveryline__uom_id_lookup').button().click(function() {$('#purchasereturndeliveryline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<?=form_hidden('purchasereturndeliveryline__purchasereturnorderline_id', $purchasereturndeliveryline__purchasereturnorderline_id);?></tr>
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
