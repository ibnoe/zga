<html>
<head><title>Laporan Ongkos Kirim Import</title>
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

	<h1>Laporan Ongkos Kirim Import</h1>
	<h3>Periode <?=$beginningdate;?> to <?=$endingdate;?></h3>
</div>


<?php 

$test_arr = array('' => '');

?>

	<?php foreach ($test_arr as $test_k=>$test_v): ?>

<div class="linelist">

<h3><?=$test_v;?></h3>

<?php
$headers = array(
'purchaseinvoice__orderid' => 'Invoice No', 
'purchaseinvoice__date' => 'Invoice Date', 
'purchaseinvoice__total' => 'Invoice Total', 
'ongkoskirimimport__total' => 'Ongkos Kirim Import Total', 
'pctg' => 'Percentage %',
);

$alwaysshow = array(

);

?>

	<table cellspacing="0" cellpadding="0" class="invoice">
		<tr>
			<th>No.</th>
			<?php foreach ($headers as $k=>$v): ?>
				<th><?=$v;?></th>
			<?php endforeach; ?>
			<th></th>
		</tr>
		
		<?php

$this->db->from('purchaseinvoice');
$this->db->join('ongkoskirimimport', 'purchaseinvoice.ongkoskirimimport_id = ongkoskirimimport.id');
$this->db->select('purchaseinvoice.orderid as purchaseinvoice__orderid');
$this->db->select('purchaseinvoice.date as purchaseinvoice__date');
$this->db->select('purchaseinvoice.total as purchaseinvoice__total');
$this->db->select('ongkoskirimimport.total as ongkoskirimimport__total');
$this->db->select('(purchaseinvoice.total/ongkoskirimimport.total * 100) as pctg');
$q = $this->db->get();

$counter = 1;

foreach ($q->result_array() as $row):?>

	<tr>
	<td><?=$counter;?></td>
	<?php foreach ($headers as $k=>$v): ?>
		<td>
		<?php
		
		if (true && (in_array($k, $alwaysshow) || $counter == 1))
		{
			if (is_numeric($row[$k]))
				echo number_format($row[$k], 2);
			else
				echo $row[$k];
		}
		else if ($prevrow[$k] != $row[$k])
		{
			if (is_numeric($row[$k]))
				echo number_format($row[$k], 2);
			else
				echo $row[$k];
		}
		
			
		?>
		</td>
	<?php endforeach; ?>
	
	<?php
		$prevrow = $row;
		$counter++;
	?>
	
	</tr>
<?php endforeach; ?>

	</table>
	
	<br><br>
	
<?php endforeach; ?>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>
