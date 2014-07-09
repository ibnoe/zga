<?php include "header.php" ?>


<div id="maincontent">
  
<h3 class="addtitle">Generate Balance Sheet Report</h3>

<p>
<div id="balancesheetoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/balancesheet/submit" id="balancesheetform" class="addform">
<table width="100%" class="addtable">
<tr class='basic'>
<tr class='basic'>
<td>As of Date *</td><script type="text/javascript">$(document).ready(function() {$(".balancesheet__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'balancesheet__date', 'value' => $currentdate, 'class' => 'balancesheet__datebasic'));?></td></tr>
<td>Compared to *</td>
<td><?=form_dropdown('balancesheet__comparative', $compare_opt, 'id="balancesheet__comparative" class="basic"');?></td></tr>

</table>


<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/balancesheet";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
