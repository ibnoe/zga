<?php include "header.php" ?>

<div id="maincontent">
  
<h3>Blanket Converting Work Instruction Form</h3>

<form method="post" action="<?=site_url();?>/get_blanket_converting_work_instruction_form/submit" id="get_blanket_converting_work_instruction_formid" class="get_blanket_converting_work_instruction_formclass">

<table width="100%">

<tr class='basic'>
<td>Blanket Identification Form</td>
<td><?=form_dropdown('bif_id', $bif_opt, '', 'class="basic"');?></td></tr>
</table>

<p>
<?=form_submit('submit', 'Submit');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
