<html>
<head><title>Income Statement Report | period <?=$beginningdate;?> - <?=$endingdate;?></title>
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
	<h1>Income Statement</h1>
	<h3>periode <?=$beginningdate;?> to <?=$endingdate;?></h3> 
</div>
<table>
	<tr>
		<td class="heading2">&nbsp;</td>
		<td class="balance" style="font-weight:bold;"><?=$beginningdate;?>-<?=$endingdate;?></td>
		<td class="balance" style="font-weight:bold;"><?=$comparativedate_from;?>-<?=$comparativedate_to;?></td>
	</tr>
	<tr>
		<td class="heading2">SALES REVENUE</td>
		<td class="balance"><?=number_format($total_sales_revenue, 2);?></td>
		<td class="balance"><?=number_format($last_total_sales_revenue, 2);?></td>
	</tr>
	
	<tr>
		<td class="heading2">COGS</td>
		<td class="balance_und">-<?=number_format($total_cogs, 2);?></td>
		<td class="balance_und">-<?=number_format($last_total_cogs, 2);?></td>
	</tr>
	<tr>
		<td class="heading2">GROSS MARGIN</td>
		<td class="balance"><span><?=number_format($gross_margin, 2);?></span></td>
		<td class="balance"><span><?=number_format($last_gross_margin, 2);?></span></td>
	</tr>

	<tr>
		<td class="heading2">OPERATIONAL EXPENSE</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php foreach($operational_expense_coa as $coa): ?>
		<tr>
			<td class="heading2"><span><?=$coa['name'];?></span></td>
			<td class="balance2"><?=number_format($coa['balance'], 2);?></td>
			<td class="balance2"><?=number_format($coa['lastbalance'], 2);?></td>
		</tr>	
	<?php endforeach; ?>
	<tr>
		<td class="heading2">Total Operational Expense</td>
		<td class="balance"><span>-<?=number_format($total_operational_expense, 2);?></span></td>
		<td class="balance"><span>-<?=number_format($last_total_operational_expense, 2);?></span></td>
	</td>
	<tr>
		<td class="heading3">OPERATIONAL PROFIT</td>
		<td class="grandtotal"><?=number_format($operational_profit, 2);?></td>
		<td class="grandtotal"><?=number_format($last_operational_profit, 2);?></td>
	</tr>
	<tr>
		<td class="heading2">OTHER REVENUE</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php foreach($revenue_coa as $rcoa): ?>
		<tr>
			<td class="heading2"><span><?=$rcoa['name'];?></span></td>
			<td class="balance2"><?=number_format($rcoa['balance'], 2);?></td>
			<td class="balance2"><?=number_format($rcoa['lastbalance'], 2);?></td>
		</tr>	
	<?php endforeach; ?>
	
	<tr>
		<td class="heading2">Total Other Revenue</td>
		<td class="balance"><span><?=number_format($total_rest_of_revenue, 2);?></span>	</td>
		<td class="balance"><span><?=number_format($last_total_rest_of_revenue, 2);?></span>	</td>
	</tr>
	
	<tr>
		<td class="heading2">OTHER EXPENSE</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php foreach($expense_coa as $ecoa): ?>
		<tr>
			<td class="heading2"><?=$ecoa['name'];?></td>
			<td class="balance2"><?=number_format($ecoa['balance'], 2);?></td>
			<td class="balance2"><?=number_format($ecoa['lastbalance'], 2);?></td>
		</tr>	
	<?php endforeach; ?>
	
	<tr>
		<td class="heading2">Total Other Expense</td>
		<td class="balance"><span>-<?=number_format($total_rest_of_expense, 2);?></span></td>
		<td class="balance"><span>-<?=number_format($last_total_rest_of_expense, 2);?></span></td>
	</tr>

	<tr>
		<td class="heading3">PROFIT BEFORE TAX</td>
		<td class="grandtotal"><?=number_format($operational_profit - $total_rest_of_revenue, 2);?></td>
		<td class="grandtotal"><?=number_format($last_operational_profit - $last_total_rest_of_revenue, 2);?></td>
	</tr>
	<?php foreach($tax_coa as $tcoa): ?>
		<tr>
			<td class="heading2"><?=$tcoa['name'];?></td>
			<td class="balance">-<?=number_format($tcoa['balance'], 2);?></td>
			<td class="balance">-<?=number_format($tcoa['lastbalance'], 2);?></td>
		</tr>	
	<?php endforeach; ?>	
	<tr>
		<td class="heading3">NET PROFIT</td>
		<td class="grandtotal"><?=number_format($net_profit, 2);?></td>
		<td class="grandtotal"><?=number_format($last_net_profit, 2);?></td>
	</tr>
</table>

<?php include "reportfooter.php"?>
</body>
</html>