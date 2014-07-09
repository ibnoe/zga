<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#penawaran_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#penawaran_lineform').click(function(){$('#penawaran_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Penawaran Line</h3>

<p>
<div id="penawaran_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/penawaran_lineadd/submit" id="penawaran_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('salesorderquote_id', $salesorderquote_id);?>
<tr class='basic'>
<?=form_hidden('salesorderquoteline__orderid', $salesorderquoteline__orderid);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderquoteline__date', $salesorderquoteline__date);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderquoteline__notes', $salesorderquoteline__notes);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderquoteline__customer_id', $salesorderquoteline__customer_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderquoteline__currency_id', $salesorderquoteline__currency_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderquoteline__currencyrate', $salesorderquoteline__currencyrate);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderquoteline__warehouse_id', $salesorderquoteline__warehouse_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderquoteline__status', $salesorderquoteline__status);?></tr>
<tr class='basic'>
<td>Type</td><script type="text/javascript">$(document).ready(function() {$('#salesorderquoteline__type').change(function() { $('.item').attr('disabled', 'disabled');$('.item').hide();var s = $("#salesorderquoteline__type option:selected").text();if (s == 'Item') {$('.item').attr('disabled', '');$('.item').show();}});$('.item').attr('disabled', 'disabled');$('.item').hide();var s = $("#salesorderquoteline__type option:selected").text();if (s == 'Item') {$('.item').attr('disabled', '');$('.item').show();}});</script>
<td><?=form_dropdown('salesorderquoteline__type', array('Item' => 'Item', ), $salesorderquoteline__type, 'id="salesorderquoteline__type" class="basic"');?></td></tr>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('salesorderquoteline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorderquoteline__item_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderquoteline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderquoteline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#salesorderquoteline__item_id_dialog').html(data);$('#salesorderquoteline__item_id_dialog a').attr('disabled', 'disabled');$('#salesorderquoteline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorderquoteline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesorderquoteline__item_id]').val(lines[0]);if (typeof window.penawaran_line_selected_item_id == 'function') { penawaran_line_selected_item_id("<?=site_url();?>"); }}$('#salesorderquoteline__item_id_dialog').dialog('close');});$('#salesorderquoteline__item_id_lookup').button().click(function() {$('#salesorderquoteline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'salesorderquoteline__quantity', 'value' => $salesorderquoteline__quantity, 'class' => 'basic', 'id' => 'salesorderquoteline__quantity'));?></td></tr>
<tr class='basic'>
<td>Unit *</td>
<td><?=form_dropdown('salesorderquoteline__uom_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorderquoteline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderquoteline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderquoteline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#salesorderquoteline__uom_id_dialog').html(data);$('#salesorderquoteline__uom_id_dialog a').attr('disabled', 'disabled');$('#salesorderquoteline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesorderquoteline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesorderquoteline__uom_id]').val(lines[0]);if (typeof window.penawaran_line_selected_uom_id == 'function') { penawaran_line_selected_uom_id("<?=site_url();?>"); }}$('#salesorderquoteline__uom_id_dialog').dialog('close');});$('#salesorderquoteline__uom_id_lookup').button().click(function() {$('#salesorderquoteline__uom_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Price *</td>
<td><?=form_input(array('name' => 'salesorderquoteline__price', 'value' => $salesorderquoteline__price, 'class' => 'basic', 'id' => 'salesorderquoteline__price'));?></td></tr>
<tr class='basic'>
<td>Disc %</td>
<td><?=form_input(array('name' => 'salesorderquoteline__pdisc', 'value' => $salesorderquoteline__pdisc, 'class' => 'basic', 'id' => 'salesorderquoteline__pdisc'));?></td></tr>
<tr class='basic'>
<?=form_hidden('salesorderquoteline__modulename', $salesorderquoteline__modulename);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderquoteline__subtotal', $salesorderquoteline__subtotal);?></tr>
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
