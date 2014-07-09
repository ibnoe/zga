<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#price_list_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#price_list_lineeditform').click(function(){$('#price_list_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Price List Line</h3>

<p>
<div id="price_list_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/price_list_lineedit/submit" id="price_list_lineeditform" class="editform">

<?=form_hidden("price_list_line_id", $price_list_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Item *</td><td><?=form_dropdown('pricelistline__item_id', $item_opt, $pricelistline__item_id);?>&nbsp;<input id='pricelistline__item_id_lookup' type='button' value='Lookup'></input></td><div id='pricelistline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#pricelistline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#pricelistline__item_id_dialog').html(data);$('#pricelistline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=pricelistline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=pricelistline__item_id]').val(lines[0]);if (typeof window.price_list_line_selected_item_id == 'function') { price_list_line_selected_item_id("<?=site_url();?>"); }}$('#pricelistline__item_id_dialog').dialog('close');});$('#pricelistline__item_id_lookup').button().click(function() {$('#pricelistline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Discount</td><td><?=form_input(array('name' => 'pricelistline__pdisc', 'value' => $pricelistline__pdisc, 'id' => 'pricelistline__pdisc'));?></td></tr><tr class='basic'>
<td>Price *</td><td><?=form_input(array('name' => 'pricelistline__price', 'value' => $pricelistline__price, 'id' => 'pricelistline__price'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/price_list_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


