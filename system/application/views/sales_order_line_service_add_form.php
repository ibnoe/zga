<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_order_line_serviceoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#sales_order_line_serviceform').click(function(){$('#sales_order_line_serviceform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Order Line Service</h3>

<p>
<div id="sales_order_line_serviceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_order_line_serviceadd/submit" id="sales_order_line_serviceform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('salesorder_id', $salesorder_id);?>
<tr class='basic'>
<?=form_hidden('salesorderline__orderid', $salesorderline__orderid);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__date', $salesorderline__date);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__notes', $salesorderline__notes);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__customer_id', $salesorderline__customer_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__currency_id', $salesorderline__currency_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__currencyrate', $salesorderline__currencyrate);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__warehouse_id', $salesorderline__warehouse_id);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__status', $salesorderline__status);?></tr>
<tr class='basic'>
<td>RCN</td>
<td><?=form_dropdown('salesorderline__rcn_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesorderline__rcn_id_lookup' type='button' value='Lookup'></input></td><div id='salesorderline__rcn_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesorderline__rcn_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/rcnlist', function(data) { $('#salesorderline__rcn_id_dialog').html(data);$('#salesorderline__rcn_id_dialog a').attr('disabled', 'disabled');$('#salesorderline__rcn_id_dialog table tr').click(function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });$('select[name=salesorderline__rcn_id]').find('option').remove().end().append('<option value=' + lines[0] + '>' + lines[2] + '</option>').val('0');$('#salesorderline__rcn_id').val(lines[0]);$('#salesorderline__rcn_id_dialog').dialog('close');});$('#salesorderline__rcn_id_lookup').button().click(function() {$('#salesorderline__rcn_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Quantity *</td>
<td><?=form_input(array('name' => 'salesorderline__quantity', 'value' => $salesorderline__quantity, 'class' => 'basic', 'id' => 'salesorderline__quantity'));?></td></tr>
<tr class='basic'>
<td>Price *</td>
<td><?=form_input(array('name' => 'salesorderline__price', 'value' => $salesorderline__price, 'class' => 'basic', 'id' => 'salesorderline__price'));?></td></tr>
<tr class='basic'>
<td>Disc %</td>
<td><?=form_input(array('name' => 'salesorderline__pdisc', 'value' => $salesorderline__pdisc, 'class' => 'basic', 'id' => 'salesorderline__pdisc'));?></td></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__modulename', $salesorderline__modulename);?></tr>
<tr class='basic'>
<?=form_hidden('salesorderline__subtotal', $salesorderline__subtotal);?></tr>
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
