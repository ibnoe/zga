<?php include "header.php" ?>


<div id="maincontent">
  
<h3 class="addtitle">Generate Trial Balance Report</h3>

<p>
<div id="trialbalanceoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/trialbalance/submit" id="trialbalanceform" class="addform">
<table width="100%" class="addtable">
<tr class='basic'>
<tr class='basic'>
<td>As of Date *</td><script type="text/javascript">$(document).ready(function() {$(".trialbalance__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'trialbalance__date', 'value' => $currentdate, 'class' => 'trialbalance__datebasic'));?></td></tr>
<td>Compared to *</td>
<td><?=form_dropdown('trialbalance__comparative', $compare_opt, 'id="trialbalance__comparative" class="basic"');?></td></tr>
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
