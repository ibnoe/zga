<?php include "header.php" ?>

<div id="maincontent">
  
<h3 class="addtitle">Bank Report</h3>

<form method="post" action="<?=site_url();?>/bank_report/submit" id="bank_report_formid" class="bank_report_formclass">

<table width="100%">

<tr class='basic'>
<td>From Date</td><script type="text/javascript">$(document).ready(function() {$("#bankreport__from_date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'bankreport__from_date', 'value' => $bankreport__from_date, 'class' => 'basic', 'id' => 'bankreport__from_date'));?></td></tr>
<tr class='basic'>
<td>To Date</td><script type="text/javascript">$(document).ready(function() {$("#bankreport__to_date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'bankreport__to_date', 'value' => $bankreport__to_date, 'class' => 'basic', 'id' => 'bankreport__to_date'));?></td></tr>
<tr class='basic'>
<td>Bank Account</td>
<td><?=form_dropdown('bankreport__coa_id', $coa_opt, $bankreport__coa_id, 'class="basic"');?></td></tr>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/bank_report";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
