<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#chemical_inspection_sheetoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/chemical_inspection_sheetview/index/' },
		}; 
		
		$('#chemical_inspection_sheetform').click(function(){$('#chemical_inspection_sheetform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Chemical Inspection Sheet</h3>

<p>
<div id="chemical_inspection_sheetoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/chemical_inspection_sheetadd/submit" id="chemical_inspection_sheetform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".chemicalinspectionsheet__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'chemicalinspectionsheet__date', 'value' => $chemicalinspectionsheet__date, 'class' => 'chemicalinspectionsheet__datebasic'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<td><?=form_dropdown('chemicalinspectionsheet__customer_id', array(), '', 'class="basic"');?>&nbsp;<input id='chemicalinspectionsheet__customer_id_lookup' type='button' value='Lookup'></input></td><div id='chemicalinspectionsheet__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#chemicalinspectionsheet__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#chemicalinspectionsheet__customer_id_dialog').html(data);$('#chemicalinspectionsheet__customer_id_dialog a').attr('disabled', 'disabled');$('#chemicalinspectionsheet__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=chemicalinspectionsheet__customer_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=chemicalinspectionsheet__customer_id]').val(lines[0]);if (typeof window.chemical_inspection_sheet_selected_customer_id == 'function') { chemical_inspection_sheet_selected_customer_id("<?=site_url();?>"); }}$('#chemicalinspectionsheet__customer_id_dialog').dialog('close');});$('#chemicalinspectionsheet__customer_id_lookup').button().click(function() {$('#chemicalinspectionsheet__customer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Product Name</td>
<td><?=form_input(array('name' => 'chemicalinspectionsheet__productname', 'value' => $chemicalinspectionsheet__productname, 'class' => 'basic', 'id' => 'chemicalinspectionsheet__productname'));?></td></tr>
<tr class='basic'>
<td>Batch No</td>
<td><?=form_input(array('name' => 'chemicalinspectionsheet__batchno', 'value' => $chemicalinspectionsheet__batchno, 'class' => 'basic', 'id' => 'chemicalinspectionsheet__batchno'));?></td></tr>
<tr class='basic'>
<td>Chemical Type</td>
<td><?=form_input(array('name' => 'chemicalinspectionsheet__chemicaltype', 'value' => $chemicalinspectionsheet__chemicaltype, 'class' => 'basic', 'id' => 'chemicalinspectionsheet__chemicaltype'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/chemical_inspection_sheetlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
