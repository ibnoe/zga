<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#chemical_work_instructionoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#chemical_work_instructioneditform').click(function(){$('#chemical_work_instructioneditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Chemical Work Instruction</h3>

<p>
<div id="chemical_work_instructionoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/chemical_work_instructionedit/submit" id="chemical_work_instructioneditform" class="editform">

<?=form_hidden("chemical_work_instruction_id", $chemical_work_instruction_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'chemicalworkinstruction__idstring', 'value' => $chemicalworkinstruction__idstring, 'id' => 'chemicalworkinstruction__idstring'));?></td></tr><tr class='basic'><script type="text/javascript">$(document).ready(function() {$("#chemicalworkinstruction__date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td>Date *</td><td><?=form_input(array('name' => 'chemicalworkinstruction__date', 'value' => $chemicalworkinstruction__date, 'class' => 'date', 'id' => 'chemicalworkinstruction__date'));?></td></tr><tr class='basic'>
<td>Product Name *</td><td><?=form_input(array('name' => 'chemicalworkinstruction__name', 'value' => $chemicalworkinstruction__name, 'id' => 'chemicalworkinstruction__name'));?></td></tr><tr class='basic'>
<td>Job Order No</td><td><?=form_input(array('name' => 'chemicalworkinstruction__joborderno', 'value' => $chemicalworkinstruction__joborderno, 'id' => 'chemicalworkinstruction__joborderno'));?></td></tr><tr class='basic'>
<td>Packing</td><td><?=form_input(array('name' => 'chemicalworkinstruction__packing', 'value' => $chemicalworkinstruction__packing, 'id' => 'chemicalworkinstruction__packing'));?></td></tr><tr class='basic'>
<td>Quantity (Liter/Kg)</td><td><?=form_input(array('name' => 'chemicalworkinstruction__qtyliterkg', 'value' => $chemicalworkinstruction__qtyliterkg, 'id' => 'chemicalworkinstruction__qtyliterkg'));?></td></tr><tr class='basic'>
<td>Notes</td><td><?=form_textarea(array('name' => 'chemicalworkinstruction__notes', 'value' => $chemicalworkinstruction__notes, 'id' => 'chemicalworkinstruction__notes'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/chemical_work_instructionlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


