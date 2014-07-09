<html>
<head><title>Trial Balance | per <?=$endingdate;?></title>
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
	<h1>Trial Balance</h1>
	<h3>as of <?=$endingdate;?> </h3> 
</div>
<table class="trialbalance" cellpadding="0" cellspacing="0">
	<tr>
		<th class="heading2">Account</th>
		<th class="heading2">Beginning Balance</th>
		<th class="heading2">Debit</th>
		<th class="heading2">Credit</th>
		<th class="heading2">Net Activity</th>
		<th class="heading2">Ending Balance</th>
		<th class="heading2"><?=$comparativedate; ?> Balance</th>
	</tr>
	<?php $balance=0;?>
	<!-- foreach coa whose coa type class is "Current Asset -->
	<?php foreach($entries as $entry): ?>
		<tr>
				<td><?=$entry['account'];?></td>
				<td class="balance"><?=number_format($entry['open_balance'],0);?></td>
				<td class="balance"><?=number_format($entry['total_debit'],0);?></td>
				<td class="balance"><?=number_format($entry['total_credit'],0);?></td>
				<td class="balance"><?=number_format($entry['current_balance'],0);?></td>
				<td class="balance"><?=number_format($entry['ending_balance'],0);?></td>
				<td class="balance"><?=number_format($entry['ending_comparative_balance'],0);?></td>
			</tr>

	<?php endforeach; ?>
	
</table>
<?php include "reportfooter.php"?>
</body>
</html>