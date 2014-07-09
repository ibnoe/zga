<html>
<head><title>Journal Receipt</title>
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

	<h1>Journal Receipt</h1>
</div>


<?php
$this->db->where("id", $id);
$q = $this->db->get("journalmanual");

$journalmanual = $q->row_array();

$this->db->where("journalmanual_id", $id);
$q = $this->db->get("journal");

$journal = $q->result_array();

//print_r($journalmanual);
//echo "<br>";
//print_r($journal);

?>

<div class="nomor2">
	<table>
	<tr><td>BCA-6050763763</td></tr>
	<tr><td>Date:</td><td> <?=$journalmanual['date'];?></td></tr>
	<tr><td>Reference:</td><td><?=$journalmanual['reference'];?></td></tr>	
	</table>
</div>


<div class="linelist">
	<table cellspacing="0" cellpadding="0" class="invoice">
		<tr>
			<th>Description</th>
			<th>Code (D/K)</th>
			<th>Amount</th>
		</tr>
	<?php foreach($journal as $line): ?>
		<tr>
			<?php //get COA detail
			
				$this->db->where("id", $line['coa_id']);
				$q = $this->db->get("coa");

				$coa = $q->row_array();
		
			?>
			<td class="alignedleft"><?=$coa['name'];?></td>
			<?php if($line['debit'] != 0): ?>
				<td>D</td>
				<td class="balance"><?=number_format($line['debit'],0);?></td>
			<?php else: ?>
				<td>K</td>			
				<td class="balance"><?=number_format($line['credit'],0);?></td>
			<?php endif; ?>
			
		</tr>
	<?php endforeach; ?>
		<tr><td colspan="2">&nbsp;</td></tr>
		
	</table>
</div>
<br clear="all">
<?php include "signaturesreceipt.php"?>
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>