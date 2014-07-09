<?php include "header.php" ?>

<div id="maincontent">
  
<h3 class="addtitle">Cash Report</h3>

<form method="post" action="<?=site_url();?>/cash_report/submit" id="cash_report_formid" class="cash_report_formclass">

<table width="100%">

<tr class='basic'>
<td>From Date</td><script type="text/javascript">$(document).ready(function() {$("#cashreport__from_date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'cashreport__from_date', 'value' => $cashreport__from_date, 'class' => 'basic', 'id' => 'cashreport__from_date'));?></td></tr>
<tr class='basic'>
<td>To Date</td><script type="text/javascript">$(document).ready(function() {$("#cashreport__to_date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'cashreport__to_date', 'value' => $cashreport__to_date, 'class' => 'basic', 'id' => 'cashreport__to_date'));?></td></tr>
<tr class='basic'>
<td>Cash Account</td>
<td><?=form_dropdown('cashreport__coa_id', $coa_opt, $cashreport__coa_id, 'class="basic"');?></td></tr>
</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/cash_report";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
