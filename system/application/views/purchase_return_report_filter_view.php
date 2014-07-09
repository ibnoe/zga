<?php include "header.php" ?>


<div id="maincontent">
  
<h3 class="addtitle">Generate Purchasing Return Report</h3>

<p>
<div id="purchasereturnreportoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/purchasereturnreport/submit" id="purchasereturnreportform" class="addform">
<table width="100%" class="addtable">
<tr class='basic'>
<tr class='basic'>
<td>From Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchasereturnreport__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchasereturnreport__datefrom', 'value' => $currentdate, 'class' => 'purchasereturnreport__datebasic'));?></td>
</tr>
<tr class='basic'>
<td>To Date *</td><script type="text/javascript">$(document).ready(function() {$(".purchasereturnreport__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'purchasereturnreport__dateto', 'value' => $currentdate, 'class' => 'purchasereturnreport__datebasic'));?></td>
</tr>

</table>


<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/purchasereturnreport";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
