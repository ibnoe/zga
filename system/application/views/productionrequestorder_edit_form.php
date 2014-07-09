<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#productionrequestorderoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#productionrequestordereditform').click(function(){$('#productionrequestordereditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit ProductionRequestOrder</h3>

<p>
<div id="productionrequestorderoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/productionrequestorderedit/submit" id="productionrequestordereditform" class="editform">

<?=form_hidden("productionrequestorder_id", $productionrequestorder_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Order No *</td><td><?=form_input(array('name' => 'productionrequestorder__idstring', 'value' => $productionrequestorder__idstring, 'id' => 'productionrequestorder__idstring'));?></td></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('productionrequestorder__customer_id', $customer_opt, $productionrequestorder__customer_id);?>&nbsp;<input id='productionrequestorder__customer_id_lookup' type='button' value='Lookup'></input></td><div id='productionrequestorder__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#productionrequestorder__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#productionrequestorder__customer_id_dialog').html(data);$('#productionrequestorder__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=productionrequestorder__customer_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=productionrequestorder__customer_id]').val(lines[0]);if (typeof window.productionrequestorder_selected_customer_id == 'function') { productionrequestorder_selected_customer_id("<?=site_url();?>"); }}$('#productionrequestorder__customer_id_dialog').dialog('close');});$('#productionrequestorder__customer_id_lookup').button().click(function() {$('#productionrequestorder__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Order No *</td><td><?=form_input(array('name' => 'productionrequestorder__idstring', 'value' => $productionrequestorder__idstring, 'id' => 'productionrequestorder__idstring'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/productionrequestorderlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


