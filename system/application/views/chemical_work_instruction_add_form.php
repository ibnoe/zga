<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#chemical_work_instructionoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/chemical_work_instructionview/index/' },
		}; 
		
		$('#chemical_work_instructionform').click(function(){$('#chemical_work_instructionform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Chemical Work Instruction</h3>

<p>
<div id="chemical_work_instructionoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/chemical_work_instructionadd/submit" id="chemical_work_instructionform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'chemicalworkinstruction__idstring', 'value' => $chemicalworkinstruction__idstring, 'class' => 'basic', 'id' => 'chemicalworkinstruction__idstring'));?></td></tr>
<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".chemicalworkinstruction__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'chemicalworkinstruction__date', 'value' => $chemicalworkinstruction__date, 'class' => 'chemicalworkinstruction__datebasic'));?></td></tr>
<tr class='basic'>
<td>Product Name *</td>
<td><?=form_input(array('name' => 'chemicalworkinstruction__name', 'value' => $chemicalworkinstruction__name, 'class' => 'basic', 'id' => 'chemicalworkinstruction__name'));?></td></tr>
<tr class='basic'>
<td>Job Order No</td>
<td><?=form_input(array('name' => 'chemicalworkinstruction__joborderno', 'value' => $chemicalworkinstruction__joborderno, 'class' => 'basic', 'id' => 'chemicalworkinstruction__joborderno'));?></td></tr>
<tr class='basic'>
<td>Packing</td>
<td><?=form_input(array('name' => 'chemicalworkinstruction__packing', 'value' => $chemicalworkinstruction__packing, 'class' => 'basic', 'id' => 'chemicalworkinstruction__packing'));?></td></tr>
<tr class='basic'>
<td>Quantity (Liter/Kg)</td>
<td><?=form_input(array('name' => 'chemicalworkinstruction__qtyliterkg', 'value' => $chemicalworkinstruction__qtyliterkg, 'class' => 'basic', 'id' => 'chemicalworkinstruction__qtyliterkg'));?></td></tr>
<tr class='basic'>
<td>Notes</td>
<td><?=form_textarea(array('name' => 'chemicalworkinstruction__notes', 'value' => $chemicalworkinstruction__notes, 'class' => 'basic', 'id' => 'chemicalworkinstruction__notes'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/chemical_work_instructionlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
