<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#blanket_inspection_sheet_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		}; 
		
		$('#blanket_inspection_sheet_lineform').click(function(){$('#blanket_inspection_sheet_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Blanket Inspection Sheet Line</h3>

<p>
<div id="blanket_inspection_sheet_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/blanket_inspection_sheet_lineadd/submit" id="blanket_inspection_sheet_lineform" class="addform">

<table width="100%" class="addtable">
<?=form_hidden('blanketinspectionsheet_id', $blanketinspectionsheet_id);?>
<tr class='basic'>
<td>QC Code</td>
<td><?=form_input(array('name' => 'blanketinspectionsheetline__qccode', 'value' => $blanketinspectionsheetline__qccode, 'class' => 'basic', 'id' => 'blanketinspectionsheetline__qccode'));?></td></tr>
<tr class='basic'>
<td>AC 1</td>
<td><?=form_input(array('name' => 'blanketinspectionsheetline__ac1', 'value' => $blanketinspectionsheetline__ac1, 'class' => 'basic', 'id' => 'blanketinspectionsheetline__ac1'));?></td></tr>
<tr class='basic'>
<td>AC 2</td>
<td><?=form_input(array('name' => 'blanketinspectionsheetline__ac2', 'value' => $blanketinspectionsheetline__ac2, 'class' => 'basic', 'id' => 'blanketinspectionsheetline__ac2'));?></td></tr>
<tr class='basic'>
<td>AR 1</td>
<td><?=form_input(array('name' => 'blanketinspectionsheetline__ar1', 'value' => $blanketinspectionsheetline__ar1, 'class' => 'basic', 'id' => 'blanketinspectionsheetline__ar1'));?></td></tr>
<tr class='basic'>
<td>AR 2</td>
<td><?=form_input(array('name' => 'blanketinspectionsheetline__ar2', 'value' => $blanketinspectionsheetline__ar2, 'class' => 'basic', 'id' => 'blanketinspectionsheetline__ar2'));?></td></tr>
<tr class='basic'>
<td>Thickness</td>
<td><?=form_input(array('name' => 'blanketinspectionsheetline__thickness', 'value' => $blanketinspectionsheetline__thickness, 'class' => 'basic', 'id' => 'blanketinspectionsheetline__thickness'));?></td></tr>
<tr class='basic'>
<td>KS</td>
<td><?=form_input(array('name' => 'blanketinspectionsheetline__ks', 'value' => $blanketinspectionsheetline__ks, 'class' => 'basic', 'id' => 'blanketinspectionsheetline__ks'));?></td></tr>
<tr class='basic'>
<td>Roll No</td>
<td><?=form_input(array('name' => 'blanketinspectionsheetline__rollno', 'value' => $blanketinspectionsheetline__rollno, 'class' => 'basic', 'id' => 'blanketinspectionsheetline__rollno'));?></td></tr>
<tr class='basic'>
<td>Barring Date *</td><script type="text/javascript">$(document).ready(function() {$(".blanketinspectionsheetline__barringdatebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'blanketinspectionsheetline__barringdate', 'value' => $blanketinspectionsheetline__barringdate, 'class' => 'blanketinspectionsheetline__barringdatebasic'));?></td></tr>
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
