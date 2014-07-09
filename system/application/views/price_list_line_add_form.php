<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#price_list_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#price_list_lineform').click(function(){$('#price_list_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Price List Line</h3>

<p>
<div id="price_list_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/price_list_lineadd/submit" id="price_list_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('pricelist_id', $pricelist_id);?>
<tr class='basic'>
<td>Item *</td>
<td><?=form_dropdown('pricelistline__item_id', array(), '', 'class="basic"');?>&nbsp;<input id='pricelistline__item_id_lookup' type='button' value='Lookup'></input></td><div id='pricelistline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#pricelistline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#pricelistline__item_id_dialog').html(data);$('#pricelistline__item_id_dialog a').attr('disabled', 'disabled');$('#pricelistline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=pricelistline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=pricelistline__item_id]').val(lines[0]);if (typeof window.price_list_line_selected_item_id == 'function') { price_list_line_selected_item_id("<?=site_url();?>"); }}$('#pricelistline__item_id_dialog').dialog('close');});$('#pricelistline__item_id_lookup').button().click(function() {$('#pricelistline__item_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Discount</td>
<td><?=form_input(array('name' => 'pricelistline__pdisc', 'value' => $pricelistline__pdisc, 'class' => 'basic', 'id' => 'pricelistline__pdisc'));?></td></tr>
<tr class='basic'>
<td>Price *</td>
<td><?=form_input(array('name' => 'pricelistline__price', 'value' => $pricelistline__price, 'class' => 'basic', 'id' => 'pricelistline__price'));?></td></tr>
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
