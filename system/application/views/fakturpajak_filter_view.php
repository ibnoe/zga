<?php include "header.php" ?>


<div id="maincontent">
  
<h3 class="addtitle">Generate Faktur Pajak</h3>

<p>
<div id="stockcardoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/fakturpajak/submit" id="fakturpajakform" class="addform">
<table width="100%" class="addtable">
<tr class='basic'>
<tr class='basic'>
<td>Sales Invoice</td>
<td><?=form_dropdown('fakturpajak__salesinvoice_id', $salesinvoice_opt, $invoice_id, 'class="basic"');?></td></tr>
<td>Kode dan Nomor Seri Faktur Pajak *</td>
<td><?=form_input(array('name' => 'fakturpajak__code', 'class' => 'fakturpajak__basic', 'id' => 'fakturpajak__code'));?></td>
</tr>
<tr class='basic'>
<td>Kurs *</td>
<td><?=form_input(array('name' => 'fakturpajak__rate', 'class' => 'fakturpajak__basic', 'id' => 'fakturpajak__rate'));?></td></td>
</tr>

</table>


<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/fakturpajak";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
