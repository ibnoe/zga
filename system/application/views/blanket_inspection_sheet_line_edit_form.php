<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#blanket_inspection_sheet_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#blanket_inspection_sheet_lineeditform').click(function(){$('#blanket_inspection_sheet_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Blanket Inspection Sheet Line</h3>

<p>
<div id="blanket_inspection_sheet_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/blanket_inspection_sheet_lineedit/submit" id="blanket_inspection_sheet_lineeditform" class="editform">

<?=form_hidden("blanket_inspection_sheet_line_id", $blanket_inspection_sheet_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>QC Code</td><td><?=form_input(array('name' => 'blanketinspectionsheetline__qccode', 'value' => $blanketinspectionsheetline__qccode, 'id' => 'blanketinspectionsheetline__qccode'));?></td></tr><tr class='basic'>
<td>AC 1</td><td><?=form_input(array('name' => 'blanketinspectionsheetline__ac1', 'value' => $blanketinspectionsheetline__ac1, 'id' => 'blanketinspectionsheetline__ac1'));?></td></tr><tr class='basic'>
<td>AC 2</td><td><?=form_input(array('name' => 'blanketinspectionsheetline__ac2', 'value' => $blanketinspectionsheetline__ac2, 'id' => 'blanketinspectionsheetline__ac2'));?></td></tr><tr class='basic'>
<td>AR 1</td><td><?=form_input(array('name' => 'blanketinspectionsheetline__ar1', 'value' => $blanketinspectionsheetline__ar1, 'id' => 'blanketinspectionsheetline__ar1'));?></td></tr><tr class='basic'>
<td>AR 2</td><td><?=form_input(array('name' => 'blanketinspectionsheetline__ar2', 'value' => $blanketinspectionsheetline__ar2, 'id' => 'blanketinspectionsheetline__ar2'));?></td></tr><tr class='basic'>
<td>Thickness</td><td><?=form_input(array('name' => 'blanketinspectionsheetline__thickness', 'value' => $blanketinspectionsheetline__thickness, 'id' => 'blanketinspectionsheetline__thickness'));?></td></tr><tr class='basic'>
<td>KS</td><td><?=form_input(array('name' => 'blanketinspectionsheetline__ks', 'value' => $blanketinspectionsheetline__ks, 'id' => 'blanketinspectionsheetline__ks'));?></td></tr><tr class='basic'>
<td>Roll No</td><td><?=form_input(array('name' => 'blanketinspectionsheetline__rollno', 'value' => $blanketinspectionsheetline__rollno, 'id' => 'blanketinspectionsheetline__rollno'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#blanketinspectionsheetline__barringdate").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Barring Date *</td><td><?=form_input(array('name' => 'blanketinspectionsheetline__barringdate', 'value' => $blanketinspectionsheetline__barringdate, 'class' => 'date', 'id' => 'blanketinspectionsheetline__barringdate'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/blanket_inspection_sheet_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


