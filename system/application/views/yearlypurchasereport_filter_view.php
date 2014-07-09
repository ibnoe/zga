<?php include "header.php" ?>


<div id="maincontent">
  
<h3 class="addtitle">Generate Report Pembelian Tahunan</h3>

<p>
<div id="purchasereportoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/yearlypurchasereport/submit" id="purchasereportform" class="addform">
<table width="100%" class="addtable">
<tr class='basic'>
<tr class='basic'>
<td>Year *</td>
<td><td><?=form_dropdown('yearlypurchasereport__year', $year_opt, 'class="basic"');?></td></tr></td>
</tr>

</table>


<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/yearlypurchasereport";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Retrieve');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
