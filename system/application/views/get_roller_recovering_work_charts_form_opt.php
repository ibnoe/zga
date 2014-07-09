<?php include "header.php" ?>

<div id="maincontent">
  
<h3>Roller Recovering Work Charts Form</h3>

<form method="post" action="<?=site_url();?>/get_roller_recovering_work_charts_form/submit" id="get_roller_recovering_work_charts_formid" class="get_roller_recovering_work_charts_formclass">

<table width="100%">

<tr class='basic'>
<td>RCN</td>
<td><?=form_dropdown('rcn_id', $rcn_opt, '', 'class="basic"');?></td></tr>
</table>

<p>
<?=form_submit('submit', 'Submit');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
