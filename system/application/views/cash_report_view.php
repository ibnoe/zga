<html>
<head><title>Cash Report | periode <?=$date_from;?> - <?=$date_to;?></title>
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
	<h1>Cash Report</h1>
	<h3>periode: <?=$date_from;?> to <?=$date_to;?></h3> 
</div>
<table class="cashbankreport" cellpadding="0" cellspacing="0">
	<tr>
		<td class="filteredby" colspan="5">Filtered by: <?=$cash_name;?></td>
	</tr>
<?php if($error_msg != ""): ?>
	<tr><td><?=$error_msg;?></td></tr>
<?php else: ?>	
	<tr>
		<th>Date</th>
		<th>Description</th>
		<th>Debit</th>
		<th>Credit</th>
		<th>Balance</th>
	</tr>
	<tr>
		<?php $balance = $initialbalance; ?>
		<td><?=$date_from;?></td>
		<td>Balance Brought Forwards</td>
		<?php if($initialbalance >= 0): ?>
			<td class="balance"><?=number_format($initialbalance, 0);?></td>
			<td class="balance">0</td>
		<?php else: ?>		
			<td class="balance">0</td>
			<td class="balance"><?=number_format($initialbalance * -1, 0);?></td>
		<?php endif; ?>		
		<td class="balance"><?=number_format($balance, 0);?></td>
	</tr>
		
		<?php foreach ($results as $result): ?>
			<tr>
				<td><?=$result['date'];?></td>
				<td><?=$result['reference'];?>&nbsp;</td>
				<td class="balance"><?=number_format($result['debit'], 0);?></td>
				<td class="balance"><?=number_format($result['credit'], 0);?></td>
				<?php $balance += $result['debit']; 
					  $balance -= $result['credit']; 
				?>
				<td class="balance"><?=number_format($balance, 0);?></td>
			</tr>
		<?php endforeach; ?>
<?php endif; ?>	
</table>
<?php include "reportfooter.php" ?>