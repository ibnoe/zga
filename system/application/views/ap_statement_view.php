<html>
<head><title>AP Statement</title>
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
	<br clear="all">
	<h1>AP Statement</h1>
	
</div>
<table class="trialbalance" cellpadding="0" cellspacing="0">
	<tr>
		<th class="heading2">Supplier</th>
		<th class="heading2" colspan="<?php echo count($currencies);?>">1 week</th>
		<th class="heading2" colspan="<?php echo count($currencies);?>">2 weeks</th>
		<th class="heading2" colspan="<?php echo count($currencies);?>">1 month</th>
		<th class="heading2" colspan="<?php echo count($currencies);?>">2 months</th>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<?php for($counter = 0; $counter < 4; $counter++) {
		foreach($currencies as $currency) {
			echo '<td>' . $currency['name'] . '</td>';
			$balance['top1w'][$currency['name']] = 0;
			$balance['top2w'][$currency['name']] = 0;
			$balance['top1m'][$currency['name']] = 0;
			$balance['top2m'][$currency['name']] = 0;
			$totalbalance[$currency['name']] = 0;
		}
	}
	?>
	</tr>
	
	<?php foreach($suppliers as $supplier): ?>
		<tr>
				<td><?=$supplier['idstring'];?></td>
					<?php foreach($currencies as $currency): ?>
						<td class="balance">
							
							<?=number_format($top1w[$supplier['idstring']][$currency['name']]['grandtotal'],0);?>
							
							<?php $balance['top1w'][$currency['name']] += $top1w[$supplier['idstring']][$currency['name']]['grandtotal']; ?>
							<?php $totalbalance[$currency['name']] += $top1w[$supplier['idstring']][$currency['name']]['grandtotal']; ?>
						</td>
						<td class="balance">
							<?=number_format($top2w[$supplier['idstring']][$currency['name']]['grandtotal'],0);?>	
						
							
							<?php $balance['top2w'][$currency['name']] += $top2w[$supplier['idstring']][$currency['name']]['grandtotal']; ?>
							<?php $totalbalance[$currency['name']] += $top2w[$supplier['idstring']][$currency['name']]['grandtotal']; ?>
						</td>
						<td class="balance">
							<?=number_format($top1m[$supplier['idstring']][$currency['name']]['grandtotal'],0);?>	
							
							<?php $balance['top1m'][$currency['name']] += $top1m[$supplier['idstring']][$currency['name']]['grandtotal']; ?>
							<?php $totalbalance[$currency['name']] += $top1m[$supplier['idstring']][$currency['name']]['grandtotal']; ?>
						</td>
						<td class="balance">
							<?=number_format($top2m[$supplier['idstring']][$currency['name']]['grandtotal'],0);?>	
							<?php $balance['top2m'][$currency['name']] += $top2m[$supplier['idstring']][$currency['name']]['grandtotal']; ?>
							<?php $totalbalance[$currency['name']] += $top2m[$supplier['idstring']][$currency['name']]['grandtotal']; ?>
						</td>
					<?php endforeach; ?>
		</tr>
	<?php endforeach; ?>
	<tr>
		<td class="balance"><b>TOTAL</b></td>
		<?php foreach($currencies as $currency): ?>
			<td class="balance"><b><?=number_format($balance['top1w'][$currency['name']],0);?></b></td>
			<td class="balance"><b><?=number_format($balance['top2w'][$currency['name']],0);?></b></td>
			<td class="balance"><b><?=number_format($balance['top1m'][$currency['name']],0);?></b></td>
			<td class="balance"><b><?=number_format($balance['top2m'][$currency['name']],0);?></b></td>
		<?php endforeach; ?>
	</tr>
</table>
<br/><br/>
<div class="displaytotal">
<?php foreach($currencies as $currency): ?>
Total <?=$currency['name'];?> : <?=number_format($totalbalance[$currency['name']],0);?>
<br/>
<?php endforeach; ?>
</div>
<?php include "reportfooter.php"?>
</body>
</html>