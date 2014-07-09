<?php include "header.php" ?>


<div id="maincontent">
  
<h3 class="addtitle">Generate AP Statement</h3>

<p>
<div id="apstatementoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/ap_statement/submit" id="apstatementform" class="addform">
<table width="100%" class="addtable">
<tr class='basic'>

<tr>
<td>AP Account</td>
<td><?=form_dropdown('ap__supplier_id', $ap_opt, 'class="basic"');?></td></tr>
</tr>
</table>


<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/ap_statement";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
