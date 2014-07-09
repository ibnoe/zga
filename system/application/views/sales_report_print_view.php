<html>
<head><title>Sales Report</title>
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

	<h1>Sales Report</h1>
	<h3>Periode <?=$beginningdate;?> to <?=$endingdate;?></h3>
</div>


<div class="linelist">
	<table cellspacing="0" cellpadding="0" class="invoice">
		<tr>
			<th>Date</th>
			<th>Order ID</th>
			<th>Amount</th>
		</tr>
	<?php $total =0; ?>
	<?php foreach($results as $result): ?>
		<tr>
			<?php $total+=$result['grandtotal'];?>
			<td class="alignedleft"><?=$result['date'];?></td>
			<td><?=$result['orderid'];?></td>
			<td class="balance"><?=number_format($result['grandtotal'],0);?></td>
		</tr>
	<?php endforeach; ?>
		<tr><td class="total" colspan="2">TOTAL</td>
		<td class="total"><?=number_format($total,0);?></td></tr>
	</table>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>