<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_return_delivery_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sales_return_delivery_lineview/index/' },
		}; 
		
		$('#sales_return_delivery_lineform').click(function(){$('#sales_return_delivery_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Return Delivery Line</h3>

<p>
<div id="sales_return_delivery_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_delivery_lineadd/submit" id="sales_return_delivery_lineform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('salesreturndeliveryline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesreturndeliveryline__item_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturndeliveryline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturndeliveryline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#salesreturndeliveryline__item_id_dialog').html(data);$('#salesreturndeliveryline__item_id_dialog a').attr('disabled', 'disabled');$('#salesreturndeliveryline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturndeliveryline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturndeliveryline__item_id]').val(lines[0]);if (typeof window.sales_return_delivery_line_selected_item_id == 'function') { sales_return_delivery_line_selected_item_id("<?=site_url();?>"); }}$('#salesreturndeliveryline__item_id_dialog').dialog('close');});$('#salesreturndeliveryline__item_id_lookup').button().click(function() {$('#salesreturndeliveryline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'salesreturndeliveryline__quantitytoreceive', 'value' => $salesreturndeliveryline__quantitytoreceive, 'class' => 'basic', 'id' => 'salesreturndeliveryline__quantitytoreceive'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('salesreturndeliveryline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesreturndeliveryline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturndeliveryline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturndeliveryline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#salesreturndeliveryline__uom_id_dialog').html(data);$('#salesreturndeliveryline__uom_id_dialog a').attr('disabled', 'disabled');$('#salesreturndeliveryline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturndeliveryline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesreturndeliveryline__uom_id]').val(lines[0]);if (typeof window.sales_return_delivery_line_selected_uom_id == 'function') { sales_return_delivery_line_selected_uom_id("<?=site_url();?>"); }}$('#salesreturndeliveryline__uom_id_dialog').dialog('close');});$('#salesreturndeliveryline__uom_id_lookup').button().click(function() {$('#salesreturndeliveryline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<?=form_hidden('salesreturndeliveryline__salesreturnorderline_id', $salesreturndeliveryline__salesreturnorderline_id);?></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_delivery_linelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
