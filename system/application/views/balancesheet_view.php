<html>
<head><title>Balance Sheet Report | as of <?=$endingdate;?></title>
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
	<h1>Balance Sheet</h1>
	<h3>as of <?=$endingdate;?></h3> 
</div>
<table>
	<tr>
		<td class="heading1">ASSET</td>
		<td style="text-align:right; font-weight:bold;"><?=$endingdatewords;?></td>
		<td style="text-align:right; font-weight:bold;"><?=$comparativedate;?></td>
	</tr>
	<tr>

		<td class="heading2">Current Asset</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php $balance=0; $lastbalance=0;?>
	<!-- foreach coa whose coa type class is "Current Asset -->
	<?php foreach($current_asset_coa as $asset): ?>
		<?php if (true || $asset['name'] == "Cash & Bank" || $asset['name'] == "Giro Receivable" || $asset['name'] == "Inventory" || $asset['name'] == "Other Current Asset" ): ?>
			<tr>
				<td><?=$asset['name'];?></td>
				<td class="balance"><?=number_format($asset['balance'], 0);?></td>
				<td class="balance"><?=number_format($asset['lastbalance'], 0);?></td>
			</tr>
			<?php $balance += $asset['balance'];
				  $lastbalance += $asset['lastbalance'];
 			?>
		<?php endif; ?>
	<?php endforeach; ?>
	<tr>
		<td class="totalheading">Total Current Asset</td>
		<td class="grandtotal"><?=number_format($balance,0);?></td>
		<td class="grandtotal"><?=number_format($lastbalance,0);?></td>
		
	</tr>
	<tr>
		<td class="heading1">Fixed Asset</td>
		<td>&nbsp;</td>
	</tr>
	<?php $balance=0; $lastbalance = 0;?>
	<!-- foreach coa whose coa type class is "Fixed Asset -->
	<?php foreach($non_current_asset_coa as $asset): ?>
		<?php if(true || $asset['name'] == "Land" || $asset['name'] == "Building" || $asset['name'] == "Vehicles" || $asset['name'] == "Furniture" || $asset['name'] == "Equipment" || $asset['name'] == "Other Fixed Asset" ): ?>
			<tr>
				<td><?=$asset['name'];?></td>
				<td class="balance"><?=number_format($asset['balance'], 0);?></td>
				<td class="balance"><?=number_format($asset['lastbalance'], 0);?></td>
			</tr>
			<?php $balance += $asset['balance']; 
				  $lastbalance += $asset['lastbalance'];
			?>
		<?php endif; ?>
	<?php endforeach; ?>
	<!-- foreach coa whose coa type class is "Accumulated Depreciation"	-->
	<?php foreach($non_current_asset_coa as $asset): ?>
		<?php if($asset['name'] == "Accumulated Depreciation"): ?>
			<tr>
				<td><?=$asset['name'];?></td>
				<td class="balance">-<?=number_format($asset['balance'], 0);?></td>
				<td class="balance">-<?=number_format($asset['lastbalance'], 0);?></td>
			</tr>
			<?php $balance -= $asset['balance']; 
				  $lastbalance -= $asset['lastbalance'];
			?>
		<?php endif; ?>
	<?php endforeach; ?>
	<tr>
		<td class="totalheading">Total Fixed Asset</td>
		<td class="grandtotal"><?=number_format($balance,0);?></td>
		<td class="grandtotal"><?=number_format($lastbalance,0);?></td>
	</tr>
	<tr>
		<td class="totalheading">TOTAL ASSET</td>
		<td class="grandtotal"><?=number_format($totalasset,0);?></td>
		<td class="grandtotal"><?=number_format($lasttotalasset,0);?></td>
	</tr>
	
	
	
	<tr>
		<td class="heading1">LIABILITY</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="heading2">Current Liability</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php $balance=0; $lastbalance=0;?>
	<!-- foreach coa whose coa type class is "Current Asset -->
	<?php foreach($current_liability_coa as $liability): ?>
		<?php if(true || $liability['name'] == "Giro Payable" || $liability['name'] == "Other Current Liability" || $liability['name'] == "Account Payable" ): ?>
			<tr>
				<td><?=$liability['name'];?></td>
				<td class="balance"><?=number_format($liability['balance'], 0);?></td>
				<td class="balance"><?=number_format($liability['lastbalance'], 0);?></td>
			</tr>
			<?php $balance += $liability['balance']; 
				  $balance += $liability['lastbalance']; 
			?>
		<?php endif; ?>
	<?php endforeach; ?>
	<tr>
		<td class="totalheading">Total Current Liability</td>
		<td class="grandtotal"><?=number_format($balance,0);?></td>
		<td class="grandtotal"><?=number_format($lastbalance,0);?></td>
	</tr>
	<tr>
		<td class="heading2">Non Current Liability</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php $balance=0; $lastbalance=0;?>
	<!-- foreach coa whose coa type class is "Fixed Asset -->
	<?php foreach($non_current_liability_coa as $liability): ?>
		<?php if(true || $liability['name'] == "Long Term Debt" || $liability['name'] == "Non Current Liability" ): ?>
			<tr>
				<td><?=$liability['name'];?></td>
				<td class="balance"><?=number_format($liability['balance'], 0);?></td>
				<td class="balance"><?=number_format($liability['lastbalance'], 0);?></td>
			</tr>
			<?php $balance += $liability['balance']; ?>
			<?php $lastbalance += $liability['lastbalance']; ?>
		<?php endif; ?>
	<?php endforeach; ?>
	
	<tr>
		<td class="totalheading">Total Non Current Liability</td>
		<td class="grandtotal"><?=number_format($balance,0);?></td>
		<td class="grandtotal"><?=number_format($lastbalance,0);?></td>
	</tr>
	<tr>
		<td class="totalheading">TOTAL LIABILITY</td>
		<td class="grandtotal"><?=number_format($totalliability,0);?></td>
		<td class="grandtotal"><?=number_format($lasttotalliability,0);?></td>
	</tr>

	<tr>
		<td class="heading1">EQUITY</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	
	<!-- foreach coa whose coa type class is "Equity" -->
	<?php foreach($equity_coa as $equity): ?>
			<tr>
				<td><?=$equity['name'];?></td>
				<td class="balance"><?=number_format($equity['balance'], 0);?></td>
				<td class="balance"><?=number_format($equity['lastbalance'], 0);?></td>
			</tr>
	<?php endforeach; ?>
	<tr>
		<td>Current Year Profit</td>
		<td class="balance"><?=number_format($current_profit,0);?></td>
		<td class="balance"><?=number_format($last_profit,0);?></td>
	</tr>
	<tr>
		<td class="totalheading">TOTAL EQUTY</td>
		<td class="grandtotal"><?=number_format($totalequity,0);?></td>
		<td class="grandtotal"><?=number_format($lasttotalequity,0);?></td>
	</tr>
	<tr>
		<td class="totalheading">TOTAL LIABILITY &amp; EQUTY</td>
		<td class="grandtotal"><?=number_format(($totalequity + $totalliability) ,0);?></td>
		<td class="grandtotal"><?=number_format(($lasttotalequity + $lasttotalliability) ,0);?></td>
	</tr>

	
</table>
<?php include "reportfooter.php"?>
</body>
</html>