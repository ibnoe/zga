<html>
<head><title>Stock Card</title>
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

	<h1>Stock Card</h1>
	<h4>Periode: <?=$beginningdate;?> to <?=$endingdate;?></h4>
	<h4>Item: <?=$item;?></h4>
	<h4>Warehouse: <?=$warehouse;?></h4>
</div>


<div class="linelist">
	<table cellspacing="0" cellpadding="0" class="invoice">
		<tr>
			<th>Date</th>
			<th>Order ID</th>
			<th>Description</th>
			<th>Quantity IN</th>
			<th>Quantity OUT</th>
			<th>Balance</th>
		</tr>
	<?php $balance = $initialqty; ?>
	<?php foreach($results as $result): ?>
		<tr>
			
			<!-- Get date -->
			
			<td class="alignedleft"><?=$result['date'];?></td>
			<td><?=$result['orderid'];?></td>
			<td><?=$result['intnotes'];?></td>
			<?php if($result['type'] == "stockin"): ?> 
				<td class="balance"><?=number_format($result['quantity'],0);?></td>
				<?php $balance+=$result['quantity'];?>
				<td>-</td>
			<?php else: ?>
				<td>-</td>
				<td class="balance"><?=number_format($result['quantity'],0);?></td>
				<?php $balance-=$result['quantity'];?>
			<?php endif; ?>
			<td class="balance"><?=number_format($balance,0);?></td>
		</tr>
	<?php endforeach; ?>
		
	</table>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>