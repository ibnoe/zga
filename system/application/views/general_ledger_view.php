<html>
<head><title>General Ledger | periode <?=$date_from;?> - <?=$date_to;?></title>
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
	<h1>General Ledger</h1>
	<h3>periode: <?=$date_from;?> to <?=$date_to;?></h3> 
</div>

<table>
	<tr>
		<td class="filteredby" colspan="5">Filtered by: <?=$coa_name;?></td>
	</tr>
	<!-- foreach journal related to this account is displayed -->
	<?php if($counter == 0): ?>
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
			<?php if($classtype == "Aktiva" || $classtype == "Beban"): ?>
				<?php if($initialbalance >= 0): ?>
					<td class="balance"><?=number_format($initialbalance, 0);?></td>
					<td class="balance">0</td>
				<?php else: ?>		
					<td class="balance">0</td>
					<td class="balance"><?=number_format($initialbalance * -1, 0);?></td>
				<?php endif; ?>		
			<?php else: ?>	
				<?php if($initialbalance < 0): ?>
					<td class="balance"><?=number_format($initialbalance * -1, 0);?></td>
					<td class="balance">0</td>
				<?php else: ?>		
					<td class="balance">0</td>
					<td class="balance"><?=number_format($initialbalance, 0);?></td>
				<?php endif; ?>		
			<?php endif; ?>
					
		<td class="balance"><?=number_format($balance, 0);?></td>
	</tr>

		<?php foreach ($results as $result): ?>
			<tr>
				<td><?=$result['date'];?></td>
				<td><?=$result['reference'];?></td>
				<td class="balance"><?=number_format($result['debit'], 0);?></td>
				<td class="balance"><?=number_format($result['credit'], 0);?></td>
				<?php if (($result['classtype'] == "Aktiva") || ($result['classtype'] == "Beban")):?>
						<?php $balance += $result['debit']; 
						      $balance -= $result['credit']; 
						?>
				<?php else: ?>
						<?php $balance += $result['credit']; 
						      $balance -= $result['debit']; 
						?>
				<?php endif; ?>
				<td class="balance"><?=number_format($balance, 0);?></td>
			</tr>
		<?php endforeach; ?>
	<?php else: ?>
		<?php for ($j = 0; $j < $counter; $j++): ?> 
			<?php $rows = $results[$j];?>
			<?php if(sizeof($rows) == 0) { continue; } ?>
			 
			<tr>
				<td  class="coaname" colspan="5"><?=$coa_names[$j];?></td>
			</tr>
			<tr>
				<th>Date</th>
				<th>Description</th>
				<th>Debit</th>
				<th>Credit</th>
				<th>Balance</th>
			</tr>
			<tr>
				<?php $balance = $initialbalance[$j]; ?>
				<td><?=$date_from;?></td>
				<td>Balance Brought Forwards</td>
				
					<?php if($classtype[$j] == "Aktiva" || $classtype[$j] == "Beban"): ?>
						<?php if($initialbalance >= 0): ?>
							<td class="balance"><?=number_format($initialbalance[$j], 0);?></td>
							<td class="balance">0</td>
						<?php else: ?>		
							<td class="balance">0</td>
							<td class="balance"><?=number_format($initialbalance[$j], 0) * -1;?></td>
						<?php endif; ?>		
					<?php else: ?>	
						<?php if($initialbalance >= 0): ?>
							<td class="balance">0</td>
							<td class="balance"><?=number_format($initialbalance[$j], 0);?></td>
						<?php else: ?>		
							<td class="balance"><?=number_format($initialbalance[$j], 0) * -1;?></td>
							<td class="balance">0</td>
						<?php endif; ?>		
					<?php endif; ?>
							
					<td class="balance"><?=number_format($balance, 0);?></td>
			</tr>
			<?php foreach ($rows as $result): ?>
				<tr>
					<td><?=$result['date'];?></td>
					<td><?=$result['reference'];?></td>
					<td class="balance"><?=number_format($result['debit'], 0);?></td>
					<td class="balance"><?=number_format($result['credit'], 0);?></td>
					<?php if (($result['classtype'] == "Aktiva") || ($result['classtype'] == "Beban"))
					{
						$balance += $result['debit'];
						$balance -= $result['credit'];
					}
					else {	
						$balance += $result['credit'];
						$balance -= $result['debit'];
					}
					?>
				<td class="balance"><?=number_format($balance, 0);?></td>
			</tr>
			<?php endforeach; ?>
		<?php endfor; ?>
	<?php endif; ?>
</table>
<?php include "reportfooter.php" ?>