<html>
<head><title>AR Due</title>
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
	<h1>AR Due 
		<?php if($customer != ""): ?>
			for <?=$customer;?>
		<?php endif; ?>
	</h1>
	<!--<h3>up to <?=$endingdate;?> </h3>-->
</div>
<table class="trialbalance" cellpadding="0" cellspacing="0">
	<tr>
		<th class="heading2">Invoice Number</th>
		<th class="heading2">Customer</th>
		<th class="heading2">Date</th>
		<th class="heading2">Due Date</th>
		<th class="heading2">Amount</th>
	</tr>
	<?php $balance=0;?>
	<!-- foreach coa whose coa type class is "Current Asset -->
	<?php foreach($entries as $entry): ?>
		<tr>
				<td><?=$entry['invoiceid'];?></td>
				<td><?=$entry['customer'];?></td>
				<td><?php echo $entry['date'];?></td>
				<td><?php echo $entry['duedate']->format('d-m-Y');?></td>
				<td class="balance"><?=$entry['currency'];?> <?=number_format($entry['amount'],0);?></td>
			</tr>

	<?php endforeach; ?>
	
</table>
<?php include "reportfooter.php"?>
</body>
</html>