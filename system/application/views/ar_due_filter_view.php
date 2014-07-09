<?php include "header.php" ?>


<div id="maincontent">
  
<h3 class="addtitle">Generate AR Due</h3>

<p>
<div id="ardueoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/ar_due/submit" id="ardueform" class="addform">
<table width="100%" class="addtable">
<tr class='basic'>
<tr class='basic'>
<!--<td>Up to Date *</td><script type="text/javascript">$(document).ready(function() {$(".ardue__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'ardue__datefrom', 'value' => $currentdate, 'class' => 'ardue__datebasic'));?></td>
</tr><tr>-->
<td>AR Account</td>
<td><?=form_dropdown('ardue__customer_id', $ar_opt, 'class="basic"');?></td></tr>

</tr>

</table>


<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/ar_due";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
