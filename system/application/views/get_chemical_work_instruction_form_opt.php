<?php include "header.php" ?>

<div id="maincontent">
  
<h3>Chemical Work Instruction Form</h3>

<form method="post" action="<?=site_url();?>/get_chemical_work_instruction_form/submit" id="get_chemical_work_instruction_formid" class="get_chemical_work_instruction_formclass">

<table width="100%">

<tr class='basic'>
<td>Penambahan Stock Chemical</td>
<td><?=form_dropdown('penambahanstockchemical_id', $penambahanstockchemical_opt, '', 'class="basic"');?></td></tr>
</table>

<p>
<?=form_submit('submit', 'Submit');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
