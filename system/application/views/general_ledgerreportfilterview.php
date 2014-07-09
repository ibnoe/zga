<?php include "header.php" ?>

<div id="general ledgerdiv">
  
<h3 class="general ledgertitleclass">General Ledger</h3>

<form method="post" action="<?=site_url();?>/generate_accounting_report" id="general ledgerformid" class="general ledgerformclass">

<table width="100%">

<tr class='basic'>
<td>From Date</td><script type="text/javascript">$(document).ready(function() {$("#journal__from_date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'yy-mm-dd' });});</script>
<td><?=form_input(array('name' => 'journal__from_date', 'value' => $journal__from_date, 'class' => 'basic', 'id' => 'journal__from_date'));?></td></tr>
<tr class='basic'>
<td>To Date</td><script type="text/javascript">$(document).ready(function() {$("#journal__to_date").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'yy-mm-dd' });});</script>
<td><?=form_input(array('name' => 'journal__to_date', 'value' => $journal__to_date, 'class' => 'basic', 'id' => 'journal__to_date'));?></td></tr>
<tr class='basic'>
<td>Account</td>
<td><?=form_dropdown('journal__coa_id', $coa_opt, $journal__coa_id, 'class="basic"');?></td></tr>
</table>

<p>
<?=form_submit('submit', 'Submit');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
