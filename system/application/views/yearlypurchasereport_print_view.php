<html>
<head><title>Laporan Pembelian Tahunan | tahun <?=$year;?></title>
<link href="<?=base_url();?>css/reportstyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="reportheader">
	<div class="company">
		<img src="<?=base_url();?>css/images/zentrum_logo.gif"><br/>
		PT Zentrum Graphics Asia<br/>
		Jl. Raya Serpong Km 7<br/>
		Komplek Multiguna AI/1<br/>
		Serpong - Tangerang 15310<br/>
		Banten - Indonesia<br/>
	</div>

	<h1>Laporan Pembelian Tahunan</h1>
	<h3>Untuk Tahun <?=$year;?></h3>
</div>


<div class="linelist">
	<h3>Pembelian Lokal</h3>
	<table cellspacing="0" cellpadding="0" class="invoice">
		<tr>
			<th>Periode</th>
			<th>Supplier</th>
			<th>Total</th>
		</tr>
	<?php $total =array(); ?>
	<?php for($i=0;$i<12;$i++): ?>
		<?php $total[$i] = 0; ?> 
		<?php foreach($localresults[$i] as $persupp): ?>
			<tr>
				<?php $total[$i]+=$persupp['grandtotal'];?>
				<td class="alignedleft"><?=$i;?>-<?=$year;?></td>
				<?php
					//retreive supplier's name
					$this->db->from('supplier');
					$this->db->where('id', $persupp['supplier_id']);
					$this->db->select('idstring');
					$q= $this->db->get();
					$supp = $q->row_array();
					
					$suppname = $supp['idstring'];
					
					//retrieve currency name
					$this->db->from('currency');
					$this->db->where('id', $persupp['currency_id']);
					$this->db->select('name');
					$q= $this->db->get();
					$curr = $q->row_array();
					
					$currname = $curr['name'];
				?>
				<td><?=$suppname;?></td>
				<td class="balance"><?=$currname;?> <?=number_format($persupp['grandtotal'],0);?></td>
			</tr>
		<?php endforeach; ?>	
		<?php if (count($localresults[$i]) > 0):?>
			<tr><td class="total" colspan="2">TOTAL</td>
			<td class="total"><?=number_format($total[$i],0);?></td></tr>
		<?php endif; ?>
	<?php endfor; ?>
		
	</table>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>