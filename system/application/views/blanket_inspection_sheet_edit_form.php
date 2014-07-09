<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#blanket_inspection_sheetoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#blanket_inspection_sheeteditform').click(function(){$('#blanket_inspection_sheeteditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Blanket Inspection Sheet</h3>

<p>
<div id="blanket_inspection_sheetoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/blanket_inspection_sheetedit/submit" id="blanket_inspection_sheeteditform" class="editform">

<?=form_hidden("blanket_inspection_sheet_id", $blanket_inspection_sheet_id);?>

<table width="100%" class="edittable">
<tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#blanketinspectionsheet__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'blanketinspectionsheet__date', 'value' => $blanketinspectionsheet__date, 'class' => 'date', 'id' => 'blanketinspectionsheet__date'));?></td></tr><tr class='basic'>
<td>Customer *</td><td><?=form_dropdown('blanketinspectionsheet__customer_id', $customer_opt, $blanketinspectionsheet__customer_id);?>&nbsp;<input id='blanketinspectionsheet__customer_id_lookup' type='button' value='Lookup'></input></td><div id='blanketinspectionsheet__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#blanketinspectionsheet__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#blanketinspectionsheet__customer_id_dialog').html(data);$('#blanketinspectionsheet__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=blanketinspectionsheet__customer_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=blanketinspectionsheet__customer_id]').val(lines[0]);if (typeof window.blanket_inspection_sheet_selected_customer_id == 'function') { blanket_inspection_sheet_selected_customer_id("<?=site_url();?>"); }}$('#blanketinspectionsheet__customer_id_dialog').dialog('close');});$('#blanketinspectionsheet__customer_id_lookup').button().click(function() {$('#blanketinspectionsheet__customer_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Product Name</td><td><?=form_input(array('name' => 'blanketinspectionsheet__productname', 'value' => $blanketinspectionsheet__productname, 'id' => 'blanketinspectionsheet__productname'));?></td></tr><tr class='basic'>
<td>Press Type</td><td><?=form_input(array('name' => 'blanketinspectionsheet__presstype', 'value' => $blanketinspectionsheet__presstype, 'id' => 'blanketinspectionsheet__presstype'));?></td></tr><tr class='basic'>
<td>Bar Size</td><td><?=form_input(array('name' => 'blanketinspectionsheet__barsize', 'value' => $blanketinspectionsheet__barsize, 'id' => 'blanketinspectionsheet__barsize'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/blanket_inspection_sheetlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


