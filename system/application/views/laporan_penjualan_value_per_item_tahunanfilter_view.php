
                <?php include "header.php" ?>


<div id="maincontent">
  
<h3 class="addtitle">Laporan Penjualan Value Per Item Tahunan</h3>

<p>
<div id="purchasereportoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/laporan_penjualan_value_per_item_tahunan_cont/submit" id="purchasereportform" class="addform">
<table width="100%" class="addtable">
<tr class='basic'>
<tr class='basic'>
<td>Year *</td>
<td><td><?=form_dropdown('year', $year_opt, 'class="basic"');?></td></tr></td>
</tr>

</table>


<p>
<?=form_submit('done', 'Retrieve');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
