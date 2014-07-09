<?php include "header.php" ?>


<div id="maincontent">
  
<h3 class="addtitle">Generate Profit Loss Statement</h3>

<p>
<div id="profitlossoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/profitloss/submit" id="profitlossform" class="addform">
<table width="100%" class="addtable">
<tr class='basic'>
<tr class='basic'>
<td>From Date *</td><script type="text/javascript">$(document).ready(function() {$(".profitloss__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'profitloss__datefrom', 'value' => $currentdate, 'class' => 'profitloss__datebasic'));?></td>
</tr>
<tr class='basic'>
<td>To Date *</td><script type="text/javascript">$(document).ready(function() {$(".profitloss__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'profitloss__dateto', 'value' => $currentdate, 'class' => 'profitloss__datebasic'));?></td>
</tr>
<td>Compared to *</td>
<td><?=form_dropdown('profitloss__comparative', $compare_opt, 'id="profitloss__comparative" class="basic"');?></td></tr>
</table>


<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/trialbalance";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
